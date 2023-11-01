<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="./index.php" class="logo d-flex align-items-center">
        <img src="./assets/images/logo.png" alt=""><span class="d-none d-lg-block"><?php echo $logo; ?></span></a><i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item">
          <a class="nav-link nav-icon" href="./blog/tkun.php" title='Tug`ilgan kun'>
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">
            <?php
              $sqlTkun = "SELECT * FROM  user_student WHERE  DATE_ADD(Tkun, INTERVAL YEAR(CURDATE())-YEAR(Tkun) + IF(DAYOFYEAR(CURDATE()) > (Tkun),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY);";
              $ResTkun = $Confige->SelectAll($sqlTkun);
              $TKun = 0;
              if($ResTkun->num_rows>0){
                while ($rowTkun=$ResTkun->fetch_assoc()) {
                  $TKun = $TKun + 1;
                }
              }
              $sqlTkun2 = "SELECT * FROM  user_meneger WHERE  DATE_ADD(TDay, INTERVAL YEAR(CURDATE())-YEAR(TDay) + IF(DAYOFYEAR(CURDATE()) > (TDay),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY);";
              $ResTkun2 = $Confige->SelectAll($sqlTkun2);
              if($ResTkun2->num_rows>0){
                while ($rowTkun=$ResTkun2->fetch_assoc()) {
                  $TKun = $TKun + 1;
                }
              }
              $sqlTkun3 = "SELECT * FROM  user_techer WHERE  DATE_ADD(TDate, INTERVAL YEAR(CURDATE())-YEAR(TDate) + IF(DAYOFYEAR(CURDATE()) > (TDate),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY);";
              $ResTkun3 = $Confige->SelectAll($sqlTkun3);
              if($ResTkun3->num_rows>0){
                while ($rowTkun=$ResTkun3->fetch_assoc()) {
                  $TKun = $TKun + 1;
                }
              }
              echo $TKun;
            ?>
            </span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="./blog/messege.php" title='Eslatmalar'>
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-primary badge-number">
            <?php
              $bellsql = "SELECT * FROM  user_student_eslatma WHERE  DATE_ADD(Date, INTERVAL YEAR(CURDATE())-YEAR(Date) + IF(DAYOFYEAR(CURDATE()) > (Date),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 0 DAY);";
              $resbell = $Confige->SelectAll($bellsql);
              $countbell = 0;
              if($resbell->num_rows>0){
                while ($rowbell = $resbell->fetch_assoc()) {
                  $countbell = $countbell + 1;
                }
              }
              echo $countbell;
            ?>
          </span>
          </a>
        </li>
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="./assets/images/user_icon.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php  if(isset($_COOKIE['FIO'])){ echo$_COOKIE['FIO']; } ?></h6>
              <span><?php  if(isset($_COOKIE['FIO'])){ echo$_COOKIE['Username']; } ?></span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="./blog/kobinet.php"><i class="bi bi-person"></i><span>Kobinet</span></a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="./login.php"><i class="bi bi-box-arrow-right"></i><span>Chiqish</span></a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>