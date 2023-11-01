tulovPlus<?php
    include("../confige/confige.php");
    $Confige = new Confige;
    if(isset($_COOKIE['Username'])){
        if(isset($_POST['newStudent'])){
            $haqimizda = str_replace("'","`",$_POST['haqimizda']);
            $Addres = str_replace("'","`",$_POST['Addres']);
            $about = str_replace("'","`",$_POST['about']);
            $Tkun = $_POST['Tkun'];
            $TPhone = $_POST['TPhone'];
            $Tanish = str_replace("'","`",$_POST['Tanish']);
            $Phone = $_POST['Phone'];
            $FIO = str_replace("'","`",$_POST['FIO']);
            switch ($Addres) {
                case 10212: $Manzil = "Dexqonobor tumani"; break;
                case 10207: $Manzil = "G`uzor tumani"; break;
                case 10220: $Manzil = "Qamashi tumani"; break;
                case 10224: $Manzil = "Qarshi tumani"; break;
                case 10229: $Manzil = "Koson tumani"; break;
                case 10232: $Manzil = "Kitob tumani"; break;
                case 10233: $Manzil = "Mirishkor tumani"; break;
                case 10234: $Manzil = "Muborak tumani"; break;
                case 10235: $Manzil = "Nishon tumani"; break;
                case 10237: $Manzil = "Kasbi tumani"; break;
                case 10240: $Manzil = "Ko`kdala tumani"; break;
                case 10242: $Manzil = "Chiroqchi tumani"; break;
                case 10245: $Manzil = "Shaxrisabz tumani"; break;
                case 10246: $Manzil = "Shaxrisabz Shaxar"; break;
                case 10250: $Manzil = "Yakkabog` Tuman"; break;
                case 10401: $Manzil = "Qarshi Shaxar"; break;
            default:
                $Manzil = "Qashqadaryo viliyati";
            }
            $sqlTel = "SELECT * FROM `user_student` WHERE `Phone`='".$Phone."'";
            $resTel = $Confige->SelectAll($sqlTel);
            if($resTel->num_rows>0){
                header("location: ../tashrif.php?telError=true");
            }else{
                $sqlPlus = "INSERT INTO `user_student`(`id`, `StudentID`, `FIO`, `Phone`, `Tanish`, `TPhone`, `Tkun`, `About`, `AddresCode`, `AddresName`, `Haqimizda`, `Operator`, `Data`)
                VALUES (NULL,'".time()."','".$FIO."','".$Phone."','".$Tanish."','".$TPhone."','".$Tkun."','".$about."','".$Addres."','".$Manzil."','".$haqimizda."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                if($Confige->InsertInto($sqlPlus)){
                    $hisolus = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                    VALUES (NULL,'".$_COOKIE['Username']."','".$FIO." Yangi tashrif qo`shdi','".time()."')";
                    if($Confige->InsertInto($hisolus)){
                        header("location: ../tashrif.php?tashPlus=true");
                    }
                }
            }
            
        }
        if(isset($_POST['GuruhPlus'])){
            $GuruhID = $_POST['GuruhID'];
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $StudentID = $_GET['StudentID'];
            $sqlPlus = "INSERT INTO `guruh_users`(`id`, `GuruhID`, `UserID`, `Izoh`, `Data`) 
            VALUES (NULL,'".$GuruhID."','".$StudentID."','".$Izoh."',CURRENT_TIMESTAMP)";
            $sqlgg = "SELECT * FROM `guruh_users` WHERE `GuruhID`='".$GuruhID."' AND `UserID`='".$StudentID."'";
            $resgg = $Confige->SelectAll($sqlgg);
            if($resgg->num_rows>0){
                header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&ruyhatdabor=true");
            }
            else{
                if($Confige->InsertInto($sqlPlus)){
                    $hisolus = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                    VALUES (NULL,'".$_COOKIE['Username']."','Guruhga talaba qo`shdi','".time()."')";
                    if($Confige->InsertInto($hisolus)){
                        $stuhistor="INSERT INTO `user_student_history`(`id`, `GuruhID`, `UserID`, `Comment`, `Data`)
                        VALUES (NULL,'".$GuruhID."','".$StudentID."','Guruhni tark etdi',CURRENT_TIMESTAMP)";
                        if($Confige->InsertInto($stuhistor)){
                            header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&stugurolus=true");
                        }
                    }
                }
            }
        }
        if(isset($_POST['tulovPlus'])){
            $guruhid = $_POST['guruhid'];
            $tulovType = $_POST['tulovType'];
            $Summa = str_replace(",","",$_POST['Summa']);
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $Chegirma = str_replace(",","",$_POST['Chegirma']);
            $StudentID = $_GET['StudentID'];
            $chegirmaDay = date('Y-m-d', strtotime('-5 day'));
            $sqlzz = "SELECT * FROM `guruh` WHERE `Start`>='".$chegirmaDay."' AND `GuruhID`='".$guruhid."'";
            $reszz = $Confige->SelectAll($sqlzz);
            if($reszz->num_rows>0){
                if($Chegirma==='0'){
                    if($Summa==='0'){
                        header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&summaerror=true");
                    }else{
                        echo "To'lov qilindi";
                        $stuTulov = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa."','".$tulovType."','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                        $histulov = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                        VALUES (NULL,'".$_COOKIE['Username']."','Guruhga to`lov amalga oshirildi','".time()."')";
                        $sqlTulov="INSERT INTO `user_student_history`(`id`, `GuruhID`, `UserID`, `Comment`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa." Guruhga to`lov(".$tulovType.") qilindi',CURRENT_TIMESTAMP)";
                        if($Confige->InsertInto($sqlTulov)){
                            if($Confige->InsertInto($histulov)){
                                if($Confige->InsertInto($stuTulov)){
                                    header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&tulovplus=true");
                                }
                            }
                        }
                    }
                }else{
                    if($Summa==='0'){
                        echo "To'lov qilindi";
                        $histulov = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                        VALUES (NULL,'".$_COOKIE['Username']."','Guruhga to`lov amalga oshirildi','".time()."')";
                        $sqlTulov="INSERT INTO `user_student_history`(`id`, `GuruhID`, `UserID`, `Comment`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa." Guruhga to`lov(".$tulovType.") qilindi',CURRENT_TIMESTAMP)";
                        $sqlChegirma = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa."','Chegirma','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                        if($Confige->InsertInto($sqlTulov)){
                            if($Confige->InsertInto($histulov)){
                                    if($Confige->InsertInto($sqlChegirma)){
                                        header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&tulovplus=true");
                                    }
                            }
                        }
                    }else{
                        $stuTulov = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa."','".$tulovType."','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                        $histulov = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                        VALUES (NULL,'".$_COOKIE['Username']."','Guruhga to`lov amalga oshirildi','".time()."')";
                        $sqlTulov="INSERT INTO `user_student_history`(`id`, `GuruhID`, `UserID`, `Comment`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa." Guruhga to`lov(".$tulovType.") qilindi',CURRENT_TIMESTAMP)";
                        $sqlChegirma = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','$Chegirma','Chegirma','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                        if($Confige->InsertInto($sqlTulov)){
                            if($Confige->InsertInto($histulov)){
                                if($Confige->InsertInto($stuTulov)){
                                    if($Confige->InsertInto($sqlChegirma)){
                                        header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&tulovplus=true");
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                echo "Guruh Eski";
                if($Chegirma==='0'){
                    if($Summa==='0'){
                        header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&summaerror=true");
                    }else{
                        echo "To'lov qilindi";
                        $stuTulov = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa."','".$tulovType."','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                        $histulov = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                        VALUES (NULL,'".$_COOKIE['Username']."','Guruhga to`lov amalga oshirildi','".time()."')";
                        $sqlTulov="INSERT INTO `user_student_history`(`id`, `GuruhID`, `UserID`, `Comment`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa." Guruhga to`lov(".$tulovType.") qilindi',CURRENT_TIMESTAMP)";
                        if($Confige->InsertInto($sqlTulov)){
                            if($Confige->InsertInto($histulov)){
                                if($Confige->InsertInto($stuTulov)){
                                    header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&tulovplus=true");
                                }
                            }
                        }
                    }
                }else{
                    if($Summa==='0'){
                        header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&chegirmamuddat=true");
                    }else{
                        $stuTulov = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa."','".$tulovType."','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                        $histulov = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                        VALUES (NULL,'".$_COOKIE['Username']."','Guruhga to`lov amalga oshirildi','".time()."')";
                        $sqlTulov="INSERT INTO `user_student_history`(`id`, `GuruhID`, `UserID`, `Comment`, `Data`)
                        VALUES (NULL,'".$guruhid."','".$StudentID."','".$Chegirma." Guruhga to`lov(".$tulovType.") qilindi',CURRENT_TIMESTAMP)";
                        if($Confige->InsertInto($sqlTulov)){
                            if($Confige->InsertInto($histulov)){
                                if($Confige->InsertInto($stuTulov)){
                                    header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&tulovpluschegirmaerror=true");
                                }
                            }
                        }
                    }
                    
                }
                /*
                    $stuTulov = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
                    VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa."','".$tulovType."','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
                    $histulov = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
                    VALUES (NULL,'".$_COOKIE['Username']."','Guruhga to`lov amalga oshirildi','".time()."')";
                    $sqlTulov="INSERT INTO `user_student_history`(`id`, `GuruhID`, `UserID`, `Comment`, `Data`)
                    VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa." Guruhga to`lov(".$tulovType.") qilindi',CURRENT_TIMESTAMP)";
                    if($Confige->InsertInto($sqlTulov)){
                        if($Confige->InsertInto($histulov)){
                            if($Confige->InsertInto($stuTulov)){
                                header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&tulovplus=true");
                            }
                        }
                    }
                */
            }
        }
        if(isset($_POST['studentEdit'])){
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $tphone = $_POST['tphone'];
            $Tanish = str_replace("'","`",$_POST['Tanish']);
            $Phone = str_replace("'","`",$_POST['Phone']);
            $FIO = str_replace("'","`",$_POST['FIO']);
            $StudentID = $_GET['StudentID'];
            $UpdateSql = "UPDATE `user_student` SET `FIO`='".$FIO."',`Phone`='".$Phone."',`Tanish`='".$Tanish."',`TPhone`='".$tphone."',`About`='".$Izoh."' WHERE `StudentID`='".$StudentID."'";
            $hisedit = "INSERT INTO `user_meneger_history`(`id`, `UserID`, `Izoh`, `date`) 
            VALUES (NULL,'".$_COOKIE['Username']."','".$StudentID."Student malumotlarini yangiladi','".time()."')";
            
                if($Confige->InsertInto($UpdateSql)){
                    if($Confige->InsertInto($hisedit)){
                        header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&update=true");
                    }
                }
            
        }
        if(isset($_POST['DeleteGuruh'])){
            $StudentID = $_GET['StudentID'];
            $guruhid = $_POST['guruhid'];
            $tulovType = $_POST['tulovType'];
            $Summa = str_replace(",","",$_POST['Summa']);
            $Izoh = str_replace("'","`",$_POST['Izoh']);
            $sqlqaytar = "INSERT INTO `user_student_tulov`(`id`, `GuruhID`, `UserID`, `Summa`, `TulovType`, `Izoh`, `Operator`, `Data`)
            VALUES (NULL,'".$guruhid."','".$StudentID."','".$Summa."','qaytarildi','".$Izoh."','".$_COOKIE['Username']."',CURRENT_TIMESTAMP)";
            if($Confige->InsertInto($sqlqaytar)){
                $sqlins = "INSERT INTO `qaytar`(`id`, `Summa`, `Type`) VALUES (NULL,'".$Summa."','".$tulovType."')";
                if($Confige->InsertInto($sqlins)){
                    header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&qaytdi=true");
                }
            }
            echo $StudentID;
        }
        if(isset($_POST['Eslatma_qoldirish'])){
            $elstmavaqt = $_POST['elstmavaqt'];
            $eslatma_matni = str_replace("'","`",$_POST['eslatma_matni']);
            $StudentID = $_GET['StudentID'];
            $insertEslatma = "INSERT INTO `user_student_eslatma`(`id`, `UserID`, `Date`, `Matn`)
            VALUES (NULL,'".$StudentID."','".$elstmavaqt."','".$eslatma_matni."')";
            if($Confige->InsertInto($insertEslatma)){
                header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&eslatmaqoldi=true");
            }
        }
        




    }else{
        header("location: ../login.php");
    }  

?>