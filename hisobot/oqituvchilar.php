<div class="col-12">
    <div class="card ">
        <div class="card-body text-center">
            <h5 class="card-title">Oqituvchilar</h5>
            <button onclick="doExport()" target="_blank" class="btn btn-outline-primary py-1">Print Excel</button><br><hr>
            <div class="table-responsive text-nowrap">
                <table id="excelstyles" class="table table-bordered border-primary table-striped my_table_search">
                    <tr><td colspan=9 class='text-center'>
                    <b>
                    <?php
                        if($_POST['techershaqida']==='all'){
                            echo "Barcha o`qituvchilar";
                            echo "<tr class='text-center'>
                                <th>#</th>
                                <th>TecherID</th>
                                <th>FIO</th>
                                <th>Telefon taqam</th>
                                <th>Yashash joyi</th>
                                <th>Tug'ilgan kuni</th>
                                <th>Mutahasisligi</th>
                                <th>O`qituvchi haqida</th>
                                <th>Ro`yhatga olindi</th>
                            </tr>";
                            $sqltech01 = "SELECT * FROM `user_techer`";
                            $restech01 = $Confige->SelectAll($sqltech01);
                            if($restech01->num_rows>0){
                                $i=1;
                                while ($rowtech01 = $restech01->fetch_assoc()) {
                                    echo "<tr>
                                    <td>".$i."</td>
                                    <td>".$rowtech01['TecherID']."</td>
                                    <td>".$rowtech01['TecherName']."</td>
                                    <td>".$rowtech01['Phone']."</td>
                                    <td>".$rowtech01['Addres']."</td>
                                    <td>".$rowtech01['TDate']."</td>
                                    <td>".$rowtech01['Mutahasis']."</td>
                                    <td>".$rowtech01['About']."</td>
                                    <td>".$rowtech01['Data']."</td>
                                </tr>";
                                $i++;
                                }
                            }
                        }elseif($_POST['techershaqida']==='activ'){
                            echo "Guruhi Faol o`qituvchilar";
                                echo "<tr class='text-center'>
                                <th>#</th>
                                <th>TecherID</th>
                                <th>FIO</th>
                                <th>Telefon taqam</th>
                                <th>Yashash joyi</th>
                                <th>Tug'ilgan kuni</th>
                                <th>Guruh</th>
                                <th>Guruh boshlanish vaqti</th>
                                <th>Guruh yakunlanish vaqti</th>
                            </tr>";
                            $sqltech02 = "SELECT * FROM `user_techer`";
                            $restech02 = $Confige->SelectAll($sqltech02);
                            if($restech02->num_rows>0){
                                $i=1;
                                while ($rowtech02 = $restech02->fetch_assoc()) {
                                    $sqla1 = "SELECT * FROM `user_techer_guruh` JOIN `guruh` ON user_techer_guruh.GuruhID=guruh.GuruhID WHERE user_techer_guruh.TecherID='".$rowtech02['TecherID']."'";
                                    $resa1 = $Confige->SelectAll($sqla1);
                                    if($resa1->num_rows>0){
                                        while ($rowa1 = $resa1->fetch_assoc()) {
                                            echo "<tr>
                                                <td>".$i."</td>
                                                <td>".$rowtech02['TecherID']."</td>
                                                <td>".$rowtech02['TecherName']."</td>
                                                <td>".$rowtech02['Phone']."</td>
                                                <td>".$rowtech02['Addres']."</td>
                                                <td>".$rowtech02['TDate']."</td>
                                                <td>".$rowa1['GuruhName']."</td>
                                                <td>".$rowa1['Start']."</td>
                                                <td>".$rowa1['End']."</td>
                                            </tr>";
                                            $i++;
                                        }
                                    }
                                }
                            }else{
                                echo "<tr><td colspan=9>Mavjud emas</td></tr>";
                            }
                        }elseif($_POST['techershaqida']==='pays'){
                            echo "O`qituvchilarga to`langan ish haqlari";
                                echo "<tr class='text-center'>
                                <th>#</th>
                                <th>O'qituvchi ID</th>
                                <th>O'qituvchi</th>
                                <th>Guruh ID</th>
                                <th>Guruh</th>
                                <th>To'lov summasi</th>
                                <th>To'lov vaqti</th>
                                <th>To'lov haqida izoh</th>
                            </tr>";
                            $sqlaaa = "SELECT user_techer_ish_haqi.TechID,user_techer.TecherName,user_techer_ish_haqi.Monch,guruh.GuruhName,user_techer_ish_haqi.Summa,user_techer_ish_haqi.Izoh,user_techer_ish_haqi.Data FROM `user_techer_ish_haqi` JOIN `guruh` ON user_techer_ish_haqi.Monch=guruh.GuruhID JOIN `user_techer` ON user_techer_ish_haqi.TechID=user_techer.TecherID";
                            $resaaa = $Confige->SelectAll($sqlaaa);
                            if($resaaa->num_rows>0){
                                $i=1;
                                while ($rowaaa=$resaaa->fetch_assoc()) {
                                    echo "<tr>
                                        <td>".$i."</td>
                                        <td>".$rowaaa['TechID']."</td>
                                        <td>".$rowaaa['TecherName']."</td>
                                        <td>".$rowaaa['Monch']."</td>
                                        <td>".$rowaaa['GuruhName']."</td>
                                        <td>".number_format(($rowaaa['Summa']), 0, '.', ' ')."</td>
                                        <td>".$rowaaa['Data']."</td>
                                        <td>".$rowaaa['Izoh']."</td>
                                    </tr>";
                                    $i++;
                                }
                            }
                        }
                    ?></b>
                    </td></tr>                    
                </table>
            </div>
        </div>
    </div>
</div>