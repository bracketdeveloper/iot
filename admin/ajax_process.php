<?php

require_once "db_connection.php";
require_once "custom_functions.php";
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'login') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    if ($type == "admin") {
        $loginQuery = "SELECT * FROM `admin` WHERE `admin_email` = '$email' 
                   AND BINARY `admin_password` = '$password'";
        $loginQueryResult = mysqli_query($conn, $loginQuery);
        if (mysqli_num_rows($loginQueryResult) > 0) {
            $row = mysqli_fetch_array($loginQueryResult, MYSQLI_ASSOC);
            $_SESSION['admin'] = 'True';
            $_SESSION["admin_password"] = $row['admin_password'];
            $_SESSION["admin_email"] = $row['admin_email'];
            $_SESSION["admin_name"] = $row['admin_name'];
            $_SESSION["admin_id"] = $row['admin_id'];
            $_SESSION["user_type"] = "admin";
            /* login successful code is 1*/
            echo "1";
        } else {
            /* login failed code is 2*/
            echo "2";
        }
    }
    if ($type == "staff") {
        $loginQuery = "SELECT * FROM `staff` WHERE `staff_email` = '$email' 
                   AND BINARY `staff_password` = '$password'";
        $loginQueryResult = mysqli_query($conn, $loginQuery);
        if (mysqli_num_rows($loginQueryResult) > 0) {
            $row = mysqli_fetch_array($loginQueryResult, MYSQLI_ASSOC);
            $_SESSION['staff'] = 'True';
            $_SESSION["staff_password"] = $row['staff_password'];
            $_SESSION["staff_email"] = $row['staff_email'];
            $_SESSION["staff_name"] = $row['staff_name'];
            $_SESSION["staff_id"] = $row['staff_id'];
            $_SESSION["user_type"] = "staff";
            /* login successful code is 1*/
            echo "1";
        } else {
            /* login failed code is 2*/
            echo "2";
        }
    }

}

if (isset($_GET['action']) && $_GET['action'] == "edit_name") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $userId = mysqli_real_escape_string($conn, $_POST['user_id']);

    if ($_SESSION['user_type'] == 'admin') {
        $nameUpdateQuery = "UPDATE `admin` SET `admin_name` = '$name' WHERE 
                            `admin_id` = '$userId'";
        $isNameEdit = $conn->query($nameUpdateQuery) === TRUE;

        if ($isNameEdit) {
            /* update successful code is 1*/
            $_SESSION['admin_name'] = $name;
            echo "1";
        } else {
            /* update successful code is 2*/
            echo "2";
        }
    }

    if ($_SESSION['user_type'] == 'staff') {
        $nameUpdateQuery = "UPDATE `staff` SET `staff_name` = '$name' WHERE 
                            `staff_id` = '$userId'";
        $isNameEdit = $conn->query($nameUpdateQuery) === TRUE;

        if ($isNameEdit) {
            /* update successful code is 1*/
            $_SESSION['staff_name'] = $name;
            echo "1";
        } else {
            /* update successful code is 2*/
            echo "2";
        }
    }


}

if (isset($_GET['action']) && $_GET['action'] == "edit_password") {
    $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
    $userId = mysqli_real_escape_string($conn, $_POST['user_id']);

    if ($_SESSION['user_type'] == 'admin') {
        $passwordUpdateQuery = "UPDATE `admin` SET `admin_password` = '$newPassword' WHERE 
                            `admin_id` = $userId";
        if ($conn->query($passwordUpdateQuery) === TRUE) {
            /* update successful code is 1*/
            $_SESSION['admin_password'] = $newPassword;
            echo "1";
        } else {
            /* update successful code is 2*/
            echo "2";
        }
    }

    if ($_SESSION['user_type'] == 'staff') {
        $passwordUpdateQuery = "UPDATE `staff` SET `staff_password` = '$newPassword' WHERE 
                            `staff_id` = $userId";
        if ($conn->query($passwordUpdateQuery) === TRUE) {
            /* update successful code is 1*/
            $_SESSION['staff_password'] = $newPassword;
            echo "1";
        } else {
            /* update successful code is 2*/
            echo "2";
        }
    }

}

