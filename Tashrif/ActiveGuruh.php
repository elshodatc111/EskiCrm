<?php
  echo "<h5 class='card-title'>Faol guruh talabalari</h5>";
  echo "<div class='table-responsive text-nowrap'>
    <table id='datatable' class='table table-bordered border-primary table-striped my_table_search'>
      <thead >
        <tr>
          <th>#</th>
          <th>FIO</th>
          <th>Telefon raqam</th>
          <th>Guruh</th>
          <th>Yakunlanish vaqti</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>";
      $sqlEndGur ="SELECT * FROM `user_student` WHERE 1";
      $resEndGur = $Confige->SelectAll($sqlEndGur);
      $i=1;
      if($resEndGur->num_rows>0){
        while ($rowEndGur = $resEndGur->fetch_assoc()) {
          $resEndGur2 = "SELECT 
                          guruh.GuruhName, guruh.End 
                        FROM 
                          `guruh_users` 
                        JOIN 
                          `guruh` 
                        ON 
                          guruh_users.GuruhID=guruh.GuruhID
                        WHERE 
                          guruh_users.UserID='".$rowEndGur['StudentID']."' 
                          AND 
                          guruh.End>'".$kun."'
                          AND
                          guruh.Start<'".$kun."'
                          ";
          $resEndGur2 = $Confige->SelectAll($resEndGur2);
          if($resEndGur2->num_rows>0){
            while($row11 = $resEndGur2->fetch_assoc()){
              echo "<tr>
              <td class='text-center'>".$i."</td>
              <td>".$rowEndGur['FIO']."</td>
              <td class='text-center'>".$rowEndGur['Phone']."</td>
              <td>".$row11['GuruhName']."</td>
              <td class='text-center'>".$row11['End']."</td>
              <td class='text-center'><a href='./blog/tashrif_eye.php?StudentID=".$rowEndGur['StudentID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
            </tr>";
            $i++;
            }
            
          }
          else{
            
          }
        }
      }else{
        echo "<tr><td colspan='6' class='text-center'>Guruhlar mavjud emas</td></tr>";
      }
  echo "</tbody></table></div>";
?>