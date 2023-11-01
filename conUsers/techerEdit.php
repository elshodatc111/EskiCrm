<?php
    include("../confige/confige.php");
    $Confige = new Confige;
    if(isset($_COOKIE['Username'])){
        if(isset($_POST['techerPlus'])){
            $FIO = str_replace("'","`",$_POST['FIO']);
            $Phone = str_replace("'","`",$_POST['Phone']);
            $Manzil = str_replace("'","`",$_POST['Manzil']);
            $tkun = str_replace("'","`",$_POST['tkun']);
            $mutahasis = str_replace("'","`",$_POST['mutahasis']);
            $about = str_replace("'","`",$_POST['about']);

            $sql1 = "INSERT INTO `user_techer`(`id`, `TecherID`, `TecherName`, `Phone`, `Addres`, `TDate`, `Mutahasis`, `About`, `Data`)
            VALUES (NULL,'".time()."','".$FIO."','".$Phone."','".$Manzil."','".$tkun."','".$mutahasis."','".$about."',CURRENT_TIMESTAMP)";
            $sql2 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) VALUES (NULL,'".$_COOKIE['Username']."','Yangi o`qituvchi qo`shdi','".time()."')";
            if ($Confige->connect()->query($sql1)) {
                if ($Confige->connect()->query($sql2)) {
                    header("location: ../techer.php?techPlus=true");
                } else {
                    echo "no2";
                }
            } else {
                echo "no";
            }
        }
        if(isset($_POST['tulovPlus'])){
            $TechID = $_GET['TechID'];
            $Monch = $_POST['Monch'];
            $summa = str_replace(",","",$_POST['summa']);
            $Izoh = str_replace("'","`",$_POST['Izoh']);

            $sql1 = "INSERT INTO `user_techer_ish_haqi`(`id`, `TechID`, `Monch`, `Summa`, `Izoh`, `Data`)
            VALUES (NULL,'".$TechID."','".$Monch."','".$summa."','".$Izoh."',CURRENT_TIMESTAMP)";
            $sql2 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) VALUES (NULL,'".$_COOKIE['Username']."','O`qituvchi oylik ish haqi to`landi','".time()."')";
            if ($Confige->connect()->query($sql1)) {
                if ($Confige->connect()->query($sql2)) {
                    header("location: ../blog/techer_eye.php?TechID=".$TechID."&tulovPlus=true");
                } else {
                    echo "no2";
                }
            } else {
                echo "no";
            }
        }
        if(isset($_POST['TechEdit'])){
            $TechID = $_GET['TechID'];
            $About = str_replace("'","`",$_POST['About']);
            $mutahasis = str_replace("'","`",$_POST['mutahasis']);
            $addres = str_replace("'","`",$_POST['addres']);
            $phone = str_replace("'","`",$_POST['phone']);
            $techname = str_replace("'","`",$_POST['techname']);
            $sqlEdit = "UPDATE `user_techer` SET `TecherName`='".$techname."',`Phone`='".$phone."',`Addres`='".$addres."',`Mutahasis`='".$mutahasis."',`About`='".$About."' WHERE `TecherID`='".$TechID."'";
            if($Confige->InsertInto($sqlEdit)){
                $sqlEditHistory = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                VALUES (NULL,'".$_COOKIE['Username']."','".$techname." o`qituvchi malumotlari yangilandi','".time()."')";
                if($Confige->InsertInto($sqlEditHistory)){
                    header("location: ../blog/techer_eye.php?TechID=".$TechID."&techedit=true");
                }
            }
        }
        if(isset($_POST['TechPlusGuruh'])){
            $GuruhID = $_POST['GuruhID'];
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $TechID = $_GET['TechID'];
            $sqlTechGuruh = "INSERT INTO `user_techer_guruh`(`id`, `GuruhID`, `TecherID`, `Izoh`, `Data`)
            VALUES (NULL,'".$GuruhID."','".$TechID."','".$Izoh."',CURRENT_TIMESTAMP)";
            if($Confige->InsertInto($sqlTechGuruh)){
                $sqlEditHistory = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                VALUES (NULL,'".$_COOKIE['Username']."','".$GuruhID." O`qituvchiga guruh biriktirdi','".time()."')";
                if($Confige->InsertInto($sqlEditHistory)){
                    header("location: ../blog/techer_eye.php?TechID=".$TechID."&guruhPlus=true");
                }
            }
        }
        if(isset($_POST['passPlus'])){
            $username = str_replace("'","`",$_POST['username']);
            $password = md5($_POST['password']);
            $TechID = $_GET['TechID'];
            $sqllogplus = "INSERT INTO `user_tech_pass`(`id`, `UserID`, `Username`, `Password`)
            VALUES (NULL,'".$TechID."','".$username."','".$password."')";
            if($Confige->InsertInto($sqllogplus)){
                header("location: ../blog/techer_eye.php?TechID=".$TechID."");
            }
        }
        if(isset($_POST['edetPassword'])){
            $TechID = $_GET['TechID'];
            $password = md5($_POST['password']);
            $paswEdit = "UPDATE `user_tech_pass` SET `Password`='".$password."' WHERE `UserID`='".$TechID."'";
            if($Confige->InsertInto($paswEdit)){
                header("location: ../blog/techer_eye.php?TechID=".$TechID."");
                echo $password;
            }
        }
        








    }else{
        header("location: ../login.php");
    }      
?>