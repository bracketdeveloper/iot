<?php
session_start();

if( !(isset($_SESSION['admin']) && $_SESSION['admin'] == "True") &&
    !(isset($_SESSION['staff']) && $_SESSION['staff'] == "True")){
    echo "<script>window.location.replace('login.php')</script>";
}
?>
<?php
$pageTile = "Home Page";
require_once "commons/head.php";
?>
  <!-- ======= Header ======= -->
<?php require_once "commons/header.php";?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?php echo $pageTile?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">

                <!-- Air Quality Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">


                        <div class="card-body">
                            <h5 class="card-title">Air Quality</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-chevron-double-right"></i>
                                </div>
                                <div class="ps-3">
                                    <a class="btn btn-success" href="tabs.php?tab_id=8">Details</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Air Quality Card -->

                <!-- Water Quality Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Water Quality</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cloud-drizzle"></i>
                                </div>
                                <div class="ps-3">
                                    <a class="btn btn-success" href="tabs.php?tab_id=9">Details</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Water Quality Card -->

                <!-- Land Monitoring Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Land Monitoring</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bx bxs-landscape"></i>
                                </div>
                                <div class="ps-3">
                                    <a class="btn btn-success" href="tabs.php?tab_id=10">Details</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Land Monitoring Card -->

                <!-- CubeSat Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">CubeSat</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-textarea"></i>
                                </div>
                                <div class="ps-3">
                                    <a class="btn btn-success" href="tabs.php?tab_id=11">Details</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End CubeSat Card -->

                <!-- Indoor Monitoring Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Indoor Monitoring</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div class="ps-3">
                                    <a class="btn btn-success" href="tabs.php?tab_id=12">Details</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Indoor Monitoring Card -->






            </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once "commons/footer.php";?>