<?php
session_start();
if(!((isset($_SESSION['admin']) && $_SESSION['admin'] == "True"))){
    echo "<script>window.location.replace('login.php')</script>";
}
?>
<?php
$pageTile = "Edit Member";
require_once "commons/head.php";
$staffId = $_GET['staff_id'];
$staffDetails = getSpecificStaffMemberById($conn, $staffId);
if(sizeof($staffDetails) == 0){
    echo "<script>window.location.replace('index.php')</script>";
}
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
              <h5 class="card-title">Edit Staff Details</h5>
              <!-- Profile Edit Form -->

              <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                      Name</label>
                  <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" id="edit-staff-name"
                      value="<?php echo $staffDetails[0]['staff_name']?>">
                  </div>
              </div>
              <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                      <input type="text" class="form-control" id="edit-staff-email"
                             value="<?php echo $staffDetails[0]['staff_email']?>">
                  </div>
              </div>

              <div class="text-center">
                  <button type="submit" class="btn btn-primary"
                          onclick="return validateEditStaff('<?php echo "{$staffDetails[0]['staff_id']}"?>', '<?php echo "{$staffDetails[0]['staff_email']}"?>')"
                          id="btn-edit-new-staff">Edit Staff
                  </button>
              </div>
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once "commons/footer.php";?>