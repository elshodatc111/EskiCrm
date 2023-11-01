<?php
    include("../confige/confige.php");
    $Confige = new Confige;
    $q = $_GET['q'];
    $sql = "SELECT * FROM `user_student` WHERE `Phone`='".$q."'";
    $res = $Confige->SelectAll($sql);
    if($res->num_rows>0){
        echo "Bu telefon raqam oldin ro'yhatga olingan";
    }
?>