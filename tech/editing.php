<?php
  session_start();
  include("../confige/confige.php");
  $Confige = new Confige;

    if(isset($_POST['login'])){
        $username = str_replace("'","`",$_POST['username']);
        $password = md5($_POST['password']);
        $sqlLogin = "SELECT * FROM `user_tech_pass` WHERE `Username`='".$username."' AND `Password`='".$password."'";
        $resLogin = $Confige->SelectAll($sqlLogin);
        if($resLogin->num_rows>0){
            $rowLogin = $resLogin->fetch_assoc();
            $UserID = $rowLogin['UserID'];
            $sqlTech = "SELECT * FROM `user_techer` WHERE `TecherID`='".$UserID."'";
            $resTech = $Confige->SelectAll($sqlTech);
            $rowTech = $resTech->fetch_assoc();
            $FIO = $rowTech['TecherName'];
            $_SESSION['FIO'] = $FIO;
            $_SESSION['UserID'] = $UserID;
            $_SESSION['Username'] = $username;
            header("location: ./index.php");
        }else{
            header("location: ./login.php?error=true");
        }
    }
    if(isset($_POST['edetTecher'])){
        $UserID = $_SESSION['UserID'];
        $FIO = str_replace("'","`",$_POST['FIO']);
        $Manzil = str_replace("'","`",$_POST['Manzil']);
        $Phone = str_replace("'","`",$_POST['Phone']);
        $sqlEdit = "UPDATE `user_techer` SET `TecherName`='".$FIO."',`Phone`='".$Phone."',`Addres`='".$Manzil."' WHERE `TecherID`='".$UserID."'";
        if($Confige->InsertInto($sqlEdit)){
            header("location: ./index.php");
        }else{
            echo "error";
        }
    }
    if(isset($_POST['passwordEdit'])){
        $password = md5($_POST['password']);
        $UserID = $_SESSION['UserID'];
        $sqlpass = "UPDATE `user_tech_pass` SET `Password`='".$password."' WHERE `UserID`='".$UserID."'";
        if($Confige->InsertInto($sqlpass)){
            header("location: ./index.php");
        }else{
            echo "error";
        }
    }
    if(isset($_POST['davomatplus'])){
        echo $_GET['GuruhID']."<br>";
        echo date("Y-m-d")."<br>";
        $sql1 = "SELECT * FROM `guruh_users` WHERE `GuruhID`='".$_GET['GuruhID']."'";
        $res1 = $Confige->SelectAll($sql1);
        if($res1->num_rows>0){
            while ($row1 = $res1->fetch_assoc()) {
                echo $row1['UserID']."<br>";
                if(isset($_POST[$row1['UserID']])){
                    $sql2 = "SELECT * FROM `guruh_davomat` WHERE `userID`='".$row1['UserID']."' AND `GuruhID`='".$_GET['GuruhID']."' AND `Date`='".date("Y-m-d")."'";
                    $res2 = $Confige->SelectAll($sql2);
                    if($res2->num_rows>0){
                        echo "bor plus<br>";
                    }else{                        
                        $sql3 = "INSERT INTO `guruh_davomat`(`id`, `UserID`, `GuruhID`, `Date`)
                        VALUES (NULL,'".$row1['UserID']."','".$_GET['GuruhID']."','".date("Y-m-d")."')";
                        if($Confige->InsertInto($sql3)){
                            echo "Yozildi<br>";
                        }else{
                            echo "Yozilmadi<br>";
                        }
                    }                    
                }else{
                    echo "Yoq<br>";
                }
            }
            header("location: ./guruh_eye.php?GuruhID=".$_GET['GuruhID']."");
        }else{
            header("location: ./guruh_eye.php?GuruhID=".$_GET['GuruhID']."");
        }
    }



?>