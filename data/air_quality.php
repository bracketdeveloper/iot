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
        array("x" => $date, "y" => floatval($data['co2']));
    $dataPointHumidity[] =
        array("x" => $date, "y" => floatval($data['humidity']));
    $dataPointTemperature[] =
        array("x" => $date, "y" => floatval($data['temperature']));
    $dataPointPM10[] =
        array("x" => $date, "y" => floatval($data['pm10']));
    $dataPointPM25[] =
        array("x" => $date, "y" => floatval($data['pm25']));

endforeach;



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
                    text: "PM2.5 Levels"
                },
                axisY: {
                    title: "PM2.5 (ug/m3)",
                },
                axisX: {
                    title: "Date",
                    xValueFormatString: "DD MMM YY",

                },
                data: [{
                    type: "area",
                    xValueType: "dateTime",
                    xValueFormatString: "DD MMM",
                    dataPoints: <?php echo json_encode($dataPointPM25, JSON_NUMERIC_CHECK); ?>
                }]
            });

            pm25Chart.render();

        }
    </script>