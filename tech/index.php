<?php
  session_start();
  include("../confige/confige.php");
  $Confige = new Confige;
  if(!isset($_SESSION['FIO'])){header("location: login.php");}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Bosh sahifa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../assets/images/logo.png" rel="icon">
    <link href="../assets/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
  </head>
  <body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/images/logo.png" alt=""><span class="d-none d-lg-block">ATKO</span></a><i class="bi bi-list toggle-sidebar-btn"></i>
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
              <h6><?php echo $_SESSION['FIO']; ?></h6>
              <span><?php echo $_SESSION['Username']; ?></span>
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
      <li class="nav-item collapsed">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Bosh sahifa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./guruh.php">
          <i class="bi bi-file-person"></i>
          <span>Guruhlar</span>
        </a>
      </li>
    </ul>
  </aside>

  <main id="main" class="main">
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-8">
          <div class="card ">
            <div class="card-body">
              <h5 class="card-title">To'langan ish haqqi</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered border-primary table-striped my_table_search">
                  <thead >
                    <tr>
                      <th>#</th>
                      <th>To'lov summasi</th>
                      <th>To'lov vaqti</th>
                      <th>To'langan oy</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM `user_techer_ish_haqi` WHERE `TechID`='".$_SESSION['UserID']."'";
                      $res = $Confige->SelectAll($sql);
                      if($res->num_rows>0){
                        $i=1;
                        while ($row = $res->fetch_assoc()) {
                          echo "<tr>
                            <td class='text-center'>".$i."</td>
                            <td class='text-center'>".$row['Summa']."</td>
                            <td class='text-center'>".$row['Data']."</td>
                            <td class='text-center'>".$row['Monch']."</td>
                          </tr>";
                          $i++;
                        }
                      }else{
                        echo "<tr><td colspan=4 class='text-center'>To`lovlar mavjud emas</td></tr>";
                      }
                    ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card ">
            <div class="card-body">
              <h5 class="card-title">Parolni <span>| Yangilash</span></h5>
              <form action="editing.php" method="POST" class="form_student_about">
                <div class="row text-center">
                  <div class="col-lg-12">
                    <input type="password" name="password" class="form-control input_form" placeholder="Yangi Parol" required>
                  </div>
                  <div class="col-lg-12">
                    <button type="submit" name="passwordEdit" class="Filter_btn btn">Parolni yangilash</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4">
          <div class="card ">
            <div class="card-body">
              <h5 class="card-title">Sizning malumotlaringiz</h5>
              <?php
                $sqlAbout = "SELECT * FROM `user_techer` WHERE `TecherID`='".$_SESSION['UserID']."'";
                $resAbout = $Confige->SelectAll($sqlAbout);
                $rowAbout = $resAbout->fetch_assoc();
              ?>
              <form action="editing.php" method="POST" class="form_student_about">
                <div class="row text-center">
                  <div class="col-lg-12">
                    <label for="" class="input-label">FIO</label>
                    <input type="text" class="form-control input_form" name="FIO" value="<?php echo $rowAbout['TecherName']; ?>" required>
                  </div>
                  <div class="col-lg-12">
                    <label for="" class="input-label">Yashash manzili</label>
                    <input type="text" class="form-control input_form" name="Manzil" value="<?php echo $rowAbout['Addres']; ?>" required>
                  </div>
                  <div class="col-lg-12">
                    <label for="" class="input-label">Telefon raqam</label>
                    <input type="text" class="form-control input_form phone" name="Phone" value="<?php echo $rowAbout['Phone']; ?>" required>
                  </div>
                  <div class="col-lg-12">
                    <label for="" class="input-label">Tug'ilgan kuni</label>
                    <input type="date" class="form-control input_form" value="<?php echo $rowAbout['TDate']; ?>" disabled required>
                  </div>
                  <div class="col-lg-12">
                    <label for="" class="input-label">Mutahasislik</label>
                    <input type="text" class="form-control input_form" value="<?php echo $rowAbout['Mutahasis']; ?>" disabled required>
                  </div>
                  <div class="col-lg-12">
                    <label for="" class="input-label">Siz haqingizda</label>
                    <input type="text" class="form-control input_form" value="<?php echo $rowAbout['About']; ?>" disabled required>
                  </div>
                  <div class="col-lg-12">
                    <label for="" class="input-label">Login</label>
                    <input type="text" class="form-control input_form" value="<?php echo $_SESSION['Username']; ?>" disabled required>
                  </div>
                  <div class="col-lg-12">
                    <button type="submit" name="edetTecher" class="Filter_btn btn">Malumotlarini yangilash</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </section>
  </main>
  
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>ATKO TEAMS</span></strong>. All Rights Reserved
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
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
    });
  </script>
  <script src="../assets/js/jquery.inputmask.min.js"></script>
  <script>
      $(document).ready(function(){
          $('.phone').inputmask('999 99 999 9999');
          $('.pasport').inputmask('AA 9999999');
          $('.pnfl').inputmask('99999999999999');
      });
  </script>
</body>
</html>