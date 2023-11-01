<?php
    include("../confige/confige.php");
    $Confige = new Confige;
    if(isset($_COOKIE['Username'])){

        if(isset($_POST['Plastikchiqim'])){
            $Summa = str_replace(",","",$_POST['Summa']);
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $max = str_replace(" ","",$_GET['max']);
            if($Summa<=$max){
                $sql11 = "INSERT INTO `moliya`(`id`, `TypeTulov`, `TulovSumma`, `ChiqimVaqt`, `Type`, `Izoh`, `Meneger`, `Tasdiqlandi`, `Xisobchi`)
                VALUES (NULL,'Plastik','".$Summa."',CURRENT_TIMESTAMP,'false','".$Izoh."','".$_COOKIE['Username']."','NULL','NULL')";
                if($Confige->InsertInto($sql11)){
                    header("location: ../moliya.php?moliya1=true");
                }else{
                    echo "no";
                }
            }else{
                header("location: ../moliya.php?mavjud=true");
            }
        }
        if(isset($_POST['Naqtchiqim'])){
            $Summa = str_replace(",","",$_POST['Summa']);
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $max = str_replace(" ","",$_GET['max']);
            if($Summa<=$max){
                $sql11 = "INSERT INTO `moliya`(`id`, `TypeTulov`, `TulovSumma`, `ChiqimVaqt`, `Type`, `Izoh`, `Meneger`, `Tasdiqlandi`, `Xisobchi`)
                VALUES (NULL,'Naqt','".$Summa."',CURRENT_TIMESTAMP,'false','".$Izoh."','".$_COOKIE['Username']."','NULL','NULL')";
                if($Confige->InsertInto($sql11)){
                    header("location: ../moliya.php?moliya1=true");
                }else{
                    echo "no";
                }
            }else{
                header("location: ../moliya.php?mavjud=true");
            }
        }
        if(isset($_POST['xarajarPlas'])){
            $Summa = str_replace(",","",$_POST['Summa']);
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $max = str_replace(" ","",$_GET['max']);
            if($Summa<=$max){
                $sql11 = "INSERT INTO `moliya`(`id`, `TypeTulov`, `TulovSumma`, `ChiqimVaqt`, `Type`, `Izoh`, `Meneger`, `Tasdiqlandi`, `Xisobchi`)
                VALUES (NULL,'PlastikXarajat','".$Summa."',CURRENT_TIMESTAMP,'false','".$Izoh."','".$_COOKIE['Username']."','NULL','NULL')";
                if($Confige->InsertInto($sql11)){
                    header("location: ../moliya.php?moliya1=true");
                }else{
                    echo "no";
                }
            }else{
                header("location: ../moliya.php?mavjud=true");
            }
        }

        if(isset($_POST['xarajarNaqt'])){
            $Summa = str_replace(",","",$_POST['Summa']);
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $max = str_replace(" ","",$_GET['max']);
            if($Summa<=$max){
                $sql11 = "INSERT INTO `moliya`(`id`, `TypeTulov`, `TulovSumma`, `ChiqimVaqt`, `Type`, `Izoh`, `Meneger`, `Tasdiqlandi`, `Xisobchi`)
                VALUES (NULL,'NaqtXarajat','".$Summa."',CURRENT_TIMESTAMP,'false','".$Izoh."','".$_COOKIE['Username']."','NULL','NULL')";
                if($Confige->InsertInto($sql11)){
                    header("location: ../moliya.php?moliya1=true");
                }else{
                    echo "no";
                }
            }else{
                header("location: ../moliya.php?mavjud=true");
            }
        }
        if(isset($_GET['tasdiqdelete'])){
            $Summa = str_replace(",","",$_GET['id']);
            $sql11 = "DELETE FROM `moliya` WHERE `id`='".$Summa."'";
            if($Confige->InsertInto($sql11)){
                header("location: ../moliya.php?delete=true");
                echo "id".$Summa;
            }else{
                echo "no";
            }
        }
        if(isset($_GET['tasdiqlash'])){
            $id = $_GET['id'];
            $sql11 = "UPDATE `moliya` SET`Type`='true',`Tasdiqlandi`=CURRENT_TIMESTAMP,`Xisobchi`='".$_COOKIE['Username']."' WHERE `id`='".$id."'";
            if($Confige->InsertInto($sql11)){
                header("location: ../moliya.php?tasdiq=true");
                echo "Update";
            }else{
                echo "no Update";
            }
        }


    }
?>