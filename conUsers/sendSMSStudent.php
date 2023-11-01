<?php
    include("../confige/confige.php");
    $Confige = new Confige;
    if(isset($_COOKIE['Username'])){
        $curl = curl_init();
        if(isset($_POST['SendMessegeStudent'])){
            $StudentID = $_GET['StudentID'];
            $Phone = $_POST['Phone'];
            $Messege = str_replace("'","`",$_POST['Messege']);
            $sms = [
                [
                    'phone' => $Phone,
                    'text'  => $Messege."\n ATKO TEAM o'quv markazi",
                ]
            ];
            $data = 'login='.urlencode('betatest');
            $data .= '&password='.urlencode('q3a6meer1PqZe7PtrZ4A');
            $data .= '&data='.urlencode(json_encode($sms));
            curl_setopt($curl, CURLOPT_URL, 'http://185.8.212.184/smsgateway/');
            curl_setopt($curl, CURLOPT_HEADER, 0); 
            curl_setopt($curl, CURLOPT_POST, 1); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5); 
            curl_setopt($curl, CURLOPT_TIMEOUT, 5); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
            curl_setopt($curl, CURLOPT_USERAGENT, 'Opera 10.00'); 
            $res = curl_exec($curl); 
            /*
            $insert = "INSERT INTO `sendsms`(`id`, `UserID`, `Phone`, `Messeg`, `Data`)
            VALUES (NULL,'".$StudentID."','".$Phone."','".$Messege."',CURRENT_TIMESTAMP)";
            if($Confige->InsertInto($insert)){
            */
                header("location: ../blog/tashrif_eye.php?StudentID=".$StudentID."&sendmes=true");
            /*
            }
            */
        }


        if(isset($_POST['SendMessegeTecher'])){
            $StudentID = $_GET['TechID'];
            $Phone = $_POST['Phone'];
            $Messege = str_replace("'","`",$_POST['Matn']);
            $sms = [
                [
                    'phone' => $Phone,
                    'text'  => $Messege."\n ATKO TEAM o'quv markazi",
                ]
            ];
            $data = 'login='.urlencode('betatest');
            $data .= '&password='.urlencode('q3a6meer1PqZe7PtrZ4A');
            $data .= '&data='.urlencode(json_encode($sms));
            curl_setopt($curl, CURLOPT_URL, 'http://185.8.212.184/smsgateway/');
            curl_setopt($curl, CURLOPT_HEADER, 0); 
            curl_setopt($curl, CURLOPT_POST, 1); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5); 
            curl_setopt($curl, CURLOPT_TIMEOUT, 5); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
            curl_setopt($curl, CURLOPT_USERAGENT, 'Opera 10.00'); 
            $res = curl_exec($curl); 
            /*
            $insert = "INSERT INTO `sendsms`(`id`, `UserID`, `Phone`, `Messeg`, `Data`)
            VALUES (NULL,'".$StudentID."','".$Phone."','".$Messege."',CURRENT_TIMESTAMP)";
            if($Confige->InsertInto($insert)){
            */
                header("location: ../blog/techer_eye.php?TechID=".$StudentID."&sendmes=true");
                /*
            }
            */
        }



        curl_close($curl);
    }else{
        header("location: ../login.php");
    }  
?>