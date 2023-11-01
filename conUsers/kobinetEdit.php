<?php
    include("../confige/confige.php");
    $Confige = new Confige;
    if(isset($_COOKIE['Username'])){

        if(isset($_POST['PasswordEdit'])){
            $pass = md5($_POST['pass']);

            $sql1 = "UPDATE `user_meneger` SET `Password`='".$pass."' WHERE `UserID`='".$_GET['UserID']."'";
            $sql2 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
            VALUES (NULL,'".$_COOKIE['Username']."','Shaxsiy parolini yangiladi','".time()."')";
            if ($Confige->connect()->query($sql2)) {
                if ($Confige->connect()->query($sql1)) {
                    header("location: ../blog/kobinet.php?passEdit=true");
                } else {
                    echo "no2";
                }
            } else {
                echo "no";
            }
        }

        if(isset($_POST['kobEdit'])){
            $UserID = $_GET['UserID'];
            $FIO = str_replace("'" ,"`", $_POST['FIO']);
            $Addres = str_replace("'" ,"`", $_POST['Addres']);
            $Phone = str_replace("'" ,"`", $_POST['Phone']);

            $sql1 = "UPDATE `user_meneger` SET `FIO`='".$FIO."',`Phone`='".$Phone."',`Addres`='".$Addres."' WHERE `UserID`='".$UserID."'";
            $sql2 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
            VALUES (NULL,'".$_COOKIE['Username']."','Shaxsiy malumotlarini yangiladi','".time()."')";
            if ($Confige->connect()->query($sql2)) {
                if ($Confige->connect()->query($sql1)) {
                    header("location: ../blog/kobinet.php?EditEdit=true");
                } else {
                    echo "no2";
                }
            } else {
                echo "no";
            }
        }




    }else{
        header("location: ../login.php");
    }  

?>