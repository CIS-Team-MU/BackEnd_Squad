<?php
require_once("config.php");
class control{
    //Public Validation
    //admin function
    public function validateadminLogin($name,$pass,$choose){
        $errorArr = array();
        if(strlen($pass) < 6){
            $errorArr[] = false;
            $errorArr[] = "Password is too short.";
        }
        elseif(strlen($name) <=4){
            $errorArr[] = false;
            $errorArr[] = "your name is too short..";
        }
        elseif($choose==NULL)
        {
            $errorArr[] = false;
            $errorArr[] = "Enter your permission.";
        }
        else{
            //Passing to Private MODEL function.
           
            $loginRes = $this->passToadminLogin($name,$pass);
            if($loginRes == false){
                $errorArr[] = false;
                $errorArr[] = "Wrong name or password.";
            }
            else{
                $errorArr[] = true;
                $errorArr[] = $loginRes;
            }
        }
        return $errorArr;
    }
    //chef function
    public function validatechefLogin($name,$pass,$choose){
        $errorArr = array();
        if(strlen($pass) < 6){
            $errorArr[] = false;
            $errorArr[] = "Password is too short.";
        }
        elseif(strlen($name) <=4){
            $errorArr[] = false;
            $errorArr[] = "your name is too short..";
        }
        elseif($choose==NULL)
        {
            $errorArr[] = false;
            $errorArr[] = "Enter your permission.";
        }
        else{
            //Passing to Private MODEL function.
           
            $loginRes = $this->passTochefLogin($name,$pass);
            if($loginRes == false){
                $errorArr[] = false;
                $errorArr[] = "Wrong name or password.";
            }
            else{
                $errorArr[] = true;
                $errorArr[] = $loginRes;
            }
        }
        return $errorArr;
    }
    public function validateclientLogin($name,$pass,$choose){
        $errorArr = array();
        if(strlen($pass) < 6){
            $errorArr[] = false;
            $errorArr[] = "Password is too short.";
        }
        elseif(strlen($name) <=4){
            $errorArr[] = false;
            $errorArr[] = "your name is too short..";
        }
        elseif($choose==NULL)
        {
            $errorArr[] = false;
            $errorArr[] = "Enter your permission.";
        }
        else{
            //Passing to Private MODEL function.
           
            $loginRes = $this->passToclientLogin($name,$pass);
            if($loginRes == false){
                $errorArr[] = false;
                $errorArr[] = "Wrong name or password.";
            }
            else{
                $errorArr[] = true;
                $errorArr[] = $loginRes;
            }
        }
        return $errorArr;
    }
    public function validateclientregister($name,$pass,$choose){
        $errorArr = array();
        if(strlen($pass) < 6){
            $errorArr[] = false;
            $errorArr[] = "Password is too short.";
        }
        elseif(strlen($name) <=4){
            $errorArr[] = false;
            $errorArr[] = "your name is too short..";
        }
        elseif($choose==NULL)
        {
            $errorArr[] = false;
            $errorArr[] = "Enter your permission.";
        }
        else{
            //Passing to Private MODEL function.
           
            $loginRes = $this->passToclientregister($name,$pass);
            if($loginRes == true){
                $errorArr[] = false;
                $errorArr[] = "you aready have account";
            }
            else{
                $errorArr[] = true;
                $errorArr[] = $loginRes;
            }
        }
        return $errorArr;
    }
    public function validatereserve($date_reserve,$time_reserve,$name,$number,$email,$phone)
    {
        $errorArr = array();
        if($date_reserve==NULL){
            $errorArr[] = false;
            $errorArr[] = "enter your date.";
        }
        elseif($time_reserve==NULL)
        {
            $errorArr[] = false;
            $errorArr[] = "enter your time..";
        }
        elseif($number==NULL)
        {
            $errorArr[] = false;
            $errorArr[] = "enter your table number.";
        }
        elseif($name==NULL)
        {
            $errorArr[] = false;
            $errorArr[] = "enter your name.";
        }
        elseif($email==NULL)
        {
            $errorArr[] = false;
            $errorArr[] = "enter your email.";
        }
        elseif($phone==NULL)
        {
            $errorArr[] = false;
            $errorArr[] = "enter your phone.";
        }
        else{
            //Passing to Private MODEL function.
           
            $loginRes = $this->passreservation($date_reserve,$time_reserve,$name);
            if($loginRes == true){
                $errorArr[] = false;
                $errorArr[] = "sorry you aready have reservation";
            }
            else{
                $errorArr[] = true;
                $errorArr[] = $loginRes;
            }
        }
        return $errorArr;
    }


    //Private Passing to MODEL
    private function passToadminLogin($name,$pass){
        $objModel = new model;
        $loginQuesryRes = $objModel->selectQuery("admin","id",
        "name='$name' AND password='$pass'");
        return $loginQuesryRes;
    }

    private function passTochefLogin($name,$pass){
        $objModel = new model;
        $loginQuesryRes = $objModel->selectQuery("stuff","id",
        "name='$name' AND password='$pass'");
        return $loginQuesryRes;
    }
    private function passToclientLogin($name,$pass){
        $objModel = new model;
        $loginQuesryRes = $objModel->selectQuery("client","id",
        "username='$name' AND password='$pass'");
        return $loginQuesryRes;
    }
    private function passToclientregister($name,$pass){
        $objModel = new model;
        $loginQuesryRes = $objModel->selectQuery("client","id",
        "username='$name' AND password='$pass'");
        return $loginQuesryRes;
    }
    private function passreservation($date_reserve,$time_reserve,$name){
        $objModel = new model;
        $loginQuesryRes = $objModel->selectQuery("reservation","*",
        "date_reserve='$date_reserve' AND time_reserve='$time_reserve' AND name='$name'");
        return $loginQuesryRes;
    }
}
?>