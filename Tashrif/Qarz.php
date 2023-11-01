<?php
echo "<h5 class='card-title'>Qarzdor talabalar <i>(Barchasi)</i></h5>";
echo "<div class='table-responsive text-nowrap'>
  <table class='table table-bordered border-primary table-striped datatable'>
    <thead >
      <tr>
        <th>#</th>
        <th>FIO</th>
        <th>Telefon raqam</th>
        <th>Guruh</th>
        <th>Qarzdorlik</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>";
    
    $i=1;
    $SqlUser = "SELECT * FROM `user_student`";
    $ResUser = $Confige->SelectAll($SqlUser);
    if($ResUser->num_rows>0){
      while($RowUser = $ResUser->fetch_assoc()){
        $SqlGuruh = "SELECT * FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh_users.UserID='".$RowUser['StudentID']."'";
        $ResGuruh = $Confige->SelectAll($SqlGuruh);
        if($ResGuruh->num_rows>0){
          while ($RowGuruh = $ResGuruh->fetch_assoc()) {
            $SqlTulov = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$RowGuruh['GuruhID']."' AND `UserID`='".$RowUser['StudentID']."'";
            $ResTulov = $Confige->SelectAll($SqlTulov);
            $JamiTulov = $RowGuruh['TulovCount']*$RowGuruh['Summa'];
            $Tulovlar = 0;
            if($ResTulov->num_rows>0){
              while ($RowTulov = $ResTulov->fetch_assoc()) {
                $Tulovlar = $Tulovlar + $RowTulov['Summa'];
              }
            }
            $Qarz = $JamiTulov-$Tulovlar;
            if($Qarz>0){
              echo "<tr>
                <td class='text-center'>".$i."</td>
                <td>".$RowUser['FIO']."</td>
                <td class='text-center'>".$RowUser['Phone']."</td>
                <td>".$RowGuruh['GuruhName']."</td>
                <td class='text-center'>".$Qarz."</td>
                <td class='text-center'><a href='./blog/tashrif_eye.php?StudentID=".$RowUser['StudentID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
              </tr>";
              $i++;
            }
          }
        }
      }
    }
echo "</tbody></table></div>";
?>