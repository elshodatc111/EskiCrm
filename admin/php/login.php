<?php
    include("../../confige/confige.php");
    $Confige = new Confige;

    if(isset($_POST['login'])){
        $login = str_replace("'","`",$_POST['username']);
        $password = md5($_POST['password']);
        $sqlLogin = "SELECT * FROM `admin_user` WHERE `Username`='".$login."' AND `Password`='".$password."'";
        $reslogin = $Confige->SelectAll($sqlLogin);
        if($reslogin->num_rows>0){
            $rowlogin = $reslogin->fetch_assoc();
            $fio = $rowlogin['FIO'];
            setcookie("Login", $login, time() + 1800, "/");
            setcookie("fio", $fio, time() + 1800, "/");
            header("location: ../index.php");
        }else{
            header("location: ../login.php?error=true");
        }
    }

?>