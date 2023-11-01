<div class="col-12">
    <div class="card ">
        <div class="card-body text-center">
            <h5 class="card-title">Moliya</h5>
            
            <button onclick="doExport()" target="_blank" class="btn btn-outline-primary py-1">Print Excel</button><br><hr>
            <div class="table-responsive text-nowrap">
                <table id="excelstyles" class="table table-bordered border-primary table-striped my_table_search">             
                    <?php
                        if($_POST['moliya']==='studenttulov'){
                            echo "<tr><td colspan=11 class='text-center'><b>Talabalar to`lovlari</b></td></tr>";
                            echo "<tr>
                                <th>#</th>
                                <th>FIO</th>
                                <th>UserID</th>
                                <th>Telefon taqam</th>
                                <th>Tulov turi</th>
                                <th>Tulov summasi</th>
                                <th>To'lov vaqti</th>
                                <th>Guruh</th>
                                <th>GuruhID</th>
                                <th>Izoh</th>
                                <th>Darslar boshlangan</th>
                                <th>Darslar yakunlangan</th>
                                <th>Operator</th>
                            </tr>";
                            $sqltalabatulov = "SELECT 
                            user_student_tulov.Summa,
                            user_student_tulov.UserID,
                            user_student_tulov.TulovType,
                            user_student_tulov.Izoh,
                            user_student_tulov.Operator,
                            user_student_tulov.Data,
                            user_student.FIO,
                            user_student.Phone,
                            guruh.GuruhName,
                            guruh.GuruhID,
                            guruh.Start,
                            guruh.End 
                            FROM `user_student_tulov` JOIN `user_student` ON user_student_tulov.UserID=user_student.StudentID JOIN `guruh` ON user_student_tulov.GuruhID=guruh.GuruhID";
                            $restalabatulov = $Confige->SelectAll($sqltalabatulov);
                            if($restalabatulov->num_rows>0){
                                $i=1;
                                while ($rowtultal = $restalabatulov->fetch_assoc()) {
                                    echo "<tr>
                                        <td class='text-center'>".$i."</td>
                                        <td>".$rowtultal['FIO']."</td>
                                        <td>".$rowtultal['UserID']."</td>
                                        <td>".$rowtultal['Phone']."</td>
                                        <td>".$rowtultal['TulovType']."</td>
                                        <td>".$rowtultal['Summa']."</td>
                                        <td>".$rowtultal['Data']."</td>
                                        <td>".$rowtultal['GuruhName']."</td>
                                        <td>".$rowtultal['GuruhID']."</td>
                                        <td>".$rowtultal['Izoh']."</td>
                                        <td>".$rowtultal['Start']."</td>
                                        <td>".$rowtultal['End']."</td>
                                        <td>".$rowtultal['Operator']."</td>
                                    </tr>";
                                    $i++;
                                }
                            }else{echo "<tr><td colspan=10 class='text-center'>Talabalar to`lovlari mavjud emas</td></tr>";}
                        }
                        elseif($_POST['moliya']==='chiqimlar'){
                            echo "<tr><td colspan=8 class='text-center'><b>Jami chiqimlar tarixi</b></td></tr>";
                            $salChiqim = "SELECT * FROM `moliya` WHERE `Type`='true'";
                            $resChiqim = $Confige->SelectAll($salChiqim);
                            echo "<tr>
                                <th>#</th>
                                <th>Chiqim turi</th>
                                <th>Chiqim summasi</th>
                                <th>Chiqim vaqti</th>
                                <th>Izoh</th>
                                <th>Meneger</th>
                                <th>Tasdiqlangan vaqt</th>
                                <th>Xisobchi</th>
                            </tr>";
                            if($resChiqim->num_rows>0){
                                $i=1;
                                while ($rowChiqim = $resChiqim->fetch_assoc()) {
                                    echo "<tr>
                                            <td class='text-center'>".$i."</td>
                                            <td>".$rowChiqim['TypeTulov']."</td>
                                            <td>".$rowChiqim['TulovSumma']."</td>
                                            <td>".$rowChiqim['ChiqimVaqt']."</td>
                                            <td>".$rowChiqim['Izoh']."</td>
                                            <td>".$rowChiqim['Meneger']."</td>
                                            <td>".$rowChiqim['Tasdiqlandi']."</td>
                                            <td>".$rowChiqim['Xisobchi']."</td>
                                        </tr>";
                                        $i++;
                                }
                            }else{echo "<tr colspan=7 class='text-center'>Chiqimlar mavjud emas</tr>";}
                        }
                        elseif($_POST['moliya']==='hodimtulov'){
                            echo "<tr><td colspan=12 class='text-center'><b>Hodimlarga to`langan ish haqi</b></td></tr>";
                            $sqltulhod = "SELECT user_meneger_ish_haqi.UserID,user_meneger_ish_haqi.Summa,user_meneger_ish_haqi.Izoh,user_meneger_ish_haqi.Data,user_meneger.FIO FROM `user_meneger_ish_haqi` JOIN `user_meneger` ON user_meneger_ish_haqi.UserID=user_meneger.UserID";
                            $restulhod = $Confige->SelectAll($sqltulhod);
                            echo "<tr class='text-center'>
                                <th>#</th>
                                <th>Hodim</th>
                                <th>To`lov summasi</th>
                                <th>Izoh</th>
                                <th>Tulov vaqti</th>
                            </tr>";
                            if($restulhod->num_rows>0){
                                $i = 1;
                                while ($rowtechhaq = $restulhod->fetch_assoc()) {
                                    echo "<tr>
                                        <td>".$i."</td>
                                        <td>".$rowtechhaq['FIO']."</td>
                                        <td>".$rowtechhaq['Summa']."</td>
                                        <td>".$rowtechhaq['Izoh']."</td>
                                        <td>".$rowtechhaq['Data']."</td>
                                    </tr>";
                                }
                            }else{echo "<tr><td colspan=5 class='text-center'>Hodimlarga ish haqi to`lanmagan</td></tr>";}
                        }
                        elseif($_POST['moliya']==='guruhtulov') {
                            echo "<tr><th colspan=11 class='text-center'>Talabaning guruhlardagi to'lovlari</th></tr>
                            <tr>
                                <th>#</th>
                                <th>GuruhID</th>
                                <th>Guruh nomi</th>
                                <th>Guruh narxi</th>
                                <th>Talaba ID</th>
                                <th>FIO</th>
                                <th>Jami to'lovlar</th>
                                <th>Naqt to'lov</th>
                                <th>Plastik to'lov</th>
                                <th>Chegirma</th>
                                <th>Qaytarilgan to'lov</th>
                            </tr>";
                            $sql="SELECT guruh_users.GuruhID,guruh_users.UserID,guruh.GuruhName,guruh.Summa,user_student.FIO FROM `guruh_users` JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID JOIN `user_student` ON guruh_users.UserID=user_student.StudentID";
                            $res = $Confige->SelectAll($sql);
                            if($res->num_rows>0){
                                $i=1;
                                while ($row=$res->fetch_assoc()) {
                                    $sql1 = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$row['UserID']."' AND `GuruhID`='".$row['GuruhID']."'";
                                    $res1 = $Confige->SelectAll($sql1);
                                    $naqt = 0;
                                    $plastik = 0;
                                    $chegirma = 0;
                                    $qaytarildi = 0;
                                    if($res1->num_rows>0){
                                        while ($row1=$res1->fetch_assoc()) {
                                            if($row1['TulovType']==='Naqt'){
                                                $naqt = $naqt + $row1['Summa'];
                                            }elseif($row1['TulovType']==='Plastik'){
                                                $plastik = $plastik + $row1['Summa'];
                                            }elseif($row1['TulovType']==='Chegirma'){
                                                $chegirma = $chegirma + $row1['Summa'];
                                            }elseif($row1['TulovType']==='qaytarildi'){
                                                $qaytarildi = $qaytarildi + $row1['Summa'];
                                            }
                                        }
                                    }
                                    $jami = $naqt+$plastik+$chegirma-$qaytarildi;
                                    echo "<tr>
                                        <td>".$i."</td>
                                        <td>".$row['GuruhID']."</td>
                                        <td>".$row['GuruhName']."</td>
                                        <td>".$row['Summa']."</td>
                                        <td>".$row['UserID']."</td>
                                        <td>".$row['FIO']."</td>
                                        <td>".$jami."</td>
                                        <td>".$naqt."</td>
                                        <td>".$plastik."</td>
                                        <td>".$chegirma."</td>
                                        <td>".$qaytarildi."</td>
                                    </tr>";
                                    $i++;
                                }
                            }
                        }
                        elseif($_POST['moliya']==='ortiqchatulov') {
                            echo "<tr><th colspan=12 class='text-center'>Talabalar guruhlarga ortiqcha to'lovlar</th></tr>
                            <tr>
                                <th class='text-center'>#</th>
                                <th class='text-center'>User ID</th>
                                <th class='text-center'>FIO</th>
                                <th class='text-center'>Guruh ID</th>
                                <th class='text-center'>Guruh</th>
                                <th class='text-center'>Guruh narxi</th>
                                <th class='text-center'>Jami to'lovlar</th>
                                <th class='text-center'>Ortiqcha to'lov</th>
                                <th class='text-center'>Naqt to'lovlar</th>
                                <th class='text-center'>Plastik to'lovlar</th>
                                <th class='text-center'>Qaytarilgan to'lovlar</th>
                                <th class='text-center'>Chegirma</th>
                            </tr>";
                            $sqlortiq = "SELECT guruh_users.GuruhID,guruh_users.UserID,user_student.FIO,guruh.GuruhName,guruh.Summa FROM `guruh_users` JOIN `user_student` ON guruh_users.UserID=user_student.StudentID JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID";
                            $resortiq = $Confige->SelectAll($sqlortiq);
                            if($resortiq->num_rows>0){
                                $i=1;
                                while ($roeortiq = $resortiq->fetch_assoc()) {
                                    $sqltul = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$roeortiq['GuruhID']."' AND `UserID`='".$roeortiq['UserID']."'";
                                    $restul = $Confige->SelectAll($sqltul);
                                    $Naqt = 0;
                                    $Plastik = 0;
                                    $Chegirma = 0;
                                    $Qaytarildi = 0;
                                    if($restul->num_rows>0){
                                        while ($rowTul=$restul->fetch_assoc()) {
                                            if($rowTul['TulovType']==='Naqt'){
                                                $Naqt = $Naqt + $rowTul['Summa'];
                                            }elseif($rowTul['TulovType']==='Plastik'){
                                                $Plastik = $Plastik + $rowTul['Summa'];
                                            }elseif($rowTul['TulovType']==='Chegirma'){
                                                $Chegirma = $Chegirma + $rowTul['Summa'];
                                            }elseif($rowTul['TulovType']==='qaytarildi'){
                                                $Qaytarildi = $Qaytarildi + $rowTul['Summa'];
                                            }
                                        }
                                    }
                                    $JamiSumma = $Naqt+$Plastik+$Chegirma-$Qaytarildi;
                                    $OrtiqchaTulov = $JamiSumma-$roeortiq['Summa'];
                                    if($OrtiqchaTulov>0){
                                        echo "<tr>
                                            <td class='text-center'>".$i."</td>
                                            <td class='text-center'>".$roeortiq['UserID']."</td>
                                            <td>".$roeortiq['FIO']."</td>
                                            <td class='text-center'>".$roeortiq['GuruhID']."</td>
                                            <td>".$roeortiq['GuruhName']."</td>
                                            <td class='text-center'>".$roeortiq['Summa']."</td>
                                            <td class='text-center'>".$JamiSumma."</td>
                                            <td class='text-center'>".$OrtiqchaTulov."</td>
                                            <td class='text-center'>".$Naqt."</td>
                                            <td class='text-center'>".$Plastik."</td>
                                            <td class='text-center'>".$Qaytarildi."</td>
                                            <td class='text-center'>".$Chegirma."</td>
                                        </tr>";
                                        $i++;
                                    }
                                }
                            }
                        }
                        elseif($_POST['moliya']==='qarzdortalabalar') {
                            echo "<tr><th colspan=12 class='text-center'>Qarzdor talabalar</th></tr>
                            <tr>
                                <th class='text-center'>#</th>
                                <th class='text-center'>User ID</th>
                                <th class='text-center'>FIO</th>
                                <th class='text-center'>Guruh ID</th>
                                <th class='text-center'>Guruh</th>
                                <th class='text-center'>Guruh narxi</th>
                                <th class='text-center'>Jami to'lovlar</th>
                                <th class='text-center'>Qarzdorlik</th>
                                <th class='text-center'>Naqt to'lovlar</th>
                                <th class='text-center'>Plastik to'lovlar</th>
                                <th class='text-center'>Qaytarilgan to'lovlar</th>
                                <th class='text-center'>Chegirma</th>
                            </tr>";
                            $sqlortiq1 = "SELECT guruh_users.GuruhID,guruh_users.UserID,user_student.FIO,guruh.GuruhName,guruh.Summa FROM `guruh_users` JOIN `user_student` ON guruh_users.UserID=user_student.StudentID JOIN `guruh` ON guruh_users.GuruhID=guruh.GuruhID";
                            $resortiq1 = $Confige->SelectAll($sqlortiq1);
                            if($resortiq1->num_rows>0){
                                $i=1;
                                while ($roeortiq1 = $resortiq1->fetch_assoc()) {
                                    $sqltul1 = "SELECT * FROM `user_student_tulov` WHERE `GuruhID`='".$roeortiq1['GuruhID']."' AND `UserID`='".$roeortiq1['UserID']."'";
                                    $restul1 = $Confige->SelectAll($sqltul1);
                                    $Naqt = 0;
                                    $Plastik = 0;
                                    $Chegirma = 0;
                                    $Qaytarildi = 0;
                                    if($restul1->num_rows>0){
                                        while ($rowTul=$restul1->fetch_assoc()) {
                                            if($rowTul['TulovType']==='Naqt'){
                                                $Naqt = $Naqt + $rowTul['Summa'];
                                            }elseif($rowTul['TulovType']==='Plastik'){
                                                $Plastik = $Plastik + $rowTul['Summa'];
                                            }elseif($rowTul['TulovType']==='Chegirma'){
                                                $Chegirma = $Chegirma + $rowTul['Summa'];
                                            }elseif($rowTul['TulovType']==='qaytarildi'){
                                                $Qaytarildi = $Qaytarildi + $rowTul['Summa'];
                                            }
                                        }
                                    }
                                    $JamiSumma = $Naqt+$Plastik+$Chegirma-$Qaytarildi;
                                    $OrtiqchaTulov = $roeortiq1['Summa']-$JamiSumma;
                                    if($OrtiqchaTulov>0){
                                        echo "<tr>
                                            <td class='text-center'>".$i."</td>
                                            <td class='text-center'>".$roeortiq1['UserID']."</td>
                                            <td>".$roeortiq1['FIO']."</td>
                                            <td class='text-center'>".$roeortiq1['GuruhID']."</td>
                                            <td>".$roeortiq1['GuruhName']."</td>
                                            <td class='text-center'>".$roeortiq1['Summa']."</td>
                                            <td class='text-center'>".$JamiSumma."</td>
                                            <td class='text-center'>".$OrtiqchaTulov."</td>
                                            <td class='text-center'>".$Naqt."</td>
                                            <td class='text-center'>".$Plastik."</td>
                                            <td class='text-center'>".$Qaytarildi."</td>
                                            <td class='text-center'>".$Chegirma."</td>
                                        </tr>";
                                        $i++;
                                    }
                                }
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>