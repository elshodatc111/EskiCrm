<?php
    include("../../confige/confige.php");
    $Confige = new Confige;

    if(isset($_GET['delete'])){
        $GuruhID = $_GET['GuruhID'];
        $sqldel = "DELETE FROM `guruh` WHERE `GuruhID`='".$GuruhID."'";
        if($Confige->InsertInto($sqldel)){
            $sqldel1 = "DELETE FROM `user_techer_guruh` WHERE `GuruhID`='".$GuruhID."'";
            $Confige->InsertInto($sqldel1);
            header("location: ../guruhlar.php?delete=true");
        }else{
            echo "No";
        }
    }
    if(isset($_GET['deleteuser'])){
        $UserID = $_GET['UserID'];
        $GuruhID = $_GET['GuruhID'];
        $sqldel3 = "DELETE FROM `guruh_users` WHERE `GuruhID`='".$GuruhID."' AND `UserID`='".$UserID."'";
        if($Confige->InsertInto($sqldel3)){
            header("location: ../guruh_eye.php?deleteuser=true&GuruhID=".$GuruhID."");
        }else{
            echo "No";
        }
    }
    if(isset($_GET['deletetulov'])){
        $id = $_GET['id'];
        $GuruhID = $_GET['GuruhID'];
        $sqldel2 = "DELETE FROM `user_student_tulov` WHERE `id`='".$id."' AND `GuruhID`='".$GuruhID."'";
        if($Confige->InsertInto($sqldel2)){
            header("location: ../guruh_eye.php?deletetulov=true&GuruhID=".$GuruhID."");
        }else{
            echo "No";
        }
    }
    if(isset($_GET['deletetecher'])){
        $id = $_GET['id'];
        $GuruhID = $_GET['GuruhID'];
        $sqldel1 = "DELETE FROM `user_techer_guruh` WHERE `GuruhID`='".$GuruhID."' AND `id`='".$id."'";
        if($Confige->InsertInto($sqldel1)){
            header("location: ../guruh_eye.php?deletetecher=true&GuruhID=".$GuruhID."");
        }else{
            echo "No";
        }
    }
    if(isset($_POST['tulovEdit'])){
        $summa = $_POST['summa'];
        $id=$_GET['id'];
        $GuruhID=$_GET['GuruhID'];
        $sql2 = "UPDATE `user_student_tulov` SET `Summa`='".$summa."' WHERE `id`='".$id."' AND `GuruhID`='".$GuruhID."'";
        if($Confige->InsertInto($sql2)){
            header("location: ../guruh_eye.php?EDITTULOV=true&GuruhID=".$GuruhID."");
        }else{
            echo "No";
        }
    }
    if(isset($_POST['guruhEdit'])){
        $guruhname = str_replace("'","`",$_POST['guruhname']);
        $summa = $_POST['summa'];
        $Start = $_POST['Start'];
        $End = $_POST['End'];
        $GuruhID = $_GET['GuruhID'];
        $TulovTech = $_POST['TulovTech'];
        $TulovBonus = $_POST['TulovBonus'];
        
        $sql3 = "UPDATE `guruh` SET `GuruhName`='".$guruhname."',`Summa`='".$summa."',`Start`='".$Start."',`End`='".$End."' WHERE `GuruhID`='".$GuruhID."'";
        if($Confige->InsertInto($sql3)){
            $sql4 = "UPDATE `guruh_bonus` SET `Tulov`='".$TulovTech."',`Bonus`='".$TulovBonus."' WHERE `GuruhID`='".$GuruhID."'";
            if($Confige->InsertInto($sql4)){
                $sql5 = "UPDATE `xona_vaqt` SET `Start`='".$Start."',`End`='".$End."' WHERE `GuruhID`='".$GuruhID."'";
                if($Confige->InsertInto($sql5)){
                    header("location: ../guruhlar.php?edetguruh=true");
                }
            }
        }
        echo "Error";
    }


?>