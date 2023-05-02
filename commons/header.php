<?php

$allTabs = getAllTabs($conn);
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    session_destroy();
    echo "<script>window.location.replace('profile.php');</script>";
}
$userName = "";
if (isset($_SESSION['admin'])) {
    $userId = $_SESSION['admin_id'];
    $userName = $_SESSION['admin_name'];
    $userEmail = $_SESSION['admin_email'];
    $userPassword = $_SESSION['admin_password'];
}if (isset($_SESSION['staff'])) {
    $userId = $_SESSION['staff_id'];
    $userName = $_SESSION['staff_name'];
    $userEmail = $_SESSION['staff_email'];
    $userPassword = $_SESSION['staff_password'];
}

?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Smart System</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $userName ?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo $userName ?></h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="profile.php">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a href="#"
                           class="dropdown-item d-flex align-items-center" onclick="return confirmLogout()">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link " href="index.php">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->

    <?php
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'True'):
    ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="staff_members.php">
            <i class="bi bi-people"></i>
            <span>Staff Members</span>
        </a>
    </li><!-- End Profile Page Nav -->
    <?php
      endif;
            ?>

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-tablet-landscape"></i><span>Tabs</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                 <?php
                 $i = 0;
                 foreach ($allTabs as $tab):
                     $i++;
                 ?>
                 <li>
                     <a href="tabs.php?tab_id=<?php echo "{$tab['tab_id']}"; ?>">
                         <i class="bi bi-circle"></i><span><?php echo "{$tab['tab']}"; ?></span>
                     </a>
                 </li>
                 <?php endforeach;
                 if($i > 0 && isset($_SESSION['admin']) && $_SESSION['admin'] == 'True'):
                 ?>
                 <li>
                     <a href="tabs_details.php">
                         <i class="bi bi-circle"></i><span>Tabs Details</span>
                     </a>
                 </li>
                 <?php endif;?>
             </ul>
         </li>
    </ul>


</aside><!-- End Sidebar-->
