<!DOCTYPE html>
    <html lang="en"><!-- Basic -->
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        </head>
        <body>
            <?php require_once('up.php');?>
            <?php
            if(isset($_SESSION['massage']))
            {
                ?>
                <div class="alert alert-<?=$_SESSION['mas_type']?>">
                    <?php
                    echo $_SESSION['massage'];
                    unset($_SESSION['massage']);
                    ?>
                </div>
                <?php
            }
            ?>
            <div class="container">
            <?php
                require_once('../include/config.php');
                $objConfig = new config;
                $strQuery = "SELECT * FROM gallary";
                $queryRes = mysqli_query($objConfig->mySQLLink,$strQuery);
                ?>
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>img</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        
                        <?php 
                            if(mysqli_num_rows($queryRes) >0)
                            {
                                while($data=mysqli_fetch_assoc($queryRes))
                                {
                                    ?>
                                <tr>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['img']; ?></td>
                                    <td>
                                        <a href="gallary.php?edit=<?php echo $data['id']; ?>"
                                        class="btn btn-info">Edit</a>
                                    </td>
                                    <td>
                                    <a href="gallary.php?delete=<?php echo $data['id']; ?>"
                                        class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                }
                            } 
                        ?>
                    </table>
                <?php
                
            ?>

            <form action="up.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">food name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $name;?>" placeholder="enter name" name="name" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label >food img</label>
                    <input type="file" name="file" >
                </div>
                <div class="form-group">
                    <?php
                    if($update == true)
                    {
                        ?>
                        <button type="submit" class="btn btn-info" name="update">update</button>
                        <?php
                    }
                    else
                    {
                        ?>
                        <button type="submit" class="btn btn-primary" name="save">save change</button>
                        <?php
                    }
                    ?>
                </div>
            </form>
        </div>
        </div>
        </body>
    </html>
