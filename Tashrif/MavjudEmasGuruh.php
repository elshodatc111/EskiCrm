<?php
if($_POST['vaqt']==='all'){
    echo "<h5 class='card-title'>Guruhga biriktirilmaganlar <i>(Barchasi)</i></h5>";
    $sqlgurNo = "SELECT * FROM `user_student`";
  }elseif($_POST['vaqt']==='kun'){
    echo "<h5 class='card-title'>Guruhga biriktirilmaganlar <i>(Kun boshida)</i></h5>";
    $sqlgurNo = "SELECT * FROM `user_student` WHERE `Data`>='".$kun." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
  }if($_POST['vaqt']==='hafta'){
    echo "<h5 class='card-title'>Guruhga biriktirilmaganlar <i>(Hafta boshidan)</i></h5>";
    $sqlgurNo = "SELECT * FROM `user_student` WHERE `Data`>='".$haftaBoshi." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
  }if($_POST['vaqt']==='oy'){
    echo "<h5 class='card-title'>Guruhga biriktirilmaganlar <i>(Oy boshidan)</i></h5>";
    $sqlgurNo = "SELECT * FROM `user_student` WHERE `Data`>='".$OyBosh." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
  }if($_POST['vaqt']==='yil'){
    echo "<h5 class='card-title'>Guruhga biriktirilmaganlar <i>(Yil boshidan)</i></h5>";
    $sqlgurNo = "SELECT * FROM `user_student` WHERE `Data`>='".$YilBosh." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
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
      
      $resgurNo = $Confige->SelectAll($sqlgurNo);
      $i=1;
      if($resgurNo->num_rows>0){
        while ($rowgurNo = $resgurNo->fetch_assoc()) {
          $sqlgurNo2 = "SELECT * FROM `guruh_users` WHERE `UserID`='".$rowgurNo['StudentID']."'";
          $resgurNo2 = $Confige->SelectAll($sqlgurNo2);
          if($resgurNo2->num_rows>0){}
          else{
            echo "<tr>
              <td class='text-center'>".$i."</td>
              <td>".$rowgurNo['FIO']."</td>
              <td>".$rowgurNo['Phone']."</td>
              <td>".$rowgurNo['Tanish']."</td>
              <td>".$rowgurNo['TPhone']."</td>
              <td class='text-center'><a href='./blog/tashrif_eye.php?StudentID=".$rowgurNo['StudentID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
            </tr>";
            $i++;
          }
        }
      }else{
        echo "<tr><td colspan='6' class='text-center'>Guruhlar mavjud emas</td></tr>";
      }
      echo "</tbody></table></div>";
?>