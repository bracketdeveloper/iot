<?php
session_start();
if (!((isset($_SESSION['admin']) && $_SESSION['admin'] == "True") ||
    ((isset($_SESSION['user']) && $_SESSION['user'] == "True")))) {
    echo "<script>window.location.replace('login.php')</script>";
}
?>
<?php
$pageTile = "Temperature";
require_once "commons/head.php";
?>
<!-- ======= Header ======= -->
<?php require_once "commons/header.php"; ?>
<?php
$completeData = getAllAirQualityData($conn);

$startDate = null;
$endDate = null;
$i = 0;
foreach ($completeData as $data):
    $date1 = substr($data['received_at'], 0, 10);
    $date1 = strtotime($date1);
    $date = $date1 . "000";
    if($i==0):$startDate = date("Y-m-d", $date1);endif;
    $i++;
    $endDate = date("Y-m-d", $date1);
    endforeach;;
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1><?php echo $pageTile ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title"></h5>
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-2">
                                    <h4>Start Date</h4>
                                    <input type="date" value="<?php if (isset($_GET['btn_temperature_filter'])){echo $_GET['start_date'];}else{echo $startDate;} ?>"
                                           name="start_date" min="<?php echo $startDate ?>"
                                           max="<?php echo $endDate ?>">
                                </div>
                                <div class="col-lg-2">
                                    <h4>End Date</h4>
                                    <input type="date" value="<?php if (isset($_GET['btn_temperature_filter'])){echo $_GET['end_date'];}else{ echo $endDate;
                                    }?>"
                                           name="end_date" min="<?php echo $startDate ?>"
                                           max="<?php echo $endDate ?>">
                                </div>
                                <div class="col-lg-2">
                                    <h6>&nbsp;</h6>
                                    <button class="btn btn-primary"
                                            type="submit" name="btn_temperature_filter">Get Data
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div id="temperature-container" style="height: 370px; width: 100%;"></div>

                    </div>
                </div>


            </div>

        </div>

    </section>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title h2">
                            Daily, Weekly and Yearly Means of Data
                        </h1>
                    </div>
                    <div class="card-body">

                        <div class="row" style="margin-bottom: 20px">
                            <button class="btn btn-success col-lg-1" style="margin-left: 10px"
                                    onclick="return getDailyMeanOfData('temperature')">Daily</button>
                            <button class="btn btn-primary col-lg-1" style="margin-left: 10px"
                                    onclick="return getWeeklyMeanOfData('temperature')">Weekly</button>
                            <button class="btn btn-dark col-lg-1" style="margin-left: 10px"
                                    onclick="return getYearlyMeanOfData('temperature')">Yearly</button>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table " id="mean-table">
                            <h1 class="card-title" id="mean-type-heading">
                                Daily Means of Data
                            </h1>
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Mean</th>
                            </tr>
                            </thead>
                            <tbody id="mean-table-body">
                            <tr>
                                <th scope="row">1</th>
                                <td>1</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>1</td>
                                <td>2</td>
                            </tr>

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php require_once "commons/footer.php"; ?>
    <script>
        window.onload = function() {
            // Your JavaScript code here
            getDailyMeanOfData('temperature');
        };
    </script>

<?php
if (isset($_GET['btn_temperature_filter'])) {
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];

    if ($startDate > $endDate) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Start date cannot be earlier than end date',
            }).then((result) => {

            })
        </script>";
    } else {
        $startDate = date('Y-m-d', strtotime($startDate . ' +1 days'));
        $endDate = date('Y-m-d', strtotime($endDate . ' +2 days'));
        $completeData = getAllAirQualityData($conn);
        $dataPointFilterTemperature = array();

        for ($i = 0; $i < sizeof($completeData); $i++):
            $date1 = substr($completeData[$i]['received_at'], 0, 10);
            $date1 = strtotime($date1);
            $date = $date1 . "000";
            if ($startDate == date('Y-m-d', $date1)):
                for ($j = $i; $j < sizeof($completeData); $j++):
                    $date2 = substr($completeData[$j]['received_at'], 0, 10);
                    $date2 = strtotime($date2);
                    $date = $date2 . "000";

                    if ($endDate == date('Y-m-d', $date2)) {
                        break;
                    }
                    $dataPointFilterTemperature[] =
                        array("x" => $date, "y" => floatval($completeData[$j]['temperature']));
                endfor;
            endif;
            if ($endDate == date('Y-m-d', $date1)) {
                break;
            }
        endfor;
        echo '<script>
                var temperatureChart = new CanvasJS.Chart("temperature-container", {
                animationEnabled: true,
                title:{
                    text: "Temperature"
                },
                axisY: {
                    title: "Temperature (\u{00B0}C)",
                },
                axisX: {
                    title: "Date",
                    xValueFormatString: "DD MMM YY",

                },
                data: [{
                    type: "area",
                    xValueType: "dateTime",
                    xValueFormatString: "DD MMM",
                    dataPoints: ' . json_encode($dataPointFilterTemperature, JSON_NUMERIC_CHECK) . '
                }]
        });

        temperatureChart.render();
</script>';
    }

}else{
    $completeData = getAllAirQualityData($conn);

    $dataPointCo2 = array();
    foreach ($completeData as $data):
        $date1 = substr($data['received_at'], 0, 10);
        $date1 = strtotime($date1);
        $date = $date1 . "000";
        if($i==0):$startDate = date("Y-m-d", $date1);endif;
        $i++;
        $endDate = date("Y-m-d", $date1);

        $dataPointTemperature[] =
            array("x" => $date, "y" => floatval($data['temperature']));

    endforeach;
    echo '<script>
var temperatureChart = new CanvasJS.Chart("temperature-container", {
                animationEnabled: true,
                title:{
                    text: "Temperature"
                },
                axisY: {
                    title: "Temperature (\u{00B0}C)",
                },
                axisX: {
                    title: "Date",
                    xValueFormatString: "DD MMM YY",

                },
                data: [{
                    type: "area",
                    xValueType: "dateTime",
                    xValueFormatString: "DD MMM",
                    dataPoints: '.  json_encode($dataPointTemperature, JSON_NUMERIC_CHECK) .'
                }]
            });

            temperatureChart.render();
</script>';
}
?>