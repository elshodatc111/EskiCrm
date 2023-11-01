<div class="col-12">
    <div class="card ">
        <div class="card-body text-center">
            <h5 class="card-title">Hodimlar</h5>
            <button onclick="doExport()" target="_blank" class="btn btn-outline-primary py-1">Print Excel</button><br><hr>
            <div class="table-responsive text-nowrap">
                <table id="excelstyles" class="table table-bordered border-primary table-striped my_table_search">
                    <tr><td colspan=9 class='text-center'>
                    <b>Hodimlar</b>
                    </td></tr>
                    <tr class='text-center'>
                        <th>#</th>
                        <th>UserID</th>
                        <th>FIO</th>
                        <th>Telefon taqam</th>
                        <th>Yashash Manzil</th>
                        <th>Tug`ilgan kun</th>
                        <th>Status</th>
                        <th>Login</th>
                        <th>Ro'yhatga olindi</th>
                    </tr>
                    <?php
                        $sqlHodimlar = "SELECT * FROM `user_meneger`";
                        $resHodim = $Confige->SelectAll($sqlHodimlar);
                        if($resHodim -> num_rows>0){
                            $i=1;
                            while ($rowhodim = $resHodim->fetch_assoc()) {
                                echo "<tr>
                                    <td class='text-center'>".$i."</td>
                                    <td class='text-center'>".$rowhodim['UserID']."</td>
                                    <td>".$rowhodim['FIO']."</td>
                                    <td class='text-center'>".$rowhodim['Phone']."</td>
                                    <td>".$rowhodim['Addres']."</td>
                                    <td class='text-center'>".$rowhodim['TDay']."</td>
                                    <td class='text-center'>".$rowhodim['Status']."</td>
                                    <td class='text-center'>".$rowhodim['Username']."</td>
                                    <td class='text-center'>".$rowhodim['Data']."</td>
                                </tr>";
                                $i++;
                            }
                        }
                    ?>
                    
                </table>
            </div>
        </div>
    </div>
</div>