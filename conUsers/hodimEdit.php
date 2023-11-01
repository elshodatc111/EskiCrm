<?php
    include("../confige/confige.php");
    $Confige = new Confige;
    if(isset($_COOKIE['Username'])){

        if(isset($_POST['EdetOperator'])){
            $UserID = $_GET['UserID'];
            $selectUser = "SELECT * FROM `user_meneger` WHERE `UserID`='".$UserID."'";
            $resUser = $Confige->SelectAll($selectUser);
            $rowsUser = $resUser->fetch_assoc();
            $Username = $rowsUser['Username'];
            $FIO = str_replace("'","`",$_POST['FIO']);
            $Phone = str_replace("'","`",$_POST['Phone']);
            $Addres = str_replace("'","`",$_POST['Addres']);
            $sql1 = "UPDATE `user_meneger` SET `FIO`='".$FIO."',`Phone`='".$Phone."',`Addres`='".$Addres."' WHERE `UserID`='".$UserID."'";
            $sql2 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) VALUES (NULL,'".$Username."','".$Username." malumotlari yangilandi','".time()."')";
            if ($Confige->connect()->query($sql1)) {
                if ($Confige->connect()->query($sql2)) {
                    header("location: ../blog/hodimlar.php?UserID=".$_GET['UserID']."&texrir=true");
                } else {
                    echo "no2";
                }
            } else {
                echo "no";
            }
        }

        if(isset($_POST['editpassword'])){
            $UserID = $_GET['UserID'];
            $selectUser = "SELECT * FROM `user_meneger` WHERE `UserID`='".$UserID."'";
            $resUser = $Confige->SelectAll($selectUser);
            $rowsUser = $resUser->fetch_assoc();
            $Username = $rowsUser['Username'];
            $pass = md5($_POST['Pass']);
            $sql1 = "UPDATE `user_meneger` SET `Password`='".$pass."' WHERE `UserID`='".$UserID."'";
            $sql2 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) VALUES (NULL,'".$Username."','".$Username." operator paroli yangilandi','".time()."')";
            if ($Confige->connect()->query($sql1)) {
                if ($Confige->connect()->query($sql2)) {
                    header("location: ../blog/hodimlar.php?UserID=".$_GET['UserID']."&passEdit=true");
                } else {
                    echo "no2";
                }
            } else {
                echo "no";
            }
        }

        if(isset($_POST['ishHaqTulov'])){
            $UserID = $_GET['UserID'];
            $selectUser = "SELECT * FROM `user_meneger` WHERE `UserID`='".$UserID."'";
            $resUser = $Confige->SelectAll($selectUser);
            $rowsUser = $resUser->fetch_assoc();
            $Username = $rowsUser['Username'];
            $summa = $_POST['summa'];
            $izoh = str_replace("'","`",$_POST['izoh']);
            $sql1 = "INSERT INTO `user_meneger_ish_haqi`(`id`, `UserID`, `Summa`, `Izoh`, `Data`) VALUES (NULL,'".$UserID."','".$summa."','".$izoh."',CURRENT_TIMESTAMP)";
            $sql2 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) VALUES (NULL,'".$Username."','".$Username." operatorga ish haqi to`landi','".time()."')";

            if ($Confige->connect()->query($sql1)) {
                if ($Confige->connect()->query($sql2)) {
                    header("location: ../blog/hodimlar.php?UserID=".$_GET['UserID']."&tulovplus=true");
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