<?php
    include("../../confige/confige.php");
    $Confige = new Confige;

    if(isset($_GET['miliyadel'])){
        $userid  =$_GET['id'];
        $tashdel = "DELETE FROM `moliya` WHERE `id`='".$userid."'";
        if($Confige->InsertInto($tashdel)){
            header("location: ../moliya.php?delete=true");
        }else{
            echo "No";
        }
    }



?>