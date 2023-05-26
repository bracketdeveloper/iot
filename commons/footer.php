
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <a href="https://www.southwales.ac.uk/"><strong><span>USW</span></strong></a>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by Mian Ammar Salar
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/form_requests.js"></script>
<script src="assets/js/custom_script.js"></script>

<!-- Sweet Alert 2 JS-->
<script src="assets/js/sweet_alerts.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script>
    $.ajax({
        url: "admin/ajax_process.php?action=add_real_data",
        type: 'POST',
        contentType: false,
        processData: false,
    }).done(function (data) {
        console.log(data)
        /* login successful code is 1*/
    });
</script>

</body>

</html>