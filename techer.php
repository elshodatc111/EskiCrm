<?php
  include("./confige/confige.php");
  include("./confige/topHeader.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>O'qituvchilar</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/images/logo.png" rel="icon">
    <link href="assets/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style2.css" rel="stylesheet">
    <script>
      <?php
        if(isset($_GET['techPlus'])){echo "alert('Yangi o`qituvchi qo`shildi')";}
      ?>
    </script>
  </head>
  <body>

  <!-- ======= Header ======= -->
  <?php include("./confige/headerOne.php"); ?>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Bosh sahifa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="tashrif.php">
          <i class="bi bi-file-person"></i>
          <span>Tashriflar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="guruh.php">
          <i class="bi bi-text-indent-left"></i>
          <span>Guruhlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="techer.php">
          <i class="bi bi-person-badge"></i>
          <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="nav-item" style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
        <a class="nav-link collapsed" href="statistik.php">
          <i class="bi bi-bar-chart"></i>
          <span>Statistika</span>
        </a>
      </li>
      <li class="nav-item" style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
        <a class="nav-link collapsed" href="hisobot.php">
          <i class="bi bi-file-earmark-pdf"></i>
          <span>Hisobotlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="moliya.php">
          <i class="bi bi-currency-bitcoin"></i>
          <span>Moliya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="setting.php">
          <i class="bi bi-menu-button-wide"></i>
          <span>Sozlamalar</span>
        </a>
      </li>
    </ul>
  </aside>

  <main id="main" class="main">
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Bosh sahifa</a></li>
          <li class="breadcrumb-item active">O'qituvchilar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center p-0">
                <button class="btn btn-primary button_btn" data-bs-toggle="modal" data-bs-target="#addtecher"><i class="bi bi-person-plus"></i> Yangi O'qituvchi</button>
              </div>
            </div>
          </div>
          <div class="modal fade" id="addtecher" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Yangi o'qituvchi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="./conUsers/techerEdit.php" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">FIO</label>
                        <input type="text" class="form-control input_form" name="FIO" placeholder="FIO" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Telefon raqam</label>
                        <input type="text" class="form-control input_form phone" name="Phone" value="998" placeholder="Telefon raqam" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Manzil</label>
                        <input type="text" class="form-control input_form" name="Manzil" placeholder="Manzil" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Tug'ilgan kuni</label>
                        <input type="date" class="form-control input_form" name="tkun" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Mutahasisligi</label>
                        <input type="text" class="form-control input_form" name="mutahasis" placeholder="Mutahasisligi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">O'qituvchi haqida</label>
                        <input type="text" class="form-control input_form" name="about" placeholder="O'qituvchi haqida" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="techerPlus" class="Filter_btn btn">O'qituvhi qo'shish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-12">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">O'qituvchilar</h5>
                <div class="table-responsive text-nowrap">
									<table class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>O'qituvchilar</th>
                        <th>Telefon raqami</th>
                        <th>Yashash manzili</th>
                        <th>Tug'ilgan kuni</th>
                        <th>Mutahasisligi</th>
                        <th>O'qituvchi haqida</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql = "SELECT * FROM `user_techer`";
                        $res = $Confige->SelectAll($sql);
                        if($res->num_rows>0){
                          $i=1;
                          while ($row=$res->fetch_assoc()) {
                            echo "<tr>
                            <td class='text-center'>".$i."</td>
                            <td>".$row['TecherName']."</td>
                            <td>".$row['Phone']."</td>
                            <td>".$row['Addres']."</td>
                            <td>".$row['TDate']."</td>
                            <td>".$row['Mutahasis']."</td>
                            <td>".$row['About']."</td>
                            <td class='text-center'><a href='./blog/techer_eye.php?TechID=".$row['TecherID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
                          </tr>";
                          $i++;
                          }
                        }else{
                          echo "<tr><td colspan='8' class='text-center'>O`qituvchilar mavjud emas</td></tr>";
                        }
                      ?>
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          
        </div>
      </section>

  </main>
  
  <!--Footer -->
  <?php include("./confige/footerOne.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>

  <script src="./assets/js/jquery-3.5.1.js"></script>
  <script src="./assets/js/jquery.inputmask.min.js"></script>
  <script>
      $(document).ready(function(){
          $('.phone').inputmask('999 99 999 9999');
          $('.pasport').inputmask('AA 9999999');
          $('.pnfl').inputmask('99999999999999');
      });
  </script>
</body>
</html>