if (isset($_GET['action']) && $_GET['action'] == "add_new_staff") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = '';
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($chars) - 1);
        $password .= $chars[$index];
    }

    $checkExistingEmail = "SELECT * FROM `staff` WHERE `staff_email` = '$email'";
    $checkExistingEmailResult = mysqli_query($conn, $checkExistingEmail);
    if (mysqli_num_rows($checkExistingEmailResult) > 0) {
        echo "3";
    } else {
        $newStaffInsertQuery = "INSERT INTO `staff`( `staff_name`, `staff_email`, `staff_password`) 
                                VALUES ('$name', '$email', '$password')";

        if ($conn->query($newStaffInsertQuery) === TRUE) {
            sendEmail($email, $name, $password);
            /* successful code is 1*/
            echo "1";
        } else {
            /* successful code is 2*/
            echo "2";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == "edit_staff") {
    $staffId = mysqli_real_escape_string($conn, $_POST['staff_id']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $existinEmail = mysqli_real_escape_string($conn, $_POST['existing_email']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $checkExistingEmail = "SELECT * FROM `staff` WHERE `staff_email` = '$email'";
    $checkExistingEmailResult = mysqli_query($conn, $checkExistingEmail);
    if (mysqli_num_rows($checkExistingEmailResult) > 0 && $email != $existinEmail) {
        echo "3";
    } else {
        $editStaffQuery = "UPDATE `staff` SET `staff_name`='$name', `staff_email`='$email' 
                            WHERE `staff_id` = '$staffId'";

        if ($conn->query($editStaffQuery) === TRUE) {
            /* successful code is 1*/
            echo "1";
        } else {
            /* successful code is 2*/
            echo "2";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == "delete_staff") {
    $staffId = mysqli_real_escape_string($conn, $_POST['staff_id']);

    $deleteStaffQuery = "DELETE FROM `staff` WHERE `staff_id` = '$staffId'";

    if ($conn->query($deleteStaffQuery) === TRUE) {
        /* successful code is 1*/
        echo "1";
    } else {
        /* successful code is 2*/
        echo "2";
    }
}

if (isset($_GET['action']) && $_GET['action'] == "edit_tab") {
    $tabId = mysqli_real_escape_string($conn, $_POST['tab_id']);
    $tab = mysqli_real_escape_string($conn, $_POST['tab']);

    $editTabQuery = "UPDATE `tabs` SET `tab`='$tab' WHERE `tab_id` = '$tabId'";

    if ($conn->query($editTabQuery) === TRUE) {
        /* successful code is 1*/
        echo "1";
    } else {
        /* successful code is 2*/
        echo "2";
    }
}

if (isset($_GET['action']) && $_GET['action'] == "delete_tab") {
    $tabId = mysqli_real_escape_string($conn, $_POST['tab_id']);

    $deleteTabQuery = "DELETE FROM `tabs` WHERE `tab_id` = '$tabId'";

    if ($conn->query($deleteTabQuery) === TRUE) {
        /* successful code is 1*/
        echo "1";
    } else {
        /* successful code is 2*/
        echo "2";
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'recover_password') {
    $recoverEmail = mysqli_real_escape_string($conn, $_POST['recover_email']);
    $recoverType = mysqli_real_escape_string($conn, $_POST['recover_type']);

    if ($recoverType == 'admin') {
        $checkEmailQuery = "SELECT * FROM `admin` WHERE `admin_email` = '$recoverEmail'";
        $checkEmailQueryResult = mysqli_query($conn, $checkEmailQuery);
        if (mysqli_num_rows($checkEmailQueryResult) > 0) {
            $row = mysqli_fetch_array($checkEmailQueryResult, MYSQLI_ASSOC);
            $password = $row['admin_password'];
            $name = $row['admin_name'];
            /* login successful code is 1*/
            echo "1";
        } else {
            /* login failed code is 2*/
            echo "2";
        }
    }

    if ($recoverType == 'staff') {
        $checkEmailQuery = "SELECT * FROM `staff` WHERE `staff_email` = '$recoverEmail'";
        $checkEmailQueryResult = mysqli_query($conn, $checkEmailQuery);
        if (mysqli_num_rows($checkEmailQueryResult) > 0) {
            $row = mysqli_fetch_array($checkEmailQueryResult, MYSQLI_ASSOC);
            $password = $row['staff_password'];
            $name = $row['staff_name'];
            /* login successful code is 1*/
            echo "1";
        } else {
            /* login failed code is 2*/
            echo "2";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == "add_new_tab") {
    $tab = mysqli_real_escape_string($conn, $_POST['tab']);

    $checkExistingTab = "SELECT * FROM `tabs` WHERE `tab` = '$tab'";

    $checkExistingTabResult = mysqli_query($conn, $checkExistingTab);
    if (mysqli_num_rows($checkExistingTabResult) > 0) {
        echo "3";
    } else {
        $newTabInsertQuery = "INSERT INTO `tabs`( `tab`) VALUES ('$tab')";

        if ($conn->query($newTabInsertQuery) === TRUE) {
            /* successful code is 1*/
            echo "1";
        } else {
            /* successful code is 2*/
            echo "2";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == "add_real_data") {


// API endpoint URL
    $apiUrl = "https://api.thingspeak.com/channels/1931543/feeds.json?api_key=HK1H2XM3YIG60ZO0";

// Initialize cURL session
    $curl = curl_init();

// Set the cURL options
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
    $response = curl_exec($curl);

// Check for cURL errors
    if (curl_errno($curl)) {
        $error_message = curl_error($curl);
        echo "Error: " . $error_message;
    }

// Close cURL session
    curl_close($curl);

// Process the response
    if ($response) {
        $apiData = json_decode($response, true);
        // Do something with the data

        $allAirData = getAllAirQualityData($conn);
        $allAirData = end($allAirData);

        $lastDbDateTime = $allAirData['received_at'];

        $lastApiDateTime = $apiData['feeds'][99]['created_at'];

        $lastDbDateTime = substr($lastDbDateTime, 0, 10) . substr($lastDbDateTime,11, 8);
        $lastApiDateTime = substr($lastApiDateTime, 0, 10) . substr($lastApiDateTime,11, 8);

        $lastDbDateTime = strtotime($lastDbDateTime);
        $lastApiDateTime = strtotime($lastApiDateTime);
        $i=0;
        if($lastDbDateTime < $lastApiDateTime){
            $dataForDb = array();
            $lastDbDateTime = $allAirData['received_at'];
            $lastDbDateTime = substr($lastDbDateTime, 0, 19);


            for ($i = 0; $i < sizeof($apiData['feeds']); $i++):
                $lastApiDateTime = substr($apiData['feeds'][$i]['created_at'], 0, 19);
                if($lastDbDateTime == $lastApiDateTime){
                    for ($j = ++$i; $j<sizeof($apiData['feeds']); $j++){
                        $dateDbFormat = substr($apiData['feeds'][$i]['created_at'], 0, 19);
                        $newRealDataQuery = "INSERT INTO `air_quality`(`received_at`, `co2`, `humidity`, `pm10`, `pm25`, 
                                                `temperature`) VALUES  ('{$dateDbFormat}', 
                                                  '{$apiData['feeds'][$j]['field1']}',
                                                  '{$apiData['feeds'][$j]['field3']}',
                                                  '{$apiData['feeds'][$j]['field4']}',
                                                  '{$apiData['feeds'][$j]['field5']}',
                                                  '{$apiData['feeds'][$j]['field6']}'
                                                  )";

                        $conn->query($newRealDataQuery) === TRUE;

                    }
                    break;
                }
            endfor;
        }
    } else {
        echo "Error: No response from the API.";
    }



}

if (isset($_GET['action']) && $_GET['action'] == "get_daily_mean_of_data") {
    $parameter = mysqli_real_escape_string($conn, $_POST['parameter']);
    $dailyMeanOfParameterQuery = "SELECT DATE_FORMAT(DATE(`received_at`), '%d-%m-%Y') AS date,ROUND(AVG(`$parameter`), 2) AS daily_mean
                         FROM air_quality
                         GROUP BY DATE(`received_at`);";
    $dailyMeanOfParameterQueryResult = mysqli_query($conn, $dailyMeanOfParameterQuery);
    $data = array();
    if (mysqli_num_rows($dailyMeanOfParameterQueryResult) > 0) {
        while ($row = $dailyMeanOfParameterQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}

if (isset($_GET['action']) && $_GET['action'] == "get_weekly_mean_of_data") {
    $parameter = mysqli_real_escape_string($conn, $_POST['parameter']);
    $weeklyMeanOfParameterQuery = "SELECT 
       	 ROUND(AVG(`$parameter`), 2) AS weekly_mean,
		DATE_FORMAT(MIN(`received_at`), '%d-%m-%Y') AS from_date,
		DATE_FORMAT(MAX(`received_at`), '%d-%m-%Y') AS to_date
  		FROM air_quality
        GROUP BY WEEK(`received_at`)
        ORDER BY WEEK(`received_at`);";
    $weeklyMeanOfParameterQueryResult = mysqli_query($conn, $weeklyMeanOfParameterQuery);
    $data = array();
    if (mysqli_num_rows($weeklyMeanOfParameterQueryResult) > 0) {
        while ($row = $weeklyMeanOfParameterQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}

if (isset($_GET['action']) && $_GET['action'] == "get_yearly_mean_of_data") {
    $parameter = mysqli_real_escape_string($conn, $_POST['parameter']);
    $yearlyMeanOfParameterQuery = "SELECT YEAR(`received_at`) AS year, 
                                    ROUND(AVG(`$parameter`),2) AS yearly_mean
                                    FROM air_quality
                                    GROUP BY YEAR(`received_at`)
                                    ORDER BY YEAR(`received_at`)";
    $yearlyMeanOfParameterQueryResult = mysqli_query($conn, $yearlyMeanOfParameterQuery);
    $data = array();
    if (mysqli_num_rows($yearlyMeanOfParameterQueryResult) > 0) {
        while ($row = $yearlyMeanOfParameterQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}

if (isset($_GET['action']) && $_GET['action'] == "add_new_data") {
    $playerId = mysqli_real_escape_string($conn, $_POST['player_id']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $sprint10Meter = mysqli_real_escape_string($conn, $_POST['sprint_10_meter']);
    $sprint20Meter = mysqli_real_escape_string($conn, $_POST['sprint_20_meter']);
    $sprint50Meter = mysqli_real_escape_string($conn, $_POST['sprint_50_meter']);
    $dribbleCourse = mysqli_real_escape_string($conn, $_POST['dribble_course']);
    $dribbleCourseMain = mysqli_real_escape_string($conn, $_POST['dribble_course_main']);
    $dribbleCourseOff = mysqli_real_escape_string($conn, $_POST['dribble_course_off']);
    $longBallPrecision = mysqli_real_escape_string($conn, $_POST['long_ball_precision']);
    $flexibility = mysqli_real_escape_string($conn, $_POST['flexibility']);
    $jumpStanding = mysqli_real_escape_string($conn, $_POST['jump_standing']);
    $jumpRunning = mysqli_real_escape_string($conn, $_POST['jump_running']);
    $strength = mysqli_real_escape_string($conn, $_POST['strength']);
    $endurance = mysqli_real_escape_string($conn, $_POST['endurance']);
    $technique = mysqli_real_escape_string($conn, $_POST['technique']);
    $determination = mysqli_real_escape_string($conn, $_POST['determination']);
    $tacticalSense = mysqli_real_escape_string($conn, $_POST['tactical_sense']);
    $agility = mysqli_real_escape_string($conn, $_POST['agility']);
    $reflexHand = mysqli_real_escape_string($conn, $_POST['reflex_hand']);
    $reflexLeg = mysqli_real_escape_string($conn, $_POST['reflex_leg']);

    $lastEntryQuery = "SELECT * FROM `players_data` WHERE `player_id` = '$playerId'
                       ORDER BY `player_data_id` DESC LIMIT 1";
    $lastEntryQueryResult = mysqli_query($conn, $lastEntryQuery);
    $data = array();
    if (mysqli_num_rows($lastEntryQueryResult) > 0) {
        while ($row = $lastEntryQueryResult->fetch_assoc()) {
            if ($height < $row['player_height']) {
                /* height error code is 3*/
                echo "3";
                return;
            }

        }
    }

    $newPlayerDataInsertQuery = "INSERT INTO `players_data`(`player_id`, `player_height`, `player_weight`, 
                           `player_sprint_10`, `player_sprint_20`, `player_sprint_50`, 
                           `player_dribble_course`, `player_dribble_course_main`, 
                           `player_dribble_course_off`, `player_long_ball_precision`, `player_flexibility`, 
                           `player_jump_standing`, `player_jump_running`, `player_strength`, 
                           `player_endurance`, `player_technique`, `player_determination`, 
                           `player_tactical_sense`, `player_agility`, `player_reflex_hand`, 
                           `player_reflex_leg`)   VALUE 
                            ('$playerId', '$height', '$weight', '$sprint10Meter', '$sprint20Meter', 
                            '$sprint50Meter', '$dribbleCourse', '$dribbleCourseMain', '$dribbleCourseOff', 
                            '$longBallPrecision', '$flexibility', '$jumpStanding', '$jumpRunning', 
                            '$strength', '$endurance', '$technique', '$determination', '$tacticalSense', 
                            '$agility', '$reflexHand', '$reflexLeg' )";

    if ($conn->query($newPlayerDataInsertQuery) === TRUE) {
        /* successful code is 1*/
        echo "1";
    } else {
        /* successful code is 2*/
        echo "2";
        echo $conn->error;
    }

}

if (isset($_GET['action']) && $_GET['action'] == "edit_data") {
    $dataID = mysqli_real_escape_string($conn, $_POST['data_id']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $sprint10Meter = mysqli_real_escape_string($conn, $_POST['sprint_10_meter']);
    $sprint20Meter = mysqli_real_escape_string($conn, $_POST['sprint_20_meter']);
    $sprint50Meter = mysqli_real_escape_string($conn, $_POST['sprint_50_meter']);
    $dribbleCourse = mysqli_real_escape_string($conn, $_POST['dribble_course']);
    $dribbleCourseMain = mysqli_real_escape_string($conn, $_POST['dribble_course_main']);
    $dribbleCourseOff = mysqli_real_escape_string($conn, $_POST['dribble_course_off']);
    $longBallPrecision = mysqli_real_escape_string($conn, $_POST['long_ball_precision']);
    $flexibility = mysqli_real_escape_string($conn, $_POST['flexibility']);
    $jumpStanding = mysqli_real_escape_string($conn, $_POST['jump_standing']);
    $jumpRunning = mysqli_real_escape_string($conn, $_POST['jump_running']);
    $strength = mysqli_real_escape_string($conn, $_POST['strength']);
    $endurance = mysqli_real_escape_string($conn, $_POST['endurance']);
    $technique = mysqli_real_escape_string($conn, $_POST['technique']);
    $determination = mysqli_real_escape_string($conn, $_POST['determination']);
    $tacticalSense = mysqli_real_escape_string($conn, $_POST['tactical_sense']);
    $agility = mysqli_real_escape_string($conn, $_POST['agility']);
    $reflexHand = mysqli_real_escape_string($conn, $_POST['reflex_hand']);
    $reflexLeg = mysqli_real_escape_string($conn, $_POST['reflex_leg']);

    $newPlayerDataUpdateQuery = "UPDATE `players_data` SET `player_height`='$height',`player_weight`='$weight',
                             `player_sprint_10`='$sprint10Meter',`player_sprint_20`='$sprint20Meter',
                             `player_sprint_50`='$sprint50Meter',`player_dribble_course`='$dribbleCourse',
                             `player_dribble_course_main`='$dribbleCourseMain',
                             `player_dribble_course_off`='$dribbleCourseOff',
                             `player_long_ball_precision`='$longBallPrecision',
                             `player_flexibility`='$flexibility',`player_jump_standing`='$jumpStanding',
                             `player_jump_running`='$jumpRunning',`player_strength`='$strength',
                             `player_endurance`='$endurance',`player_technique`='$technique',
                             `player_determination`='$determination',`player_tactical_sense`='$tacticalSense',
                             `player_agility`='$agility',`player_reflex_hand`='$reflexHand',
                             `player_reflex_leg`='$reflexLeg' WHERE `player_data_id` = '$dataID' ";

    if ($conn->query($newPlayerDataUpdateQuery) === TRUE) {
        /* successful code is 1*/
        echo "1";
    } else {
        /* successful code is 2*/
        echo "2";
    }

}

if (isset($_GET['action']) && $_GET['action'] == "get_clubs_common_years") {
    $club1 = mysqli_real_escape_string($conn, $_POST['club_1']);
    $club2 = mysqli_real_escape_string($conn, $_POST['club_2']);

    $club1YearQuery = "SELECT `player_date_of_birth` FROM `players` WHERE `player_club` = '$club1'";
    $club1YearQueryResult = mysqli_query($conn, $club1YearQuery);
    $club1Years = array();
    while ($row = $club1YearQueryResult->fetch_assoc()) {
        $club1Years[] = date("Y", strtotime($row['player_date_of_birth']));
    }
    $club2YearQuery = "SELECT `player_date_of_birth` FROM `players` WHERE `player_club` = '$club2'";
    $club2YearQueryResult = mysqli_query($conn, $club2YearQuery);
    $club2Years = array();
    while ($row = $club2YearQueryResult->fetch_assoc()) {
        $club2Years[] = date("Y", strtotime($row['player_date_of_birth']));
    }
    $clubCommonYears = array_intersect($club2Years, $club1Years);
    $clubCommonYears = array_values($clubCommonYears);

    if (count($clubCommonYears) == 0) {
        echo "1";
    } else {
        echo json_encode($clubCommonYears);
    }

}

function getUserId()
{
    $token = "";
    $codeUpperAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $maxUpper = strlen($codeUpperAlphabet);
    $codeNumbers = "0123456789";
    $maxNumber = strlen($codeNumbers);
    for ($i = 0; $i < 3; $i++) {
        $token .= $codeUpperAlphabet[rand(0, 25)];
    }

    for ($i = 0; $i < 3; $i++) {
        $token .= $codeNumbers[rand(0, 9)];
    }
    for ($i = 0; $i < 2; $i++) {
        $token .= $codeUpperAlphabet[rand(0, 25)];
    }
    for ($i = 0; $i < 2; $i++) {
        $token .= $codeNumbers[rand(0, 9)];
    }

    return $token;
}


