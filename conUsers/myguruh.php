<?php
    include("../confige/confige.php");
    $Confige = new Confige;
    if(isset($_COOKIE['Username'])){
        if(isset($_POST['GuruhPlus'])){
            $date = array("Dushanba","Seshanba","Chorshanba","Payshanba","Juma","Shanba");
            $GuruhID = time();
            $GuruhName = str_replace("'","`",$_POST['GuruhName']);
            $CoursID = str_replace("'","`",$_POST['CoursID']);
            $TulovCount = str_replace("'","`",$_POST['TulovCount']);
            $TulovSumma = str_replace(",","",str_replace("'","`",$_POST['TulovSumma']));
            $startTime = str_replace("'","`",$_POST['startTime']);
            $endTime = str_replace("'","`",$_POST['endTime']);
            $xona = str_replace("'","`",$_POST['xona']);
            $count = 0;
            $tulov = str_replace(",","",$_POST['tulov']);
            $bonus = str_replace(",","",$_POST['bonus']);
            if(empty(!$_POST['Dushanba'])){
                $Xafta = 'Dushanba';
                $sqlRooms1 = "INSERT INTO `xona_vaqt`(`id`, `Xona`, `GuruhID`, `Xafta`, `Start`, `End`, `Soat`)
                VALUES (NULL,'".$xona."','".$GuruhID."','".$Xafta."','".$startTime."','".$endTime."','".$_POST[$Xafta]."')";
                if($Confige->InsertInto($sqlRooms1)){
                    echo $Xafta;
                    $count = $count+1;
                }
            }
            if(empty(!$_POST['Seshanba'])){
                $Xafta = 'Seshanba';
                $sqlRooms2 = "INSERT INTO `xona_vaqt`(`id`, `Xona`, `GuruhID`, `Xafta`, `Start`, `End`, `Soat`)
                VALUES (NULL,'".$xona."','".$GuruhID."','".$Xafta."','".$startTime."','".$endTime."','".$_POST[$Xafta]."')";
                if($Confige->InsertInto($sqlRooms2)){
                    echo $Xafta;
                    $count = $count+1;
                }
            }
            if(empty(!$_POST['Chorshanba'])){
                $Xafta = 'Chorshanba';
                $sqlRooms3 = "INSERT INTO `xona_vaqt`(`id`, `Xona`, `GuruhID`, `Xafta`, `Start`, `End`, `Soat`)
                VALUES (NULL,'".$xona."','".$GuruhID."','".$Xafta."','".$startTime."','".$endTime."','".$_POST[$Xafta]."')";
                if($Confige->InsertInto($sqlRooms3)){
                    echo $Xafta;
                    $count = $count+1;
                }
            }
            if(empty(!$_POST['Payshanba'])){
                $Xafta = 'Payshanba';
                $sqlRooms4 = "INSERT INTO `xona_vaqt`(`id`, `Xona`, `GuruhID`, `Xafta`, `Start`, `End`, `Soat`)
                VALUES (NULL,'".$xona."','".$GuruhID."','".$Xafta."','".$startTime."','".$endTime."','".$_POST[$Xafta]."')";
                if($Confige->InsertInto($sqlRooms4)){
                    echo $Xafta;
                    $count = $count+1;
                }
            }
            if(empty(!$_POST['Juma'])){
                $Xafta = 'Juma';
                $sqlRooms5 = "INSERT INTO `xona_vaqt`(`id`, `Xona`, `GuruhID`, `Xafta`, `Start`, `End`, `Soat`)
                VALUES (NULL,'".$xona."','".$GuruhID."','".$Xafta."','".$startTime."','".$endTime."','".$_POST[$Xafta]."')";
                if($Confige->InsertInto($sqlRooms5)){
                    echo $Xafta;
                    $count = $count+1;
                }
            }
            if(empty(!$_POST['Shanba'])){
                $Xafta = 'Shanba';
                $sqlRooms6 = "INSERT INTO `xona_vaqt`(`id`, `Xona`, `GuruhID`, `Xafta`, `Start`, `End`, `Soat`)
                VALUES (NULL,'".$xona."','".$GuruhID."','".$Xafta."','".$startTime."','".$endTime."','".$_POST[$Xafta]."')";
                if($Confige->InsertInto($sqlRooms6)){
                    echo $Xafta;
                    $count = $count+1;
                }
            }
            if($count>0){
                $sqlGuruh = "INSERT INTO `guruh`(`id`, `GuruhID`, `GuruhName`, `CoursID`, `TulovCount`, `Summa`, `Start`, `End`, `Xona`, `Operator`, `Data`)
                VALUES (NULL,'".$GuruhID."','".$GuruhName."','".$CoursID."','".$TulovCount."','".$TulovSumma."','".$startTime."','".$endTime."','".$xona."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                if($Confige->InsertInto($sqlGuruh)){
                    $GuruhPlusHistory = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                    VALUES (NULL,'".$_COOKIE['Username']."','".$GuruhName." nomi guruh ochdi','".time()."')";
                    if($Confige->InsertInto($GuruhPlusHistory)){
                        $sqlbounus = "INSERT INTO `guruh_bonus`(`id`, `GuruhID`, `Tulov`, `Bonus`) VALUES (NULL,'".$GuruhID."','".$tulov."','".$bonus."')";
                        if($Confige->InsertInto($sqlbounus)){
                            header("location: ../guruh.php?newGuruh=true");
                        }
                    }
                }
            }else{
                header("location: ../guruh.php?timeError=true");
            }
        }
        if(isset($_POST['guruhTechOlus'])){
            $GuruhID = $_GET['GuruhID'];
            $TecherID = $_POST['TecherID'];
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $sqlGurTech = "INSERT INTO `user_techer_guruh`(`id`, `GuruhID`, `TecherID`, `Izoh`, `Data`)
            VALUES (NULL,'".$GuruhID."','".$TecherID."','".$Izoh."',CURRENT_TIMESTAMP)";
            $GuruhPlusHistory2 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
            VALUES (NULL,'".$_COOKIE['Username']."','".$GuruhID." Guruhga o`qituvchi qo`shdi','".time()."')";
            $selSql = "SELECT * FROM `user_techer_guruh` WHERE `GuruhID`='".$GuruhID."' AND `TecherID`='".$TecherID."'";
            $selres = $Confige->SelectAll($selSql);
            if($selres->num_rows>0){
                header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&techGurPlusError=true");
            }else{
                if($Confige->InsertInto($sqlGurTech)){
                    if($Confige->InsertInto($GuruhPlusHistory2)){
                        header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&techGurPlus=true");
                    }
                }
            }
            
        }
        if(isset($_POST['GuruhStudentPlus'])){
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $StudentID = $_POST['StudentID'];
            $GuruhID = $_GET['GuruhID'];
            $tulovType = $_POST['tulovType'];
            $summa = str_replace(",","",$_POST['summa']);
            $chegirma = str_replace(",","",$_POST['chegirma']);
            $typing = "SELECT * FROM `guruh_users` WHERE `GuruhID`='".$GuruhID."' AND `UserID`='".$StudentID."'";
            $resTyping = $Confige->SelectAll($typing);
            if($resTyping->num_rows>0){
                header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&guruhdamavjud=true");
            }else{
                $sql01 = "INSERT INTO `guruh_users`(`id`, `GuruhID`, `UserID`, `Izoh`, `Data`)
                VALUES (NULL,'".$GuruhID."','".$StudentID."','".$Izoh."',CURRENT_TIMESTAMP)";
                $sql02 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`)
                VALUES (NULL,'".$_COOKIE['Username']."','".$StudentID." talabani ".$GuruhID." guruhga qo`shdi',".time().")";
                $sql03 = "INSERT INTO `user_student_history`(`id`, `GuruhID`, `UserID`, `Comment`, `Data`)
                VALUES (NULL,'".$GuruhID."','".$StudentID."','Student guruhga qo`shildi',CURRENT_TIMESTAMP)";
                if($Confige->InsertInto($sql01)){
                    if($Confige->InsertInto($sql02)){
                        if($Confige->InsertInto($sql03)){
                            $sql88 = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
                            VALUES (NULL,'".$GuruhID."','".$StudentID."','$summa','".$tulovType."','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)"; 
                            $sql77 = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
                            VALUES (NULL,'".$GuruhID."','".$StudentID."','$chegirma','Chegirma','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                            if($summa==='0'){
                                if($chegirma===0){
                                    header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&guruhstudentplus=true");
                                }else{
                                    if($Confige->InsertInto($sql77)){
                                        header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&guruhstudentplus=true");
                                    }
                                }
                            }else{
                                if($Confige->InsertInto($sql88)){
                                    if($chegirma==='0'){
                                        header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&guruhstudentplus=true");
                                    }else{
                                        if($Confige->InsertInto($sql77)){
                                            header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&guruhstudentplus=true");
                                        }
                                    }
                                }
                            }
                            
                        }
                    }
                }
            }
        }
        if(isset($_POST['guruhstudenttulovplus'])){
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $summa = str_replace(",","",$_POST['summa']);
            $tulovType = $_POST['tulovType'];
            $User_ID = $_POST['User_ID'];
            $GuruhID = $_GET['GuruhID'];
            $chegirma = str_replace(",","",$_POST['chegirma']);
            $sql03 = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
            VALUES (NULL,'".$_COOKIE['Username']."','".$GuruhID." ga ".$summa." To`lov qilindi','".time()."')";
            $sql04="INSERT INTO `user_student_history`(`id`, `GuruhID`, `UserID`, `Comment`, `Data`)
            VALUES (NULL,'".$GuruhID."','".$User_ID."','".$summa." Guruhga to`lov qilindi',CURRENT_TIMESTAMP)";  
            $sql88 = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
            VALUES (NULL,'".$GuruhID."','".$User_ID."','$summa','".$tulovType."','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)"; 
            $sql77 = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
            VALUES (NULL,'".$GuruhID."','".$User_ID."','".$chegirma."','Chegirma','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";  
            
            if($Confige->InsertInto($sql03)){
                if($Confige->InsertInto($sql04)){
                    if($summa==='0'){
                        if($chegirma===0){
                            header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&tulovplus=true");
                        }else{
                            if($Confige->InsertInto($sql77)){
                                header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&tulovplus=true");
                            }
                        }
                    }else{
                        
                        if($Confige->InsertInto($sql88)){
                            if($chegirma==='0'){
                                header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&tulovplus=true");
                            }else{
                                if($Confige->InsertInto($sql77)){
                                    header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."&tulovplus=true");
                                }
                            }
                        }
                    }
                }
            }
        }
        
        if(isset($_POST['editgroups'])){
            $guruhnames = str_replace("'","`",$_POST['guruhnames']);
            $GuruhID = $_GET['GuruhID'];
            $sqledit = "UPDATE `guruh` SET `GuruhName`='".$guruhnames."' WHERE `GuruhID`='".$GuruhID."'";
            if($Confige->InsertInto($sqledit)){
                header("location: ../blog/guruh_eye.php?GuruhID=".$GuruhID."");
            }
        }



















    }else{
        header("location: ../login.php");
    }
?>