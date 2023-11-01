<?php
  include("../confige/confige.php");
  $Confige = new Confige;
  if(!isset($_COOKIE['Login'])) {header("location: ./login.php");}

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Guruh haqida</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../assets/images/logo.png" rel="icon">
    <link href="../assets/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../https://fonts.gstatic.com" rel="preconnect">
    <link href="../https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <script>
      <?php
        if(isset($_GET['deleteuser'])){echo "alert('Guruhdan o`quvchi o`chirildi')";}
        if(isset($_GET['deletetulov'])){echo "alert('Guruhga talaba to`lovi o`chirildi')";}
        if(isset($_GET['deletetecher'])){echo "alert('Guruhdan o`qituvchi o`chirildi')";}
        if(isset($_GET['EDITTULOV'])){echo "alert('To`lov taxrirlandi')";}
      ?>
    </script>
  </head>
  <body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="./index.php" class="logo d-flex align-items-center">
        <img src="../assets/images/logo.png" alt=""><span class="d-none d-lg-block"><?php echo $logo; ?></span></a><i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../assets/images/user_icon.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_COOKIE['fio']; ?></h6>
              <span><?php echo $_COOKIE['Login']; ?></span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="kobinet.php"><i class="bi bi-person"></i><span>Kobinet</span></a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="login.php"><i class="bi bi-box-arrow-right"></i><span>Chiqish</span></a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <span>Bosh sahifa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./tashrif.php">
          <span>Tashriflar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./guruhlar.php">
          <span>Guruhlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./techer.php">
          <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./moliya.php">
          <span>Moliya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./xonalar.php">
          <span>Xonalar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./kurslar.php">
          <span>Kurslar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="meneger.php">
          <span>Menegerlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./sms.php">
          <span>SMS</span>
        </a>
      </li>
    </ul>
  </aside>

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <?php
                        $sqls = "SELECT * FROM `guruh` WHERE `GuruhID`='".$_GET['GuruhID']."'";
                        $ress = $Confige->SelectAll($sqls);
                        $rows = $ress->fetch_assoc();
                    ?>
                    <h5 class="card-title w-100 text-center"><?php echo $rows['GuruhName']; ?></h5>
                    <div class="row text-center">
                      <div class="col-lg-3">
                        <p><b>To'lov summasi: </b> <br><?php echo $rows['Summa'] ?></p>
                      </div>
                      <div class="col-lg-3">
                        <p><b>Boshlanish vaqti: </b><br> <?php echo $rows['Start'] ?></p>
                      </div>
                      <div class="col-lg-3">
                        <p><b>Yakunlanish vaqti: </b><br> <?php echo $rows['End'] ?></p>
                      </div>
                      <div class="col-lg-3">
                        <p><b>Xona: </b><br> <?php echo $rows['Xona'] ?></p>
                      </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section dashboard">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Talabalar</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table text-center table-bordered" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>FIO</th>
                            <th>Guruhga qo'shildi</th>
                            <th>Jami to'lovlar</th>
                            <th>Izoh</th>
                            <th>Telefon raqam</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sqlb = "SELECT guruh_users.UserID,guruh_users.id,guruh_users.Izoh,guruh_users.Data,user_student.FIO,user_student.Phone FROM `guruh_users` JOIN `user_student` ON guruh_users.UserID=user_student.StudentID WHERE guruh_users.GuruhID='".$_GET['GuruhID']."'";
                                $resb = $Confige->SelectAll($sqlb);
                                if($resb->num_rows>0){
                                    $i=1;
                                    while ($rowb=$resb->fetch_assoc()) {
                                        $sqlb1 = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$rowb['UserID']."' AND `GuruhID`='".$_GET['GuruhID']."'";
                                        $resb1 = $Confige->SelectAll($sqlb1);
                                        $tulov = 0;
                                        if($resb1->num_rows>0){
                                            while ($row=$resb1->fetch_assoc()) {
                                                $tulov = $tulov + $row['Summa'];
                                            }
                                        }
                                        echo "<tr>
                                            <td>".$i."</td>
                                            <td>".$rowb['FIO']."</td>
                                            <td>".$rowb['Data']."</td>
                                            <td>".$tulov."</td>
                                            <td>".$rowb['Izoh']."</td>
                                            <td>".$rowb['Phone']."</td>
                                            <td>";
                                            if($tulov===0){
                                              echo "<a href='php/guruh.php?deleteuser=true&UserID=".$rowb['UserID']."&GuruhID=".$_GET['GuruhID']."' class='px-1'><i class='bi bi-trash-fill'></i></a>";
                                            }
                                            echo "</td>
                                        </tr>";
                                        $i++;
                                    }
                                }
                            ?>
                          
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="section dashboard">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">To'lovlar</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table text-center table-bordered" id="datatable1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>FIO</th>
                            <th>Summa</th>
                            <th>To'lov turi</th>
                            <th>To'olv vaqti</th>
                            <th>Izoh</th>
                            <th>Operator</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sqla = "SELECT user_student_tulov.Summa,user_student_tulov.TulovType,user_student_tulov.Izoh,user_student_tulov.Operator,user_student_tulov.Data,user_student.FIO,user_student_tulov.id FROM `user_student_tulov` JOIN `user_student` ON user_student_tulov.UserID=user_student.StudentID WHERE user_student_tulov.GuruhID='".$_GET['GuruhID']."'";
                                $resa = $Confige->SelectAll($sqla);
                                if($resa->num_rows>0){
                                    $i=1;
                                    while ($rowa=$resa->fetch_assoc()) {
                                        echo "<tr>
                                            <td>".$i."</td>
                                            <td>".$rowa['FIO']."</td>
                                            <td>".$rowa['Summa']."</td>
                                            <td>".$rowa['TulovType']."</td>
                                            <td>".$rowa['Data']."</td>
                                            <td>".$rowa['Izoh']."</td>
                                            <td>".$rowa['Operator']."</td>
                                            <td>";
                                            echo "<a href='guruh_tulov_edit.php?id=".$rowa['id']."&GuruhID=".$_GET['GuruhID']."' class='px-1'><i class='bi bi-pencil-square'></i></a>";
                                            echo "<a href='php/guruh.php?deletetulov=true&id=".$rowa['id']."&GuruhID=".$_GET['GuruhID']."' class='px-1'><i class='bi bi-trash-fill'></i></a>";
                                            echo "</td>
                                        </tr>";
                                        $i++;
                                    }
                                }
                            ?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="section dashboard">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">O'qituvchilar</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table text-center table-bordered" id="datatable2">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>FIO</th>
                            <th>Phone</th>
                            <th>Guruhga qo'shildi</th>
                            <th>Izoh</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sqlc = "SELECT user_techer_guruh.id,user_techer_guruh.Izoh,user_techer_guruh.Data,user_techer.TecherName,user_techer.Phone FROM `user_techer_guruh` JOIN `user_techer` ON user_techer_guruh.TecherID=user_techer.TecherID WHERE user_techer_guruh.GuruhID='".$_GET['GuruhID']."'";
                            $resc = $Confige->SelectAll($sqlc);
                            if($resc->num_rows>0){
                                $i=1;
                                while ($rowc=$resc->fetch_assoc()) {
                                    echo "<tr>
                                        <td>".$i."</td>
                                        <td>".$rowc['TecherName']."</td>
                                        <td>".$rowc['Phone']."</td>
                                        <td>".$rowc['Data']."</td>
                                        <td>".$rowc['Izoh']."</td>
                                        <td>";
                                        echo "<a href='php/guruh.php?deletetecher=true&id=".$rowc['id']."&GuruhID=".$_GET['GuruhID']."' class='px-1'><i class='bi bi-trash-fill'></i></a>";
                                        echo "</td>
                                    </tr>";
                                    $i++;
                                }
                            }
                          ?>
                          
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </section>

    </main>


  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#datatable').DataTable();
      $('#datatable1').DataTable();
      $('#datatable2').DataTable();
    });
    
  </script>
</body>
</html>