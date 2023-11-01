<?php
    if($_POST['vaqt']==='all'){
        echo "<h5 class='card-title'>Tashriflar <i>(Barchasi)</i></h5>";
        $sqlAll = "SELECT * FROM `user_student` WHERE 1";
    }elseif($_POST['vaqt']==='kun'){
        echo "<h5 class='card-title'>Tashriflar <i>(Kun boshidan)</i></h5>";
        $sqlAll = "SELECT * FROM `user_student` WHERE `Data`>='".$kun." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
    }if($_POST['vaqt']==='hafta'){
        echo "<h5 class='card-title'>Tashriflar <i>(Barchasi)</i></h5>";
        $sqlAll = "SELECT * FROM `user_student` WHERE `Data`>='".$haftaBoshi." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
    }if($_POST['vaqt']==='oy'){
        echo "<h5 class='card-title'>Tashriflar <i>(Oy boshidan)</i></h5>";
        $sqlAll = "SELECT * FROM `user_student` WHERE `Data`>='".$OyBosh." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
    }if($_POST['vaqt']==='yil'){
        echo "<h5 class='card-title'>Tashriflar <i>(Yil boshidan)</i></h5>";
        $sqlAll = "SELECT * FROM `user_student` WHERE `Data`>='".$YilBosh." 00:00:00' AND `Data`<='".$kun." 23:59:59'";
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
        $resAll = $Confige->SelectAll($sqlAll);
        if($resAll->num_rows>0){
        $i=1;
        while ($rowAll=$resAll->fetch_assoc()) {
            echo "
            <tr>
            <td class='text-center'>".$i."</td>
            <td>".$rowAll['FIO']."</td>
            <td>+".$rowAll['Phone']."</td>
            <td>".$rowAll['AddresName']."</td>
            <td class='text-center'>".$rowAll['Tkun']."</td>
            <td class='text-center'><a href='./blog/tashrif_eye.php?StudentID=".$rowAll['StudentID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
            </tr>
            ";$i++;
        }
        }else{
            echo "<tr><td colspan='6' class='text-center'>Talabalar mavjud emas</td></tr>";
        }
    echo "</tbody></table></div>";
?>