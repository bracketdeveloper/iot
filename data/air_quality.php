<?php
$completeData = getAllAirQualityData($conn);


$dataPointCo2 = array();
$dataPointHumidity = array();
$dataPointTemperature = array();
$dataPointPM10 = array();
$dataPointPM25 = array();

foreach ($completeData as $data):
    $date = substr($data['received_at'], 0, 10);
    $date = strtotime($date);
    $date = $date . "000";

    $dataPointCo2[] =
        array("x" => $date, "y" => floatval($data['co2']),);
endforeach;

foreach ($completeData as $data):
    $date = substr($data['received_at'], 0, 10);
    $date = strtotime($date);
    $date = $date . "000";

    $dataPointHumidity[] =
        array("x" => $date, "y" => floatval($data['humidity']),);
endforeach;

foreach ($completeData as $data):
    $date = substr($data['received_at'], 0, 10);
    $date = strtotime($date);
    $date = $date . "000";

    $dataPointTemperature[] =
        array("x" => $date, "y" => floatval($data['temperature']),);
endforeach;

foreach ($completeData as $data):
    $date = substr($data['received_at'], 0, 10);
    $date = strtotime($date);
    $date = $date . "000";

    $dataPointPM10[] =
        array("x" => $date, "y" => floatval($data['pm10']),);
endforeach;

foreach ($completeData as $data):
    $date = substr($data['received_at'], 0, 10);
    $date = strtotime($date);
    $date = $date . "000";

    $dataPointPM10[] =
        array("x" => $date, "y" => floatval($data['pm10']),);
endforeach;

$dataPoints = array(
    array("x" => 946665000000, "y" => 3289000),
    array("x" => 978287400000, "y" => 3830000),
    array("x" => 1009823400000, "y" => 2009000),
    array("x" => 1041359400000, "y" => 2840000),
    array("x" => 1072895400000, "y" => 2396000),
    array("x" => 1104517800000, "y" => 1613000),
    array("x" => 1136053800000, "y" => 1821000),
    array("x" => 1167589800000, "y" => 2000000),
    array("x" => 1199125800000, "y" => 1397000),
    array("x" => 1230748200000, "y" => 2506000),
    array("x" => 1262284200000, "y" => 6704000),
    array("x" => 1293820200000, "y" => 5704000),
    array("x" => 1325356200000, "y" => 4009000),
    array("x" => 1356978600000, "y" => 3026000),
    array("x" => 1388514600000, "y" => 2394000),
    array("x" => 1420050600000, "y" => 1872000),
    array("x" => 1451586600000, "y" => 2140000)
);
//var_dump($dataPoints);
//echo "<br><br><br>";
//var_dump($dataPointCo2);
//exit();
?>
    <script>
        window.onload = function () {

            var co2Chart = new CanvasJS.Chart("co2-container", {
                animationEnabled: true,
                title:{
                    text: "CO2 Level"
                },
                axisY: {
                    title: "CO2 (PPM)",
                },
                axisX: {
                    title: "Date",
                    xValueFormatString: "DD MMM YY",

                },
                data: [{
                    type: "area",
                    xValueType: "dateTime",
                    xValueFormatString: "DD MMM",
                    dataPoints: <?php echo json_encode($dataPointCo2, JSON_NUMERIC_CHECK); ?>
                }]
            });

            co2Chart.render();

            var humidityChart = new CanvasJS.Chart("humidity-container", {
                animationEnabled: true,
                title:{
                    text: "Humidity Percentage"
                },
                axisY: {
                    title: "Humidity (%)",
                },
                axisX: {
                    title: "Date",
                    xValueFormatString: "DD MMM YY",

                },
                data: [{
                    type: "area",
                    xValueType: "dateTime",
                    xValueFormatString: "DD MMM",
                    dataPoints: <?php echo json_encode($dataPointHumidity, JSON_NUMERIC_CHECK); ?>
                }]
            });

            humidityChart.render();

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
                    dataPoints: <?php echo json_encode($dataPointTemperature, JSON_NUMERIC_CHECK); ?>
                }]
            });

            temperatureChart.render();

            var pm10Chart = new CanvasJS.Chart("pm10-container", {
                animationEnabled: true,
                title:{
                    text: "PM10 Level"
                },
                axisY: {
                    title: "PM10 (ug/m3)",
                },
                axisX: {
                    title: "Date",
                    xValueFormatString: "DD MMM YY",

                },
                data: [{
                    type: "area",
                    xValueType: "dateTime",
                    xValueFormatString: "DD MMM",
                    dataPoints: <?php echo json_encode($dataPointPM10, JSON_NUMERIC_CHECK); ?>
                }]
            });

            pm10Chart.render();

            var pm25Chart = new CanvasJS.Chart("pm25-container", {
                animationEnabled: true,
                title:{
                    text: "PM25 Chart"
                },
                axisY: {
                    title: "Revenue in USD",
                    valueFormatString: "#0,,.",
                    suffix: "mn",
                    prefix: "$"
                },
                data: [{
                    type: "spline",
                    markerSize: 5,
                    xValueFormatString: "YYYY",
                    yValueFormatString: "$#,##0.##",
                    xValueType: "dateTime",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });

            pm25Chart.render();

        }
    </script>