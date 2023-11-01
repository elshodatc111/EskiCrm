<?php
  include("../confige/confige.php");
  include("../confige/topHeader2.php");
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Kvitansiya</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <link href="../assets/images/logo.png" rel="icon">
        <link href="../assets/images/apple-touch-icon.png" rel="apple-touch-icon">
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
        <link href="../assets/css/style.css" rel="stylesheet">
        <link href="../assets/css/style2.css" rel="stylesheet">
    </head>
   <body>
        <div class='container py-2'>
            <?php
                $sql = "SELECT user_student.FIO, user_meneger.FIO AS `operator`, user_student_tulov.Summa, user_student_tulov.TulovType, user_student_tulov.Izoh, user_student_tulov.Data, guruh.GuruhName FROM `user_student_tulov` JOIN `guruh` ON user_student_tulov.GuruhID=guruh.GuruhID JOIN `user_student` ON user_student_tulov.UserID=user_student.StudentID JOIN `user_meneger` ON user_student_tulov.Operator=user_meneger.Username WHERE user_student_tulov.id='".$_GET['checkID']."'";
                $res = $Confige->SelectAll($sql);
                $row = $res->fetch_assoc();
                $summa = $row['Summa'];
                
            ?>
            <table class="table text-center table-bordered" style="border:1px solid #000;font-size:12px;font-family: 'Times New Roman', Times, serif;">
              <tbody>
                <tr>
                  <td rowspan='5'>YATT Tulanov Abbos Abrorovich<br/><br/>Qashi sh. Mustaqillik shox ko’chasi 2-uy</td>
                  <td><b>Sana: </b><?php echo $row['Data']; ?></td>
                  <td><b>Chek raqami: </b><?php echo $_GET['checkID']; ?></td>
                </tr>
                <tr><td colspan='2'>O’quv va ta’lim kurslari, shu jumladan individual repititorlik xizmatlari </td></tr>
                <tr>
                  <td><b>Guruh: </b><?php echo $row['GuruhName']; ?> </td>
                  <td><b>Talaba: </b><?php echo $row['FIO']; ?></td>
                </tr>
                <tr>
                  <td><b>To'lov turi: </b><?php echo $row['TulovType']; ?></td>
                  <td><b>To'lov summasi: </b><?php echo number_format($summa)." So`m"; ?></td>
                </tr>
                <tr>
                  <td><b>Izoh: </b><?php echo $row['Izoh']; ?></td>
                  <td><b>Meneger: </b><?php echo $row['operator']; ?></td>
                </tr>
              </tbody>
            </table>
        </div>
    </body>
</html>