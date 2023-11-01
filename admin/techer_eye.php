<?php
    include("../../confige/confige.php");
    $Confige = new Confige;

    if(isset($_GET['techerDel'])){
        $tuldel = "DELETE FROM `user_techer_guruh` WHERE `GuruhID`='".$_GET['GuruhID']."' AND `TecherID`='".$_GET['TecherID']."'";
        if($Confige->InsertInto($tuldel)){
            header("location: ../techer_eye.php?TecherID=".$_GET['TecherID']."");
        }else{
            echo "No";
        }
    }
    if(isset($_GET['techdel'])){
        $tuldel = "DELETE FROM `user_techer` WHERE `TecherID`='".$_GET['TecherID']."'";
        if($Confige->InsertInto($tuldel)){
            header("location: ../techer.php");
        }else{
            echo "No";
        }
    }
    if(isset($_GET['techtulovdel'])){
        $tuldel = "DELETE FROM `user_techer_ish_haqi` WHERE `id`='".$_GET['id']."'";
        if($Confige->InsertInto($tuldel)){
            header("location: ../techer_eye.php?TecherID=".$_GET['TecherID']."");
        }else{
            echo "No";
        }
    }


?>