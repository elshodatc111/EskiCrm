<div class="col-12">
    <div class="card ">
        <div class="card-body text-center">
            <h5 class="card-title">Tashriflar</h5>
            <button onclick="doExport()" target="_blank" class="btn btn-outline-primary py-1">Print Excel</button><br><hr>
            <div class="table-responsive text-nowrap">
                <table id="excelstyles" class="table table-bordered border-primary table-striped my_table_search">
                    
                    <?php
                        if($_POST['talabahaqida']==='all'){
                            echo "<tr><td colspan=12 class='text-center'><b>Barcha talabalar</b></td></tr>";
                            echo "<tr>
                                <th>#</th>
                                <th>StudentID</th>
                                <th>FIO</th>
                                <th>Telefon taqam</th>
                                <th>Yaqin tanishi</th>
                                <th>Yaqin tanishi telefon raqami</th>
                                <th>Tug'ilgan kuni</th>
                                <th>Student haqida</th>
                                <th>Yashash manzili</th>
                                <th>Biz haqimizda</th>
                                <th>Operator</th>
                                <th>Ro'yhatga olindi</th>
                            </tr>";
                            $sqlAllTash = "SELECT * FROM `user_student`";
                            $resAllTash = $Confige->SelectAll($sqlAllTash);
                            if($resAllTash->num_rows>0){
                                $i=1;
                                while ($rowAllTash = $resAllTash->fetch_assoc()) {
                                    echo "<tr>
                                        <td>".$i."</td>
                                        <td>".$rowAllTash['StudentID']."</td>
                                        <td>".$rowAllTash['FIO']."</td>
                                        <td>".$rowAllTash['Phone']."</td>
                                        <td>".$rowAllTash['Tanish']."</td>
                                        <td>".$rowAllTash['TPhone']."</td>
                                        <td>".$rowAllTash['Tkun']."</td>
                                        <td>".$rowAllTash['About']."</td>
                                        <td>".$rowAllTash['AddresName']."</td>
                                        <td>".$rowAllTash['Haqimizda']."</td>
                                        <td>".$rowAllTash['Operator']."</td>
                                        <td>".$rowAllTash['Data']."</td>
                                    </tr>";
                                    $i++;
                                }
                            }else{
                                echo "<tr><td colspan=12 class='text-center'>Tashriflar mavjud emas</td></tr>";
                            }
                            
                        }elseif($_POST['talabahaqida']==='mavjudGuruhStudent'){
                            echo "<tr><td colspan=12 class='text-center'><b>Guruh mavjud barcha talabalar</b></td></tr>";
                            echo "<tr>
                                <th>#</th>
                                <th>StudentID</th>
                                <th>FIO</th>
                                <th>Telefon taqam</th>
                                <th>Yaqin tanishi</th>
                                <th>Yaqin tanishi telefon raqami</th>
                                <th>Tug'ilgan kuni</th>
                                <th>Student haqida</th>
                                <th>Yashash manzili</th>
                                <th>Biz haqimizda</th>
                                <th>Operator</th>
                                <th>Ro'yhatga olindi</th>
                            </tr>";
                            $sqlAllTash1 = "SELECT * FROM `user_student`";
                            $resAllTash1 = $Confige->SelectAll($sqlAllTash1);
                            if($resAllTash1->num_rows>0){
                                $i=1;
                                while ($rowAllTash1 = $resAllTash1->fetch_assoc()) {
                                    $sqlaa1 = "SELECT * FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh_users.UserID='".$rowAllTash1['StudentID']."'";
                                    $resaa1 = $Confige->SelectAll($sqlaa1);
                                    if($resaa1->num_rows>0){
                                        $rowaa1 = $resaa1->fetch_assoc();
                                        echo "<tr>
                                        <td>".$i."</td>
                                        <td>".$rowAllTash1['StudentID']."</td>
                                        <td>".$rowAllTash1['FIO']."</td>
                                        <td>".$rowAllTash1['Phone']."</td>
                                        <td>".$rowAllTash1['Tanish']."</td>
                                        <td>".$rowAllTash1['TPhone']."</td>
                                        <td>".$rowAllTash1['Tkun']."</td>
                                        <td>".$rowAllTash1['About']."</td>
                                        <td>".$rowAllTash1['AddresName']."</td>
                                        <td>".$rowAllTash1['Haqimizda']."</td>
                                        <td>".$rowAllTash1['Operator']."</td>
                                        <td>".$rowAllTash1['Data']."</td>
                                    </tr>";
                                        $i++;
                                    }
                                }
                            }else{

                            }
                        }elseif($_POST['talabahaqida']==='mavjudEmasGuruhStudent'){
                            echo "<tr><td colspan=12 class='text-center'><b>Guruh mavjud emas barcha talabalar</b></td></tr>";
                            echo "<tr>
                                <th>#</th>
                                <th>StudentID</th>
                                <th>FIO</th>
                                <th>Telefon taqam</th>
                                <th>Yaqin tanishi</th>
                                <th>Yaqin tanishi telefon raqami</th>
                                <th>Tug'ilgan kuni</th>
                                <th>Student haqida</th>
                                <th>Yashash manzili</th>
                                <th>Biz haqimizda</th>
                                <th>Operator</th>
                                <th>Ro'yhatga olindi</th>
                            </tr>";
                            $sqlAllTash3 = "SELECT * FROM `user_student`";
                            $resAllTash3 = $Confige->SelectAll($sqlAllTash3);
                            if($resAllTash3->num_rows>0){
                                $i=1;
                                while ($rowAllTash3 = $resAllTash3->fetch_assoc()) {
                                    $sqlaa3 = "SELECT * FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID WHERE guruh_users.UserID='".$rowAllTash3['StudentID']."'";
                                    $resaa3 = $Confige->SelectAll($sqlaa3);
                                    if($resaa3->num_rows>0){
                                    }else{
                                        $rowaa3 = $resaa3->fetch_assoc();
                                        echo "<tr>
                                            <td>".$i."</td>
                                            <td>".$rowAllTash3['StudentID']."</td>
                                            <td>".$rowAllTash3['FIO']."</td>
                                            <td>".$rowAllTash3['Phone']."</td>
                                            <td>".$rowAllTash3['Tanish']."</td>
                                            <td>".$rowAllTash3['TPhone']."</td>
                                            <td>".$rowAllTash3['Tkun']."</td>
                                            <td>".$rowAllTash3['About']."</td>
                                            <td>".$rowAllTash3['AddresName']."</td>
                                            <td>".$rowAllTash3['Haqimizda']."</td>
                                            <td>".$rowAllTash3['Operator']."</td>
                                            <td>".$rowAllTash3['Data']."</td>
                                        </tr>";
                                        $i++;
                                    }
                                }
                            }else{

                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>