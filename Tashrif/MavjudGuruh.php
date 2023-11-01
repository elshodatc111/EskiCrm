<?php
if($_POST['vaqt']==='all'){
    echo "<h5 class='card-title'>Guruhga biriktirilgan <i>(Barchasi)</i></h5>";
    $sqlgurYes = "SELECT * FROM `user_student`";
  }elseif($_POST['vaqt']==='kun'){
    echo "<h5 class='card-title'>Guruhga biriktirilgan <i>(Kun boshidan)</i></h5>";
    $sqlgurYes = "SELECT * FROM `user_student` WHERE `Data`>='".$kun." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
  }if($_POST['vaqt']==='hafta'){
    echo "<h5 class='card-title'>Guruhga biriktirilgan <i>(Hafta boshidan)</i></h5>";
    $sqlgurYes = "SELECT * FROM `user_student` WHERE `Data`>='".$haftaBoshi." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
  }if($_POST['vaqt']==='oy'){
    echo "<h5 class='card-title'>Guruhga biriktirilgan <i>(Oy boshidan)</i></h5>";
    $sqlgurYes = "SELECT * FROM `user_student` WHERE `Data`>='".$OyBosh." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
  }if($_POST['vaqt']==='yil'){
    echo "<h5 class='card-title'>Guruhga biriktirilgan <i>(Yil boshidan)</i></h5>";
    $sqlgurYes = "SELECT * FROM `user_student` WHERE `Data`>='".$YilBosh." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
  }
  echo "<div class='table-responsive text-nowrap'>
    <table class='table table-bordered border-primary table-striped datatable'>
      <thead >
        <tr>
          <th>#</th>
          <th>FIO</th>
          <th>Telefon raqam</th>
          <th>Yashash manzil</th>
          <th>Tug'ilgan kuni</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>";
      $resgurYes = $Confige->SelectAll($sqlgurYes);
      $i=1;
      if($resgurYes->num_rows>0){
        while ($rowgurYas = $resgurYes->fetch_assoc()) {
          $sqlgurYes2 = "SELECT * FROM `guruh_users` WHERE `UserID`='".$rowgurYas['StudentID']."'";
          $resgurYes2 = $Confige->SelectAll($sqlgurYes2);
          if($resgurYes2->num_rows>0){
            echo "<tr>
              <td class='text-center'>".$i."</td>
              <td>".$rowgurYas['FIO']."</td>
              <td>".$rowgurYas['Phone']."</td>
              <td>".$rowgurYas['Tanish']."</td>
              <td>".$rowgurYas['TPhone']."</td>
              <td class='text-center'><a href='./blog/tashrif_eye.php?StudentID=".$rowgurYas['StudentID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
            </tr>";
            $i++;
          }
        }
      }else{
        echo "<tr><td colspan='6' class='text-center'>Guruhlar mavjud emas</td></tr>";
      }
      echo "</tbody></table></div>";
?>