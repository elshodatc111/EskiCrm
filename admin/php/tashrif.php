<?php
    include("../../confige/confige.php");
    $Confige = new Confige;

    if(isset($_GET['tashrifdel'])){
        $userid  =$_GET['userid'];
        $tashdel = "DELETE FROM `user_student` WHERE `StudentID`='".$userid."'";
        if($Confige->InsertInto($tashdel)){
            header("location: ../tashrif.php?delete=true");
        }else{
            echo "No";
        }
    }
    if(isset($_POST['tashrifgurdel'])){
        $userid  =$_GET['userid'];
        $tashdel = "DELETE FROM `user_student` WHERE `StudentID`='".$userid."'";
        if($Confige->InsertInto($tashdel)){
            header("location: ../tashrif.php?delete=true");
        }else{
            echo "No";
        }
    }
    if(isset($_GET['tuldel'])){
        $tuldel = "DELETE FROM `user_student_tulov` WHERE `id`='".$_GET['id']."'";
        if($Confige->InsertInto($tuldel)){
            header("location: ../tashrif_eye.php?userid=".$_GET['userid']."");
        }else{
            echo "No";
        }
    }
    if(isset($_GET['tashrifgurdel111'])){
        $tuldel = "DELETE FROM `guruh_users` WHERE `GuruhID`='".$_GET['GuruhID']."' AND `UserID`='".$_GET['userid']."'";
        if($Confige->InsertInto($tuldel)){
            header("location: ../tashrif_eye.php?userid=".$_GET['userid']."");
        }else{
            echo "No";
        }
    }


?>