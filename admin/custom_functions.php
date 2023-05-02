<?php
/* password and username email function */
function emailUsernameAndPassword($username, $password, $toEmail)
{
    $subject = "Your Request for VUK Admin Credentials";
    $body = "
    Respected Sir!
    We received a request for your admin credentials so the details are below 
    Username: $username
    Password: $password";

    $headers = "Reply-To: VUK DEVELOPMENT SYSTEM <contact@bracketdeveloper.com>\r\n";
    $headers .= "Return-Path: VUK DEVELOPMENT SYSTEM <contact@bracketdeveloper.com>\r\n";
    $headers .= "From: VUK DEVELOPMENT SYSTEM <contact@bracketdeveloper.com>\r\n";
    $headers .= "Organization: VUK DEVELOPMENT SYSTEM\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

    $result = mail($toEmail, $subject, $body, $headers);
}

/* get all staff members function*/
function getAllStaffMembers($conn)
{
    $allStaffMembersQuery = "SELECT * FROM `staff`";
    $allStaffMembersQueryResult = mysqli_query($conn, $allStaffMembersQuery);
    $data = array();
    if (mysqli_num_rows($allStaffMembersQueryResult) > 0) {
        while ($row = $allStaffMembersQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

/* get specific staff members function*/
function getSpecificStaffMemberById($conn, $staffId)
{
    $specificStaffMemberQuery = "SELECT * FROM `staff` WHERE `staff_id` = '$staffId'";
    $specificStaffMemberQueryResult = mysqli_query($conn, $specificStaffMemberQuery);
    $data = array();
    if (mysqli_num_rows($specificStaffMemberQueryResult) > 0) {
        while ($row = $specificStaffMemberQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

/* get all tabs function*/
function getAllTabs($conn)
{
    $allTabsQuery = "SELECT * FROM `tabs`";
    $allTabsQueryResult = mysqli_query($conn, $allTabsQuery);
    $data = array();
    if (mysqli_num_rows($allTabsQueryResult) > 0) {
        while ($row = $allTabsQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

/* get specific tab function*/
function getSpecificTabById($conn, $tabId)
{
    $specificTabQuery = "SELECT * FROM `tabs` WHERE `tab_id` = '$tabId'";
    $specificTabQueryResult = mysqli_query($conn, $specificTabQuery);
    $data = array();
    if (mysqli_num_rows($specificTabQueryResult) > 0) {
        while ($row = $specificTabQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

/* get all air quality data function*/
function getAllAirQualityData($conn)
{
    $allAirQualityQuery = "SELECT * FROM `air_quality`";
    $allAirQualityQueryResult = mysqli_query($conn, $allAirQualityQuery);
    $data = array();
    if (mysqli_num_rows($allAirQualityQueryResult) > 0) {
        while ($row = $allAirQualityQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

/* get admin details by id*/
function getAdminDetailsByID($conn, $adminID)
{
    $adminDetailsQuery = "SELECT * FROM `admin` WHERE `admin_id` = '$adminID'";
    $adminDetailsQueryResult = mysqli_query($conn, $adminDetailsQuery);
    $data = array();
    if (mysqli_num_rows($adminDetailsQueryResult) > 0) {
        $row = mysqli_fetch_array($adminDetailsQueryResult, MYSQLI_ASSOC);
        $data[] = $row;
    }
    return $data;
}

/* get player details by fifa id*/
function getPlayerDetailsByPlayerId($conn, $playerId)
{
    $playerDetailsQuery = "SELECT * FROM `players` WHERE `player_id` = '$playerId'";
    $playerDetailsQueryResult = mysqli_query($conn, $playerDetailsQuery);
    $data = array();
    if (mysqli_num_rows($playerDetailsQueryResult) > 0) {
        while ($row = $playerDetailsQueryResult->fetch_assoc()) {
            $data[] = $row;

        }
    }
    return $data;
}

/* get player's all data by fifa id function*/
function getPlayerAllDataByPlayerId($conn, $playerId)
{
    $playersAllDataQuery = "SELECT * FROM `players_data` WHERE `player_id` = '$playerId' 
                        ORDER BY `data_entry_time` DESC";
    $playersAllDataQueryResult = mysqli_query($conn, $playersAllDataQuery);
    $data = array();
    if (mysqli_num_rows($playersAllDataQueryResult) > 0) {
        while ($row = $playersAllDataQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

/* get player data details by data id*/
function getDataById($conn, $dataId)
{
    $dataQuery = "SELECT * FROM `players_data` WHERE `player_data_id` = '$dataId'";
    $dataQueryResult = mysqli_query($conn, $dataQuery);
    $data = array();
    if (mysqli_num_rows($dataQueryResult) > 0) {
        while ($row = $dataQueryResult->fetch_assoc()) {
            $data[] = $row;

        }
    }
    return $data;
}

/* get total player from database*/
function getTotalPlayersNumber($conn)
{
    $totalPlayersNumberQuery = "SELECT count(*) FROM `players`";
    $totalPlayersNumberQueryResult = mysqli_query($conn, $totalPlayersNumberQuery);
    $row = mysqli_fetch_array($totalPlayersNumberQueryResult);
    return $row[0];
}


/* get player's all data for graph by player id and attribute function*/
function getPlayerAllDataForGraphByPlayerIdAndAttribute($conn, $playerId, $playerAttribute)
{
    $attributeExistQuery = "SHOW COLUMNS FROM `players_data` LIKE '$playerAttribute'";
    $attributeExistQueryResult = mysqli_query($conn, $attributeExistQuery);
    if (mysqli_num_rows($attributeExistQueryResult) > 0) {
        $playersAllDataQuery = "SELECT * FROM `players_data` WHERE `player_id` = '$playerId' 
                        ORDER BY `data_entry_time` ASC LIMIT 14";
        $playersAllDataQueryResult = mysqli_query($conn, $playersAllDataQuery);
        $data = array();
        if (mysqli_num_rows($playersAllDataQueryResult) > 0) {
            while ($row = $playersAllDataQueryResult->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    } else {
        $data = array();
        return $data;
    }
}

/* get players by club and age year function*/
function getPlayerByClubAndYear($conn, $club, $ageYear)
{
    $playerQuery = "SELECT * FROM `players` WHERE `player_club` = '$club' AND `player_date_of_birth` LIKE 
                    '%$ageYear%' ";
    $playerQueryResult = mysqli_query($conn, $playerQuery);
    $data = array();
    if (mysqli_num_rows($playerQueryResult) > 0) {
        while ($row = $playerQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

/* get players by club and age year expect than selected player function*/
function getOtherPlayerByClubAndYear($conn, $club, $ageYear, $playerId)
{
    $playerQuery = "SELECT * FROM `players` WHERE `player_club` = '$club' AND `player_date_of_birth` LIKE 
                    '%$ageYear%' AND `player_id` != '$playerId'";

    $playerQueryResult = mysqli_query($conn, $playerQuery);
    $data = array();
    if (mysqli_num_rows($playerQueryResult) > 0) {
        while ($row = $playerQueryResult->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

/* get player details by age year*/
function getPlayerDetailsByAgeYear($conn, $ageYear)
{
    $playerDetailsQuery = "SELECT * FROM `players` WHERE `player_date_of_birth` LIKE '%$ageYear%'";
    $playerDetailsQueryResult = mysqli_query($conn, $playerDetailsQuery);
    $data = array();
    if (mysqli_num_rows($playerDetailsQueryResult) > 0) {
        while ($row = $playerDetailsQueryResult->fetch_assoc()) {
            $data[] = $row;

        }
    }
    return $data;
}

/* get player's all last data for comparison table by player id and attribute function*/
function getPlayerLastDataForComparisonTableByPlayerIdAndAttribute($conn, $playerId, $playerAttribute)
{
    $attributeExistQuery = "SHOW COLUMNS FROM `players_data` LIKE '$playerAttribute'";
    $attributeExistQueryResult = mysqli_query($conn, $attributeExistQuery);
    if (mysqli_num_rows($attributeExistQueryResult) > 0) {
        $playersAllDataQuery = "SELECT * FROM `players_data` WHERE `player_id` = '$playerId' 
                        ORDER BY `data_entry_time` DESC LIMIT 1";
        $playersAllDataQueryResult = mysqli_query($conn, $playersAllDataQuery);
        $data = array();
        if (mysqli_num_rows($playersAllDataQueryResult) > 0) {
            while ($row = $playersAllDataQueryResult->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    } else {
        $data = array();
        return $data;
    }
}

function sendEmail($staffEmail, $staffName, $staffPassword)
{
    $toPatient = "$staffEmail";
    $subject = "Welcome to our team!";
    $body = "
    Dear $staffName! 
    
    We are pleased to welcome you to our team at Smart Parking Pro! We're excited to have you on board and we look forward to working with you.

    As a new staff member, you'll need to log in to our system to access your account. Your login credentials are as follows:
    
    Email: $staffEmail
    Password: $staffPassword
    
    We recommend to change your password as soon as you feel comfortable.
    
    Please keep your login information secure and do not share it with anyone. If you have any issues logging in or have any questions, please don't hesitate to contact us.
    
    Again, welcome to the team and we look forward to working with you!
    
    Best regards,
    
    Smart Parking Pro
    
    ";

    $headers = "Reply-To: SmartParkingPro <smartparkingpro@gmail.com>\r\n";
    $headers .= "Return-Path: SmartParkingPro <smartparkingpro@gmail.com>\r\n";
    $headers .= "From: SmartParkingPro <smartparkingpro@gmail.com>\r\n";
    $headers .= "Organization: SmartParkingPro\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

    mail($staffEmail, $subject, $body, $headers);
}

function sendPasswordAsEmail($email, $password, $name)
{
    $subject = "Smart Parking Pro Password Recover.";
    $body = "
    Dear $name! 
    
    We have received a request to reset the password for your account with Smart Parking Pro. 
    
    Following is your password:
    
    Password: $password
    
  
    Please keep your login information secure and do not share it with anyone. 
    If you have any issues logging in or have any questions, please don't hesitate to contact us.
    
    Best regards,
    
    Smart Parking Pro
    
    ";

    $headers = "Reply-To: SmartParkingPro <smartparkingpro@gmail.com>\r\n";
    $headers .= "Return-Path: SmartParkingPro <smartparkingpro@gmail.com>\r\n";
    $headers .= "From: SmartParkingPro <smartparkingpro@gmail.com>\r\n";
    $headers .= "Organization: SmartParkingPro\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

    mail($email, $subject, $body, $headers);
}