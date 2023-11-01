<?php
  include("./confige/confige.php");
  include("./confige/topHeader.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tashriflar</title>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <script>
      <?php
        if(isset($_GET['telError'])){echo "alert('Telefon raqam oldin kiritilgan.')";}
        if(isset($_GET['tashPlus'])){echo "alert('Yangi tashrif qo`shildi.')";}
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
        <a class="nav-link " href="tashrif.php">
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
        <a class="nav-link collapsed" href="techer.php">
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
          <li class="breadcrumb-item active">Tashriflar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center p-0">
                <button class="btn btn-primary button_btn" data-bs-toggle="modal" data-bs-target="#addtashrif"><i class="bi bi-person-plus"></i> Yangi tashrif</button>
              </div>
            </div>
          </div>

          <div class="modal fade  modal_form" id="addtashrif" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Yangi tashrif</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="./conUsers/studentEdir.php" method="POST">
                    <div class="row">
                    <script>
                      function lastName(str) {
                        if (str.length==0) {
                          document.getElementById("livesearch").innerHTML="";
                          return;
                        }
                        var xmlhttp=new XMLHttpRequest();
                        xmlhttp.onreadystatechange=function() {
                          if (this.readyState==4 && this.status==200) {
                            document.getElementById("livesearch").innerHTML=this.responseText;
                            document.getElementById("livesearch").style.color="red";
                          }
                        }
                        xmlhttp.open("GET","./Tashrif/lastname.php?q="+str,true);
                        xmlhttp.send();
                      }
                      function lastPhone(str) {
                        if (str.length==0) {
                          document.getElementById("livesearch2").innerHTML="";
                          return;
                        }
                        var xmlhttp=new XMLHttpRequest();
                        xmlhttp.onreadystatechange=function() {
                          if (this.readyState==4 && this.status==200) {
                            document.getElementById("livesearch2").innerHTML=this.responseText;
                            document.getElementById("livesearch2").style.color="red";
                          }
                        }
                        xmlhttp.open("GET","./Tashrif/lastPhone.php?q="+str,true);
                        xmlhttp.send();
                      }
                    </script>
                      <div class="col-lg-12">
                        <label for="" class="input-label">FIO <p id="livesearch" style="padding:0;margin:0;"></p></label>
                        <input type="text" name="FIO" onkeyup="lastName(this.value)" class="form-control input_form" placeholder="Yangi talaba FIO" required>
                      </div>
                      <div class="col-lg-6">
                        <label for="" class="input-label">Telefon raqami <p id="livesearch2" style="padding:0;margin:0;"></p></label>
                        <input type="text" name="Phone"  onkeyup="lastPhone(this.value)" class="form-control input_form phone" value="998" required>
                      </div>
                      <div class="col-lg-6">
                        <label for="" class="input-label">Yaqin tanishi(FIO)</label>
                        <input type="text" name="Tanish" class="form-control input_form" placeholder="Yaqin tanishi FIO" required>
                      </div>
                      <div class="col-lg-6">
                        <label for="" class="input-label">Tanishining tel raqami</label>
                        <input type="text" name="TPhone" class="form-control input_form phone" value="998" required>
                      </div>
                      <div class="col-lg-6">
                        <label for="" class="input-label">Tug'ilgan kun</label>
                        <input type="date" name="Tkun" class="form-control input_form" placeholder="Talabaning tugilgan kuni" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Talaba haqida</label>
                        <input type="text" name="about" class="form-control input_form" placeholder="Talaba haqida" required>
                      </div>
                      <div class="col-lg-6">
                        <label for="" class="input-label">Yashash joyi</label>
                        <select name="Addres" class="form-control select_form" required>
                          <option value="">Tanlang</option>
                          <option value="10401">Qarshi Shaxar</option>
                          <option value="10246">Shaxrisabz Shaxar</option>
                          <option value="10224">Qarshi Tuman</option>
                          <option value="10220">Qamashi Tuman</option>
                          <option value="10235">Nishon Tuman</option>
                          <option value="10246">Shaxrisabz Tuman</option>
                          <option value="10232">Kitob Tuman</option>
                          <option value="10250">Yakkabog' Tuman</option>
                          <option value="10242">Chiroqchi Tuman</option>
                          <option value="10240">Ko'kdala Tuman</option>
                          <option value="10233">Mirishkor Tuman</option>
                          <option value="10234">Muborak Tuman</option>
                          <option value="10237">G'uzor Tuman</option>
                          <option value="10229">Koson Tuman</option>
                          <option value="10212">Dexqonobod Tuman</option>
                        </select>
                      </div>
                      <div class="col-lg-6">
                        <label for="" class="input-label">Biz haqimizda</label>
                        <select name="haqimizda" class="form-control select_form" required>
                          <option value="">Tanlang</option>
                          <option value="Telegram">Telegram</option>
                          <option value="Instagram">Instagram</option>
                          <option value="Facebook">Facebook</option>
                          <option value="Bannerlar">Bannerlar</option>
                          <option value="Tanishlar">Tanishlar</option>
                          <option value="Boshqa">Boshqa</option>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="newStudent" class="Filter_btn btn">Yangi tashrifni saqlash</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 my-2 text-center">
            <form class="row" action='tashrif.php' method='POST'>
              <div class='col-lg-4'>
                <label>Tashrif turi</label>
                <select name="filter" class='form-control mb-1' style='border-radius:0'>
                  <option value="all">Barchasi</option>
                  <option value="qarz">Qarzdorlar</option>
                  <option value="newguruh">Guruhi mavjud yangi talabalar</option>
                  <option value="activeguruh">Aktiv talabalar</option>
                  <option value="endguruh">Yakunlangan guruh talabalari</option>
                  <option value="guruhmavjud">Guruhlari mavjud talabalar</option>
                  <option value="guruhmavjudemas">Guruhi mavjud bo'lmagan talabalar</option>
                </select>
              </div>
              <div class='col-lg-4'>
                <label>Tashrif vaqti</label>
                <select name='vaqt' class='form-control mb-1' style='border-radius:0'>
                  <option value="all">Barchasi</option>
                  <option value="kun">Kun boshidan</option>
                  <option value="hafta">Hafta boshidan</option>
                  <option value="oy">Oy boshidan</option>
                  <option value="yil">Yil boshidan</option>
                </select>
              </div>
              <div class='col-lg-4'>
                <label style='color:#F6F9FF;'>.</label>
                <button type='submit' name="filteruz" class='btn btn-primary w-100' style='border-radius:0'>Filter</button>
              </div>
            </form>
          </div>
          <div class="col-12">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <?php
                  $kun = date("Y-m-d");
                  $haftaBoshi = date('Y-m-d', strtotime("this week"));
                  $OyBosh = date("Y-m-01");
                  $YilBosh = date("Y-01-01");
                  if(isset($_POST['filteruz'])){
                    if($_POST['filter']==='all'){
                      // Barcha tashriflar
                      include_once("./Tashrif/Barcha.php");
                    } 
                    elseif ($_POST['filter']==='qarz') {
                      // Qarzdor tashriflar
                      include_once("./Tashrif/Qarz.php");
                    } 
                    elseif ($_POST['filter']==='newguruh') {
                      include_once("./Tashrif/NewGuruh.php");
                    } 
                    elseif ($_POST['filter']==='activeguruh') {
                      // Aktive guruhlar
                      include_once("./Tashrif/ActiveGuruh.php");
                    } 
                    elseif ($_POST['filter']==='endguruh') {
                      // Yakunlangan guruhlar
                      include_once("./Tashrif/EndGuruh.php");
                    } 
                    elseif ($_POST['filter']==='guruhmavjud') {
                      // Guruhlari mavjud tashriflar
                      include_once("./Tashrif/MavjudGuruh.php");
                    } 
                    elseif ($_POST['filter']==='guruhmavjudemas') {
                      // Guruh mavjud emas bo'lgan tashriflar
                      include_once("./Tashrif/MavjudEmasGuruh.php");
                    }
                  }
                  else{
                    //All Tashriflar
                    include_once("./Tashrif/All.php");
                  }
                ?>
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
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#datatable').DataTable();
    });
  </script>
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