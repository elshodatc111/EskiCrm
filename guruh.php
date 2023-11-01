<?php
  include("./confige/confige.php");
  include("./confige/topHeader.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Guruhlar</title>
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
        if(isset($_GET['newGuruh'])){echo "alert('Yangi guruh qo`shildi')";}
        if(isset($_GET['timeError'])){echo "alert('Dars vaqtlarini tanlamadingiz qaytadan urinib ko`ring')";}
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
        <a class="nav-link " href="guruh.php">
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
      <li class="nav-item"  style="display:<?php if(isset($_COOKIE['Status'])){if($_COOKIE['Status']==='meneger'){echo 'none';} }?>">
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
          <li class="breadcrumb-item active">Guruhlar</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-body text-center p-0">
                <button class="btn btn-primary button_btn" data-bs-toggle="modal" data-bs-target="#addguruh"><i class="bi bi-card-checklist"></i> Yangi guruh</button>
              </div>
            </div>
          </div>
          <div class="modal fade" id="addguruh" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Yangi guruh</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="./conUsers/myguruh.php" method="POST" id="form">
                    <div class="row">
                      <div class="col-lg-6">
                        <label for="" class="input-label">Guruh nomi</label>
                        <input type="text" name="GuruhName" class="form-control input_form" placeholder="Guruh nomi" required>
                      </div>
                      <div class="col-lg-6">
                        <label for="" class="input-label">Kursni tanlang</label>
                        <select name="CoursID" class="form-control select_form" required>
                          <?php
                            $selCours = "SELECT * FROM `cours` WHERE 1";
                            $resCours = $Confige->SelectAll($selCours);
                            if($resCours->num_rows>0){
                              echo "<option value=''>Tanlang</option>";
                              while ($rowsC = $resCours->fetch_assoc()) {
                                echo "<option value=".$rowsC['CoursID'].">".$rowsC['CoursName']."</option>";
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-lg-12" style='display:none;'>
                        <label for="" class="input-label">To'lovlar soni</label>
                        <input type="number" name="TulovCount" class="form-control input_form" value='1' placeholder="To'lovlar soni" required>
                      </div>
                      <div class="col-lg-4">
                        <label for="" class="input-label">To'lov summasi</label>
                        <input type="text" name="TulovSumma" class="form-control input_form" id="tulovsumma" placeholder="To'lov summasi" required>
                      </div>
                      <div class="col-lg-4">
                        <label for="" class="input-label">O'qituvchiga to'lov</label>
                        <input type="text" id="techtulov" name="tulov" class="form-control input_form" placeholder="O'qituvchiga to'lov" required>
                      </div>
                      <div class="col-lg-4">
                        <label for="" class="input-label">O'qituvchi bonus</label>
                        <input type="text" id='bonus' name="bonus" class="form-control input_form" placeholder="O'qituvchi bonus" required>
                      </div>
                      <div class="col-lg-4">
                        <label for="" class="input-label">Boshlanish vaqti</label>
                        <input type="date" id="date1" name="startTime" class="form-control input_form" placeholder="%" required>
                      </div>
                      <div class="col-lg-4">
                        <label for="" class="input-label">Yakunlanish vaqti</label>
                        <input type="date"  id="date2" name="endTime" class="form-control input_form" placeholder="%" required>
                      </div>
                      <script>
                        let data01 = document.getElementById('date1');
                        let data02 = document.getElementById('date2');
                      </script>
                      <div class="col-lg-4">
                        <label for="" class="input-label">Xonani tanlang</label>
                        <select name="xona" onchange="showUser(this.value, data01.value, data02.value)" class="form-control select_form" required>
                            <?php
                              $xonaSql = "SELECT * FROM `xonalar`";
                              $resXona = $Confige->SelectAll($xonaSql);
                              if($resXona->num_rows>0){
                                echo '<option value="">Tanlang</option>';
                                while ($rows=$resXona->fetch_assoc()) {
                                  echo '<option value='.$rows['XonaNomi'].'>'.$rows['XonaNomi'].'</option>';
                                }
                              }
                            ?>
                          
                        </select>
                      </div>     
                      <script>
                        function showUser(str,date1,date2) {
                          if (str == "") {
                            document.getElementById("txtHint").style.display='block';
                            return;
                          } else {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                              if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("txtHint").innerHTML = this.responseText;
                              }
                            };
                            xmlhttp.open("GET","./conUsers/xonaroms.php?q="+str+"&d1="+date1.toString()+"&d2="+date2.toString(),true);
                            xmlhttp.send();
                          }
                        }
                      </script> 
                      <div id="txtHint">
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
                <h5 class="card-title">Guruhlar</h5>
                <div class="table-responsive text-nowrap">
									<table class="table table-bordered border-primary table-striped  " id="datatable" style='font-size:14px'>
                    <thead >
                      <tr style='font-size:16px;'>
                        <th>#</th>
                        <th>Guruh nomi<hr style="width:200px;margin:0;padding:0;color:#fff;"></th>
                        <th>Boshlanish vaqti</th>
                        <th>Tugash vaqti</th>
                        <th>Talabalar soni</th>
                        <th>To'lovlar summasi</th>
                        <th>Guruh holati</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql = "SELECT * FROM `guruh` WHERE `End`>='".date('Y-m-d', strtotime('-1 month'))."' ORDER BY `End` DESC";
                        $res = $Confige->SelectAll($sql);
                        if($res->num_rows>0){
                          $i=1;
                          $thisDay = date("Y-m-d");
                          while($row = $res->fetch_assoc()){
                            $Start = $row['Start'];
                            $End = $row['End'];
                            $sqltal = "SELECT * FROM `guruh_users` WHERE `GuruhID`='".$row['GuruhID']."'";
                            $restal = $Confige->SelectAll($sqltal);
                            $talabalar = 0;
                            if($restal->num_rows>0){
                                while($rowtal=$restal->fetch_assoc()){
                                    $talabalar = $talabalar+1;
                                }
                            }
                            echo "
                            <tr>
                              <td class='text-center'>".$i."</td>
                              <td style='font-size:14px'>".$row['GuruhName']."</td>
                              <td class='text-center'>".$row['Start']."</td>
                              <td class='text-center'>".$row['End']."</td>
                              <td class='text-center'>".$talabalar."</td>
                              <td class='text-center'>".number_format(($row['Summa']), 0, '.', ' ')."</td>
                              <td class='text-center'>";
                                if($Start>$thisDay){
                                  echo "<span class='badge bg-primary'>Yangi</span>";
                                }elseif($End<=$thisDay){
                                  echo "<span class='badge bg-danger'>Yakunlangan</span>";
                                }else{
                                  echo "<span class='badge bg-success'>Active</span>";
                                }
                              ?>
                                
                                
                                
                              <?php
                              echo "</td>
                              <td class='text-center'><a href='./blog/guruh_eye.php?GuruhID=".$row['GuruhID']."'><i class='bi bi-arrow-right-circle'></i></a></td>
                            </tr>
                            ";
                            $i++;
                          }
                        }else{
                          echo "<tr><td colspan='7' class='text-center'>Guruhlar mavjud emas</td></tr>";
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
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="./library/dselect.js"></script>
  <script>
    $(document).ready(function () {
      $('#datatable').DataTable();
    });
    

    (function($, undefined) {
    "use strict";
      $(function() {
        var $form = $( "#form" );
        var $input = $form.find( "#tulovsumma" );
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
        });
        var $input2 = $form.find( "#techtulov" );
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
        });
        var $input3 = $form.find( "#bonus" );
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
        });


    });
  })(jQuery);
  </script>
</body>
</html>