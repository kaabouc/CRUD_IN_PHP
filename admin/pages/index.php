<?php 
      session_start();

      if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
          header("Location: ../../login.php");
          exit;
      }
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
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>  Appareil</h3>

              </div>
              <div class="icon">
               <i class="fas fa-car"></i>
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
          </div>
    
          <!-- ./col -->
        </div>

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

            <?php
            // Assuming you have a database connection established
          

            // Retrieve the infraction data from the database
            $query = "SELECT Date, COUNT(*) AS infractionCount FROM infraction GROUP BY Date ORDER BY Date ASC";
            $result = $conn->query($query);

            // Check if the query was successful
            if (!$result) {
                die('Query failed: ' . mysqli_error($conn));
            }

            // Format the data for the chart
            $databaseData = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $databaseData[] = $row;
            }

            // Close the database connection
         

            // Generate the chart dynamically
            
            echo '<canvas id="infractionChart"></canvas><br/><br/>';
           
            ?>
            <?php
            // Assuming you have a database connection established
          

            // Retrieve the infraction data from the database
            $query_voiture = "SELECT Energie, COUNT(*) AS VoitureCount FROM voiture GROUP BY Energie ORDER BY Energie ASC";
            $result_voiture = $conn->query($query_voiture);

            // Check if the query was successful
            if (!$result_voiture) {
                die('Query failed: ' . mysqli_error($conn));
            }

            // Format the data for the chart
            $databaseData_voiture = array();
            while ($row = mysqli_fetch_assoc($result_voiture)) {
                $databaseData_voiture[] = $row;
            }

            // Close the database connection
         

            // Generate the chart dynamically
            
            echo '<canvas id="voitureChart"></canvas> <br/>';
           
            ?>


            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
               // Retrieve the data from PHP
                  var databaseData = <?php echo json_encode($databaseData); ?>;
                  var databaseData_voiture = <?php echo json_encode($databaseData_voiture); ?>;
                // Generate the chart data
                var labels = databaseData.map(function (data) {
                    return data.Date;
                });

                var infractionCounts = databaseData.map(function (data) {
                    return data.infractionCount;
                });

                                // Initialize Chart.js and render the chart
                var ctx = document.getElementById('infractionChart').getContext('2d');
                var cte = document.getElementById('voitureChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',//bar
                    data: {
                        labels: <?php echo json_encode(array_column($databaseData, 'Date')); ?>,
                        datasets: [{
                            label: 'Infraction Evolution',
                            data: <?php echo json_encode(array_column($databaseData, 'infractionCount')); ?>,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
                var chart = new Chart(cte, {
                    type: 'bar',//bar
                    data: {
                        labels: <?php echo json_encode(array_column($databaseData_voiture, 'Energie')); ?>,
                        datasets: [{
                            label: ' Gestion Voiture ',
                            data: <?php echo json_encode(array_column($databaseData_voiture, 'VoitureCount')); ?>,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: ['rgba(5, 92, 9192, 112)' , '#17507'  , 'rgba(500, 9, 192, 112)' , 'yellow'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
               
            </script>

          </section>

          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Visitors
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 250px; width: 100%;"></div>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->

           
            <!-- /.card -->

            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>







<?php include('../includes/footer.php') ?>