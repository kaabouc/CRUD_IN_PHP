<?php 
      session_start();

      if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
          header("Location: ../../login.php");
          exit;
      }
      $userType = $_SESSION['userType'];

include "../../config.php";
  //  $sql = "select count(*) as total2  from voiture";
  //  $voi = $conn->query($sql);

  //   $sqll = "select count(*) as total1 from infraction";
  //   $infract = $conn->query($sqll);

  //   $sqlll = "select count(*) as total3 from assurance";
  //   $assur = $conn->query($sqlll);

  //   $sqllll = "select count(*) as total4  from vignette";
  //   $vignet = $conn->query($sqllll);

?>


<?php include('../includes/header.php') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Panneau de contrôle</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">acceuil</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <?php if ($userType == 'admin'  ) { 

echo '  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Client </h3>
 
               
              </div>
              <div class="icon">
              <i class="fas fa-exclamation-triangle"></i>
              </div>
              <a href="../../Client/index.php" class="small-box-footer">EN SAVOIR PLUS <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> Agent reparation</h3>

                
              </div>
              <div class="icon">
              <i class="fas fa-shield-alt"></i>
              </div>
              <a href="../../agent/index.php" class="small-box-footer">EN SAVOIR PLUS <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>  Admin</h3>

              </div>
              <div class="icon">
               <i class="fas fa-shield-alt"></i>
              </div>
              <a href="../../admine/index.php" class="small-box-footer">EN SAVOIR PLUS <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           ';
        } ?>
          <?php if ($userType == 'agent'  ) { 

echo '  
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>  Appareil</h3>

              </div>
              <div class="icon">
               <i class="fas fa-shield-alt"></i>
              </div>
              <a href="../../Appareil/index.php" class="small-box-footer">EN SAVOIR PLUS <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Reparations</h3>

              </div>
              <div class="icon">
              <i class="fas fa-sticky-note"></i>

              </div>
              <a href="../../Reparations/index.php" class="small-box-footer">EN SAVOIR PLUS <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  ';
        } ?>
    
          <!-- ./col -->
        </div>

        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>







<?php include('../includes/footer.php') ?>