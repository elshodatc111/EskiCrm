<div class="col-12">
    <div class="card ">
        <div class="card-body text-center">
            <h5 class="card-title">Guruhlar</h5>
            <button onclick="doExport()" target="_blank" class="btn btn-outline-primary py-1">Print Excel</button><br><hr>
            <div class="table-responsive text-nowrap">
                <table id="excelstyles" class="table table-bordered border-primary table-striped my_table_search">
                    <tr>
                        <td colspan=10 class='text-center'>
                            <b>Barcha guruhlar</b>
                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>GuruhID</th>
                        <th>Guruh nomi</th>
                        <th>To'lovlar soni</th>
                        <th>To'lov summasi</th>
                        <th>Boshlanish vaqti</th>
                        <th>Yakunish vaqti</th>
                        <th>Xona</th>
                        <th>Operator</th>
                        <th>Ro'yhatga olindi</th>
                    </tr>
                    <?php
                        $sqlgur = "SELECT * FROM `guruh` WHERE 1";
                        $resgur = $Confige->SelectAll($sqlgur);
                        if($resgur->num_rows>0){
                            $i=1;
                            while ($rowgur = $resgur->fetch_assoc()) {
                                echo "<tr>
                                    <td>".$i."</td>
                                    <td>".$rowgur['GuruhID']."</td>
                                    <td>".$rowgur['GuruhName']."</td>
                                    <td>".$rowgur['TulovCount']."</td>
                                    <td>".$rowgur['Summa']."</td>
                                    <td>".$rowgur['Start']."</td>
                                    <td>".$rowgur['End']."</td>
                                    <td>".$rowgur['Xona']."</td>
                                    <td>".$rowgur['Operator']."</td>
                                    <td>".$rowgur['Data']."</td>
                                </tr>";
                                $i++;
                            }
                        }else{
                            echo "<tr><td colspan=10 class='text-center'>Guruhlar mavjud emas</td></tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>