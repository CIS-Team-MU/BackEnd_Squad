<?php
class model{
    public function selectQuery($table,$cols,$cond){
        $objConfig = new config;
        $strQuery = "SELECT $cols FROM $table WHERE $cond";
        $queryRes = mysqli_query($objConfig->mySQLLink,$strQuery);
        if(mysqli_num_rows($queryRes) > 0){
            return $queryRes;
        }
        else{
            return false;
        }
    }
    
    
    public function insertQuery($table, $cols, $vals){
        $objConfig = new config;
        $strQuery = "INSERT INTO $table ($cols) VALUES ($vals)";
        $queryRes = mysqli_query($objConfig->mySQLLink,$strQuery);
        return $queryRes;
    }
    
    
    public function updateQuery($table, $colAndVals, $cond){
        $objConfig = new config;
        $strQuery = "UPDATE $table SET $colAndVals WHERE $cond";
        $queryRes = mysqli_query($objConfig->mySQLLink,$strQuery);
        if(mysqli_affected_rows($objConfig->mySQLLink) > 0){
            return true;
        }
        else{
            //return false;
            return mysqli_error($objConfig->mySQLLink);
        }
    }
    
    public function deleteQuery($table, $cond){
        $objConfig = new config;
        $strQuery = "DELETE FROM $table WHERE $cond";
        $queryRes = mysqli_query($objConfig->mySQLLink,$strQuery);
        if(mysqli_affected_rows($objConfig->mySQLLink) > 0){
            return true;
        }
        else{
            //echo 
            //return mysqli_error($link);
            return false;
        }
    }
}
?>