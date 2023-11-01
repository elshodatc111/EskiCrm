<h5 class='card-title'>Tashriflar</h5>     
<div class="table-responsive text-nowrap">
    <table class="table table-bordered border-primary table-striped datatable">
    <thead >
        <tr>
        <th>#</th>
        <th>FIO</th>
        <th>Telefon raqam</th>
        <th>Yashash manzil</th>
        <th>Tug'ilgan kuni</th>
        <th>Tashrif vaqti</th>
        <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqlAll = "SELECT * FROM `user_student` ORDER BY `id` DESC";
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
                <td class='text-center'>".$rowAll['Data']."</td>
                <td class='text-center'><a href='./blog/tashrif_eye.php?StudentID=".$rowAll['StudentID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
            </tr>
            ";$i++;
            }
        }else{
            echo "<tr><td colspan='6' class='text-center'>Talabalar mavjud emas</td></tr>";
        }
        ?>
    </tbody>
    </table>
</div>