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
include_once('front/contact.html');