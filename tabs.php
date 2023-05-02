<?php
session_start();
if(!(isset($_SESSION['admin']) && $_SESSION['admin'] == "True")){
    echo "<script>window.location.replace('index.php')</script>";
}
?>
<?php
$pageTile = "Tabs";
require_once "commons/head.php";
require_once "data/air_quality.php";
$staffMembers = getAllStaffMembers($conn);
?>
  <!-- ======= Header ======= -->
<?php require_once "commons/header.php";?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?php echo $pageTile?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <div id="co2-container" style="height: 370px; width: 100%;"></div>

                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <div id="humidity-container" style="height: 370px; width: 100%;"></div>

                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <div id="temperature-container" style="height: 370px; width: 100%;"></div>

                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <div id="pm10-container" style="height: 370px; width: 100%;"></div>

                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <div id="pm25-container" style="height: 370px; width: 100%;"></div>

                    </div>
                </div>

            </div>



        </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once "commons/footer.php";?>