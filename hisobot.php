<?php
  include("./confige/confige.php");
  include("./confige/topHeader.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Hisobot</title>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="assets/js/FileSaver.min.js"></script>
    <script src="assets/js/tableExport.js"></script>
    <script type="text/javaScript">
        function doExport() {
          $('#excelstyles').tableExport({
              type:'excel',
              mso: {
                styles: ['background-color',
                         'color',
                         'font-family',
                         'font-size',
                         'font-weight',
                         'text-align']
              }
            }
          );
        }
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
        <a class="nav-link collapsed" href="techer.php">
          <i class="bi bi-person-badge"></i>
          <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="nav-item"  style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
        <a class="nav-link collapsed" href="statistik.php">
          <i class="bi bi-bar-chart"></i>
          <span>Statistika</span>
        </a>
      </li>
      <li class="nav-item"  style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';}} ?>">
        <a class="nav-link" href="hisobot.php">
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
          <li class="breadcrumb-item active">Hisobotlar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center">
                <h5 class="card-title">Hisobotlar</h5>
                <script>
                  function showUser(str) {
                    if (str == "") {
                      document.getElementById("txtHint").innerHTML = "";
                      return;
                    } else {
                      var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                      };
                      xmlhttp.open("GET","./hisobot/getuser.php?q="+str,true);
                      xmlhttp.send();
                    }
                  }
                </script>
                <form action="" method="post">
                  <div class="row">
                    <div class="col-lg-4">
                      <label>Tanlang</label>
                      <select name="Filter2" class="form-control" onchange="showUser(this.value)" required>
                        <option value="">Tanlang</option>
                        <option value="tashriflar">Tashriflar</option>
                        <option value="guruhlar">Guruhlar</option>
                        <option value="oqituvchilar">O'qituvchilar</option>
                        <option value="moliya">Moliya</option>
                        <option value="hodimlar">Hodimlar</option>
                      </select>
                    </div>
                    <div id="txtHint" class="col-lg-4"></div>
                    <div class="col-lg-4">
                      <label>.</label>
                      <button name="filter" class="btn btn-primary w-100">Filter</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php
            if(isset($_POST['filter'])){
              if($_POST['Filter2']==='tashriflar'){
                include("./hisobot/tashriflar.php");
              }elseif ($_POST['Filter2']==='guruhlar') {
                include("./hisobot/guruhlar.php");
              }elseif ($_POST['Filter2']==='oqituvchilar') {
                include("./hisobot/oqituvchilar.php");
              }elseif ($_POST['Filter2']==='moliya') {
                include("./hisobot/moliya.php");
              }elseif ($_POST['Filter2']==='hodimlar') {
                include("./hisobot/hodimlar.php");
              }
            } 
          ?>
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
</body>
</html>