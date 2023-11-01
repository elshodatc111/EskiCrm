<?php
  include("./confige/confige.php");
  include("./confige/topHeader.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Moliya</title>
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
        if(isset($_GET['moliya1'])){echo "alert('Chiqim qilindi.')";}
        if(isset($_GET['delete'])){echo "alert('Bekor qilindi.')";}
        if(isset($_GET['tasdiq'])){echo "alert('Tasdiqlandi')";}
        if(isset($_GET['mavjud'])){echo "alert('Chiqim qilish uchun kiritligan summa mavjud emas. Mavjud summani kiriting')";}
        #if(isset($_GET['chiqimplus'])){echo "alert('Chiqim uchun summa tasdiqlnishi kutilmoqda.')";}
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
        <a class="nav-link collapsed" href="hisobot.php">
          <i class="bi bi-file-earmark-pdf"></i>
          <span>Hisobotlar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="moliya.php">
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
          <li class="breadcrumb-item active">Moliya</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
          <div class="col-12" style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='xisobchi'){echo 'none';}} ?>">
          
                <div class="card info-card revenue-card">
                  <div class="card-body cards_main2">
                    <div class="row">
                      <div class='col-lg-3 col-6'><button class="btn btn-outline-primary w-100 my-1" data-bs-toggle="modal" data-bs-target="#filter"><i class="bi bi-cash-coin"></i> Naqt Chiqim</button></div>
                      <div class='col-lg-3 col-6'><button class="btn btn-outline-success  w-100 my-1" data-bs-toggle="modal" data-bs-target="#plastik"><i class="bi bi-credit-card"></i> Plastik Chiqim</button></div>
                      <div class='col-lg-3 col-6'><button class="btn btn-outline-warning w-100 my-1" data-bs-toggle="modal" data-bs-target="#addtashrif"><i class="bi bi-cash-coin"></i> Naqt Xarajatlar</button></div>
                      <div class='col-lg-3 col-6'><button class="btn btn-outline-danger w-100 my-1" data-bs-toggle="modal" data-bs-target="#plastik22"><i class="bi bi-credit-card"></i> Plastik Xarajatlar</button></div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <?php
            // Jami to'lovlar
            $JtulovNaqt = 0;
            $JtulovPlastik = 0;
            $sqlTulov = "SELECT * FROM `user_student_tulov`";
            $resTulov = $Confige->SelectAll($sqlTulov);
            if($resTulov->num_rows>0){
              while($rowTulov = $resTulov->fetch_assoc()){
                if($rowTulov['TulovType']==='Naqt'){
                  $JtulovNaqt = $JtulovNaqt + $rowTulov['Summa'];
                }elseif($rowTulov['TulovType']==='Plastik'){
                  $JtulovPlastik = $JtulovPlastik + $rowTulov['Summa'];
                }
              }
            }
            // Qaytarilgan to'lovlar
            $JqaytNaqt = 0;
            $JqaytPlastik = 0;
            $sqlQaytar = "SELECT * FROM `qaytar`";
            $resQayt = $Confige->SelectAll($sqlQaytar);
            if($resQayt->num_rows>0){
              while($rowQaytar = $resQayt->fetch_assoc()){
                if($rowQaytar['Type']==='Naqt'){
                  $JqaytNaqt = $JqaytNaqt + $rowQaytar['Summa'];
                }elseif($rowQaytar['Type']==='Plastik'){
                  $JqaytPlastik = $JqaytPlastik + $rowQaytar['Summa'];
                }
              }
            }
            // Tasdiqlangan chiqim
            $JxarajatNaqt = 0;
            $JxarajatPlastik = 0;
            $JchiqimNaqt = 0;
            $JchiqimPlastik = 0;
            $SqlChiqim = "SELECT * FROM `moliya` WHERE `Type`='true'";
            $resChiqim = $Confige->SelectAll($SqlChiqim);
            if($resChiqim->num_rows>0){
              while($rowChiqim = $resChiqim->fetch_assoc()) {
                if($rowChiqim['TypeTulov']==='Naqt'){
                  $JxarajatNaqt = $JxarajatNaqt + $rowChiqim['TulovSumma'];
                }elseif($rowChiqim['TypeTulov']==='Plastik'){
                  $JxarajatPlastik = $JxarajatPlastik + $rowChiqim['TulovSumma'];
                }elseif($rowChiqim['TypeTulov']==='NaqtXarajat'){
                  $JchiqimNaqt = $JchiqimNaqt + $rowChiqim['TulovSumma'];
                }elseif($rowChiqim['TypeTulov']==='PlastikXara'){
                  $JchiqimPlastik = $JchiqimPlastik + $rowChiqim['TulovSumma'];
                }
              }
            }
            // Tasdiqlanmagan chiqimlar
            $TchiqimNaqt = 0;
            $TchiqimPlastik = 0;
            $TxarajatNaqt = 0;
            $TxarajatPlastik = 0;
            $TsqlXar = "SELECT * FROM `moliya` WHERE `Type`='false'";
            $TresXar = $Confige->SelectAll($TsqlXar);
            if($TresXar -> num_rows>0){
              while ($Trow = $TresXar->fetch_assoc()) {
                if($Trow['TypeTulov']==='Naqt'){
                  $TchiqimNaqt = $TchiqimNaqt + $Trow['TulovSumma'];
                }elseif($Trow['TypeTulov']==='Plastik'){
                  $TchiqimPlastik = $TchiqimPlastik + $Trow['TulovSumma'];
                }elseif($Trow['TypeTulov']==='NaqtXarajat'){
                  $TxarajatNaqt = $TxarajatNaqt + $Trow['TulovSumma'];
                }elseif($Trow['TypeTulov']==='PlastikXara'){
                  $TxarajatPlastik = $TxarajatPlastik + $Trow['TulovSumma'];
                }
              }
            }
            $NaqtQoldiq = $JtulovNaqt-$TchiqimNaqt-$TxarajatNaqt-$JchiqimNaqt-$JxarajatNaqt-$JqaytNaqt;
            $PlastikQoldiq = $JtulovPlastik-$JqaytPlastik-$JxarajatPlastik-$JchiqimPlastik-$TchiqimPlastik-$TxarajatPlastik;
          ?>
          
          <div class="modal fade" id="plastik" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Plastik tulovlar uchun chiqim</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form" action="./moliya/chiqim.php?max=<?php echo number_format(($PlastikQoldiq), 0, '.', ' '); ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Chiqim summasi<span> (Mavjud: <?php echo number_format(($PlastikQoldiq), 0, '.', ' '); ?>)</span></label>
                        <input type="text" id="summa" name="Summa" class="form-control" placeholder="Chiqim summasi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Chiqim uchun izoh</label>
                        <input type="text" name="Izoh" class="form-control" placeholder="Izoh" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="Plastikchiqim" class="Filter_btn btn">Chiqim qilish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="filter" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Naqt to'lovlar uchun chiqim</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form1" action="./moliya/chiqim.php?max=<?php echo number_format(($NaqtQoldiq), 0, '.', ' '); ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Chiqim summasi<span> (Mavjud: <?php echo number_format(($NaqtQoldiq), 0, '.', ' '); ?>)</span></label>
                        <input type="text" id="summa1" name="Summa" class="form-control" max=<?php echo number_format(($NaqtQoldiq), 0, '.', ' '); ?> placeholder="Chiqim summasi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Chiqim uchun izoh</label>
                        <input type="text" name="Izoh" class="form-control" placeholder="Izoh" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="Naqtchiqim" class="Filter_btn btn">Chiqim qilish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="plastik22" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Plastik xarajatlar uchun chiqim qilish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form2" action="./moliya/chiqim.php?max=<?php echo number_format(($PlastikQoldiq), 0, '.', ' '); ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Xarajat uchun chiqim summasi<span> (Mavjud: <?php echo number_format(($PlastikQoldiq), 0, '.', ' '); ?>)</span></label>
                        <input type="text" id="summa2" name="Summa" max="sds" class="form-control" placeholder="Chiqim summasi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Xarajat uchun izoh</label>
                        <input type="text" name="Izoh" class="form-control" placeholder="Izoh" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="xarajarPlas" class="Filter_btn btn">Chiqim qilish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="addtashrif" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Naqt xarajatlar uchun chiqim qilish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form3" action="./moliya/chiqim.php?max=<?php echo number_format(($NaqtQoldiq), 0, '.', ' '); ?>" method="POST">
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="" class="input-label">Xarajat uchun chiqim summasi<span> (Mavjud: <?php echo number_format(($NaqtQoldiq), 0, '.', ' '); ?>)</span></label>
                        <input type="text" id="summa3" name="Summa" max=<?php echo number_format(($NaqtQoldiq), 0, '.', ' '); ?> class="form-control" placeholder="Chiqim summasi" required>
                      </div>
                      <div class="col-lg-12">
                        <label for="" class="input-label">Xarajat uchun izoh</label>
                        <input type="text" name="Izoh" class="form-control" placeholder="Izoh" required>
                      </div>
                      <div class="col-lg-12">
                        <button type="submit" name="xarajarNaqt" class="Filter_btn btn">Chiqim qilish</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
          <div class="col-lg-4">
            <div class="card info-card revenue-card">
              <div class="card-body cards_main2">
                  <h4 class="text-center text-primary" style="font-weight:600">Mavjud summa</h4>
                  <table class="table text-center">
                    <tr>
                      <td style='text-align:left;font-weight:500;'><i class="bi bi-cash-coin"></i> Naqt:</td>
                      <td><?php 
                      echo number_format(($NaqtQoldiq), 0, '.', ' ');
                       ?></td>
                    </tr>
                    <tr>
                      <td style='text-align:left;font-weight:500;'><i class="bi bi-credit-card"></i>  Plastik:</td>
                      <td><?php 
                      echo number_format(($PlastikQoldiq), 0, '.', ' ');
                       ?></td>
                    </tr>
                  </table>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card info-card revenue-card">
              <div class="card-body cards_main2">
                  <h4 class="text-center text-warning" style="font-weight:600">Tasdiqlanmagan chiqim</h4>
                  <table class="table text-center">
                    <tr>
                      <td style='text-align:left;font-weight:500;'><i class="bi bi-cash-coin"></i> Naqt:</td>
                      <td><?php 
                      echo number_format(($TchiqimNaqt), 0, '.', ' ');
                       ?></td>
                    </tr>
                    <tr>
                      <td style='text-align:left;font-weight:500;'> <i class="bi bi-credit-card"></i> Plastik:</td>
                      <td><?php 
                      echo number_format(($TchiqimPlastik), 0, '.', ' ');
                       ?></td>
                    </tr>
                  </table>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card info-card revenue-card">
              <div class="card-body cards_main2">
                  <h4 class="text-center text-danger" style="font-weight:600">Tasdiqlanmagan xarajat</h4>
                  <table class="table text-center">
                    <tr>
                      <td style='text-align:left;font-weight:500;'><i class="bi bi-cash-coin"></i> Naqt</td>
                      <td><?php 
                      echo number_format(($TxarajatNaqt), 0, '.', ' ');
                       ?></td>
                    </tr>
                    <tr>
                      <td style='text-align:left;font-weight:500;'><i class="bi bi-credit-card"></i> Plastik</td>
                      <td><?php 
                      echo number_format(($TxarajatPlastik), 0, '.', ' ');
                       ?></td>
                    </tr>
                  </table>
              </div>
            </div>
          </div>
          </div>
          

          
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Chiqim tarixi</h5>
                <div class="table-responsive text-nowrap">
									<table id="datatable" class="table table-bordered border-primary table-striped my_table_search">
                    <thead >
                      <tr>
                        <th>#</th>
                        <th>Chiqim Summasi</th>
                        <th>Chiqim vaqti</th>
                        <th>Chiqim turi</th>
                        <th>Izoh</th>
                        <th>Meneger</th>
                        <th>Tasdiqlandi</th>
                        <th>Xisobchi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sqla1 = "SELECT * FROM `moliya` ORDER BY `id` DESC";
                        $resa1 = $Confige->SelectAll($sqla1);
                        if($resa1->num_rows>0){
                          $i=1;
                          while ($rowa1=$resa1->fetch_assoc()) {
                            if($rowa1['TypeTulov']==='NaqtXarajat'){
                              $typing = "Xarajatlar uchun naqt chiqim";
                            }elseif($rowa1['TypeTulov']==='PlastikXara'){
                              $typing = "Xarajatlar uchun plastik chiqim";
                            }elseif($rowa1['TypeTulov']==='Naqt'){
                              $typing = "Naqt chiqim";
                            }elseif($rowa1['TypeTulov']==='Plastik'){
                              $typing = "Plastik chiqim";
                            }
                            if($rowa1['Tasdiqlandi']==='0000-00-00 00:00:00'){
                              $tasdiq = "Tasdiqlanmagan";
                            }else{
                              $tasdiq = $rowa1['Tasdiqlandi'];
                            }
                            echo "<tr>
                              <td class='text-center'>".$i."</td>
                              <td class='text-center'>".number_format(($rowa1['TulovSumma']), 0, '.', ' ')
                              ."</td>
                              <td class='text-center'>".$rowa1['ChiqimVaqt']."</td>
                              <td class='text-center'>".$typing."</td>
                              <td class='text-center'>".$rowa1['Izoh']."</td>
                              <td class='text-center'>".$rowa1['Meneger']."</td>
                              <td class='text-center'>".$tasdiq."</td>
                              <td class='text-center'>";
                              if($rowa1['Xisobchi']==='NULL'){
                                if(isset($_COOKIE['Status'])){
                                  if($_COOKIE['Status']==='xisobchi'){
                                    echo "<a href='./moliya/chiqim.php?id=".$rowa1['id']."&tasdiqlash=true' class='btn' style='background-color:red;padding:5px;color:#fff;font-weight:500;'><i class='bi bi-check-circle'></i></a>";
                                  }elseif($_COOKIE['Status']==='admin'){
                                    echo "<a href='./moliya/chiqim.php?id=".$rowa1['id']."&tasdiqlash=true' class='btn' style='background-color:green;padding:5px;margin-right:5px;color:#fff;font-weight:500;'><i class='bi bi-check-circle'></i></a>";
                                    echo "<a href='./moliya/chiqim.php?id=".$rowa1['id']."&tasdiqdelete=true' class='btn' style='background-color:red;padding:5px;color:#fff;font-weight:500;'><i class='bi bi-trash'></i></a>";
                                  }else{
                                    echo "<a href='./moliya/chiqim.php?id=".$rowa1['id']."&tasdiqdelete=true' class='btn' style='background-color:green;padding:5px;color:#fff;font-weight:500;'><i class='bi bi-trash'></i></a>";
                                  }
                                }
                              }else{
                                echo $rowa1['Xisobchi'];
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
  
  <script src="../assets/js/jquery.inputmask.min.js"></script>
  <script>
      (function($, undefined) {
        "use strict";
        $(function() {
          var $form = $( "#form" );
          var $input = $form.find( "#summa" );
          $input.on( "keyup", function( event ) {
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
              return;
            }
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
              return;
            }
            var $this = $( this );
            var input = $this.val();
            var input = input.replace(/[\D\s\._\-]+/g, "");
                input = input ? parseInt( input, 10 ) : 0;
                $this.val( function() {
                  return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
            } );
          } );

          var $form1 = $( "#form1" );
          var $input1 = $form1.find( "#summa1" );
          $input1.on( "keyup", function( event ) {
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
              return;
            }
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
              return;
            }
            var $this = $( this );
            var input1 = $this.val();
            var input1 = input1.replace(/[\D\s\._\-]+/g, "");
                input1 = input1 ? parseInt( input1, 10 ) : 0;
                $this.val( function() {
                  return ( input1 === 0 ) ? "" : input1.toLocaleString( "en-US" );
            } );
          } );

          var $form2 = $( "#form2" );
          var $input2 = $form2.find( "#summa2" );
          $input2.on( "keyup", function( event ) {
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
              return;
            }
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
              return;
            }
            var $this = $( this );
            var input2 = $this.val();
            var input2 = input2.replace(/[\D\s\._\-]+/g, "");
                input2 = input2 ? parseInt( input2, 10 ) : 0;
                $this.val( function() {
                  return ( input2 === 0 ) ? "" : input2.toLocaleString( "en-US" );
            } );
          } );

          var $form3 = $( "#form3" );
          var $input3 = $form3.find( "#summa3" );
          $input3.on( "keyup", function( event ) {
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
              return;
            }
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
              return;
            }
            var $this = $( this );
            var input3 = $this.val();
            var input3 = input3.replace(/[\D\s\._\-]+/g, "");
                input3 = input3 ? parseInt( input3, 10 ) : 0;
                $this.val( function() {
                  return ( input3 === 0 ) ? "" : input3.toLocaleString( "en-US" );
            } );
          } );

          
          


        });
      })(jQuery);
  </script>
</body>
</html>