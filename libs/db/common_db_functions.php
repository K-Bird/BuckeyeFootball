<?php

function db_connect() {

    // Define connection as a static variable, to avoid connecting more than once 
    static $connection;

    // Try and connect to the database, if a connection has not been established yet
    if (!isset($connection)) {
        // Load configuration as an array. Use the actual location of your configuration file
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '../../db_configs/db_OSU.ini');
        $connection = mysqli_connect('localhost', $config['username'], $config['password'], $config['dbname']);
    }

    // If connection was not successful, handle the error
    if ($connection === false) {
        // Handle error - notify administrator, log to a file, show an error screen, etc.
        return mysqli_connect_error();
    }
    return $connection;
}

function db_query($query) {
    // Connect to the database
    $connection = db_connect();

    // Query the database
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    return $result;
}

function db_quote($value) {
    $connection = db_connect();
    return "'" . mysqli_real_escape_string($connection, $value) . "'";
}

function getSeason_Year($Season_ID) {

    $get_seasonYear = db_query("SELECT * FROM `Seasons` WHERE `Season_ID`='{$Season_ID}'");
    $fetch_seasonYear = $get_seasonYear->fetch_assoc();
    $Season = $fetch_seasonYear['Year'];

    return $Season;
}

function getSeason_ID($Season_Year) {

    $get_seasonYear = db_query("SELECT * FROM `Seasons` WHERE `Year`='{$Season_Year}'");
    $fetch_seasonYear = $get_seasonYear->fetch_assoc();
    $Season = $fetch_seasonYear['Season_ID'];

    return $Season;
}

function return_depth_btn($season, $pos, $depth) {

    $getPlayerData = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='{$pos}' AND Depth='{$depth}'");
    $fetchPlayerData = $getPlayerData->fetch_assoc();

    if (empty($fetchPlayerData)) {
        $getPlayerData = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position_2='{$pos}' AND Depth_2='{$depth}'");
        $fetchPlayerData = $getPlayerData->fetch_assoc();
    }

    $fname = $fetchPlayerData['First_Name'];
    $lname = $fetchPlayerData['Last_Name'];
    $fullName = $fname . " " . $lname;

    if ($pos === 'KR' || $pos === 'PR' || $pos === 'LS' || $pos === 'H') {
        echo '<span id="', $pos . $depth, '" class="btn btn-sm btn-secondary">';
        echo '<small>', $pos . $depth, " - ", $fullName, " - ", $fetchPlayerData['Class'], '</small>';
        echo '</span>';
    } else {

        echo '<span id="', $pos . $depth, '" class="btn btn-sm btn-secondary showDepthCard">';
        echo '<small>', $pos . $depth, " - ", $fullName, " - ", $fetchPlayerData['Class'], '</small>';
        echo '</span>';
    }
}

function return_depth_btn_starter($season, $pos, $depth) {

    $getPlayerData = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='{$pos}' AND Depth='{$depth}'");
    $fetchPlayerData = $getPlayerData->fetch_assoc();

    if (empty($fetchPlayerData)) {
        $getPlayerData = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position_2='{$pos}' AND Depth_2='{$depth}'");
        $fetchPlayerData = $getPlayerData->fetch_assoc();
    }

    $fname = $fetchPlayerData['First_Name'];
    $lname = $fetchPlayerData['Last_Name'];
    $fullName = $fname . " " . $lname;

    if ($pos === 'KR' || $pos === 'PR' || $pos === 'LS' || $pos === 'H') {
        echo '<span id="', $pos . $depth, '" class="btn btn-sm btn-secondary">';
        echo '<small>', $pos . $depth, " - ", $fullName, " - ", $fetchPlayerData['Class'], '</small>';
        echo '</span>';
    } else {

        echo '<span id="', $pos . $depth, '" class="btn btn-sm btn-secondary showDepthCard">';
        echo '<small>', $pos . " - ", $fullName, " - ", $fetchPlayerData['Class'], '</small>';
        echo '</span>';
    }
}

function return_depth_table($season, $posGroup) {

    if ($posGroup === 'QB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='QB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'RB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='RB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'HB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='H-B' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'FB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='FB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'C' || $posGroup === 'RT' || $posGroup === 'RG' || $posGroup === 'LG' || $posGroup === 'LT') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='{$posGroup}' OR Position='OL') ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'TE') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='TE' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'WR') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='WR' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'DE' || $posGroup === 'DT') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='{$posGroup}' OR Position='DL') ORDER BY FIELD(Depth,'1','2','3','4','5','6','0')");
    }
    if ($posGroup === 'CB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='CB' OR Position='DB') ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'MLB' || $posGroup === 'OLB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='{$posGroup}' OR Position='LB') ORDER BY FIELD(Depth,'1','2','3','4','5','6','0')");
    }
    if ($posGroup === 'S') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='S' OR Position='DB') ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'K') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='K' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'P') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='P' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }

    echo '<table class="table table-sm" style="font-size: small">';
    echo '<thead>';
    echo '<th></th><th>Name</th><th>Class</th>';
    echo '</thead>';
    echo '<tbody>';

    while ($fetchPOSdata = $getPOSdata->fetch_assoc()) {

        $depthNum = formatDepthNumber($fetchPOSdata['Depth']);

        echo '<tr>';
        echo '<td>', $fetchPOSdata['Position'], $depthNum, '</td>';
        echo '<td>', $fetchPOSdata['First_Name'], " ", $fetchPOSdata['Last_Name'], '</td>';
        echo '<td>', $fetchPOSdata['Class'], '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}

function return_depth_table_starter($season, $posGroup) {


    if ($posGroup === 'OL') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='OL' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'DL') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='DL' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'LB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='LB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'DB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='DB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }



    echo '<table class="table table-sm" style="font-size: small">';
    echo '<thead>';
    echo '<th></th><th>Name</th><th>Class</th>';
    echo '</thead>';
    echo '<tbody>';

    while ($fetchPOSdata = $getPOSdata->fetch_assoc()) {

        $depthNum = formatDepthNumber($fetchPOSdata['Depth']);

        echo '<tr>';
        echo '<td>', $fetchPOSdata['Position'];
        if (checkForStarter($posGroup, $depthNum) === true) {
            echo '*';
        }
        echo '</td>';
        echo '<td>', $fetchPOSdata['First_Name'], " ", $fetchPOSdata['Last_Name'], '</td>';
        echo '<td>', $fetchPOSdata['Class'], '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}

function checkForStarter($posGroup, $DepthNum) {

    if ($posGroup === 'OL') {
        if ($DepthNum === '1' || $DepthNum === '2' || $DepthNum === '3' || $DepthNum === '4' || $DepthNum === '5') {
            return true;
        }
    }
    if ($posGroup === 'DL') {
        if ($DepthNum === '1' || $DepthNum === '2' || $DepthNum === '3' || $DepthNum === '4') {
            return true;
        }
    }
    if ($posGroup === 'LB') {
        if ($DepthNum === '1' || $DepthNum === '2' || $DepthNum === '3') {
            return true;
        }
    }
    if ($posGroup === 'DB') {
        if ($DepthNum === '1' || $DepthNum === '2' || $DepthNum === '3' || $DepthNum === '4') {
            return true;
        }
    }
}

function formatDepthNumber($DepthNum) {

    if ($DepthNum === '0') {
        return '';
    } else {
        return $DepthNum;
    }
}

function returnRecord($season, $recordType, $recordLevel) {

    $getRecordData = db_query("SELECT * FROM `games` WHERE Season_ID='{$season}' AND VS <> 129");

    //Set count of record to 0
    $recordCount = 0;

    while ($fetchRecordData = $getRecordData->fetch_assoc()) {

        //Calculate OVR Record block
        if ($recordType === 'W' && $recordLevel === 'Ovr') {
            if ($fetchRecordData['OSU_Score'] > $fetchRecordData['Opp_Score']) {
                $recordCount++;
            }
        }
        if ($recordType === 'L' && $recordLevel === 'Ovr') {
            if ($fetchRecordData['OSU_Score'] < $fetchRecordData['Opp_Score']) {
                $recordCount++;
            }
        }
        if ($recordType === 'T' && $recordLevel === 'Ovr') {
            if ($fetchRecordData['OSU_Score'] == $fetchRecordData['Opp_Score']) {
                $recordCount++;
            }
        }

        //Calculate Conf Record block
        if ($recordType === 'W' && $recordLevel === 'Conf') {
            if ($fetchRecordData['OSU_Score'] > $fetchRecordData['Opp_Score'] && $fetchRecordData['Conf_GM'] === 'Y') {
                $recordCount++;
            }
        }
        if ($recordType === 'L' && $recordLevel === 'Conf') {
            if ($fetchRecordData['OSU_Score'] < $fetchRecordData['Opp_Score'] && $fetchRecordData['Conf_GM'] === 'Y') {
                $recordCount++;
            }
        }
        if ($recordType === 'T' && $recordLevel === 'Conf') {
            if ($fetchRecordData['OSU_Score'] == $fetchRecordData['Opp_Score'] && $fetchRecordData['Conf_GM'] === 'Y') {
                $recordCount++;
            }
        }

        //Calculate Div Record block
        if ($recordType === 'W' && $recordLevel === 'Div') {
            if ($fetchRecordData['OSU_Score'] > $fetchRecordData['Opp_Score'] && $fetchRecordData['Div_GM'] === 'Y') {
                $recordCount++;
            }
        }
        if ($recordType === 'L' && $recordLevel === 'Div') {
            if ($fetchRecordData['OSU_Score'] < $fetchRecordData['Opp_Score'] && $fetchRecordData['Div_GM'] === 'Y') {
                $recordCount++;
            }
        }
        if ($recordType === 'T' && $recordLevel === 'Div') {
            if ($fetchRecordData['OSU_Score'] == $fetchRecordData['Opp_Score'] && $fetchRecordData['Div_GM'] === 'Y') {
                $recordCount++;
            }
        }
    }

    return $recordCount;
}

function returnPTSfor($season) {

    $getPTSforData = db_query("SELECT * FROM `games` WHERE Season_ID='{$season}' AND VS <> 129");

    $ptsFor = 0;

    while ($fetchPTSforData = $getPTSforData->fetch_assoc()) {

        $ptsFor = $ptsFor + $fetchPTSforData['OSU_Score'];
    }

    return $ptsFor;
}

function returnPTSaga($season) {

    $getPTSagaData = db_query("SELECT * FROM `games` WHERE Season_ID='{$season}' AND VS <> 129");

    $ptsFor = 0;

    while ($fetchPTSagaData = $getPTSagaData->fetch_assoc()) {

        $ptsFor = $ptsFor + $fetchPTSagaData['Opp_Score'];
    }

    return $ptsFor;
}

function returnOppRk($GM_ID) {

    $getGMdata = db_query("SELECT * FROM `games` WHERE GM_ID={$GM_ID}");
    $fetchGMdata = $getGMdata->fetch_assoc();

    $season_year = getSeason_Year($fetchGMdata['Season_ID']);
    $opp_ap_rk = $fetchGMdata['Opp_AP_RK'];
    $opp_cfp_rk = $fetchGMdata['Opp_CFP_RK'];
    $week = $fetchGMdata['Week'];

    /* If season < 2014 use AP | if season > 2014 and week < 10 use AP | if season > 2014 and week > 10 and not a CFP game use AP, if CFP game use CFP */
    if ($season_year < 2014) {
        if ($opp_ap_rk === '0') {
            return '';
        } else {
            return '#' . $opp_ap_rk;
        }
    }
    if ($season_year >= 2014 && $week < 10) {
        if ($opp_ap_rk === '0') {
            return '';
        } else {
            return "#" . $opp_ap_rk;
        }
    }
    if ($season_year >= 2014 && $week >= 9 && ($fetchGMdata['GM_Type'] === '41' || $fetchGMdata['GM_Type'] === '42')) {
        if ($opp_cfp_rk === '0') {
            return '';
        } else {
            return "#" . $opp_cfp_rk;
        }
    }
    if ($season_year >= 2014 && $week >= 9 && ($fetchGMdata['GM_Type'] != '41' || $fetchGMdata['GM_Type'] != '42')) {
        if ($opp_ap_rk === '0') {
            return '';
        } else {
            return "#" . $opp_ap_rk;
        }
    }
}

function returnOSURk($GM_ID) {

    $getGMdata = db_query("SELECT * FROM `games` WHERE GM_ID={$GM_ID}");
    $fetchGMdata = $getGMdata->fetch_assoc();

    $season_year = getSeason_Year($fetchGMdata['Season_ID']);
    $osu_ap_rk = $fetchGMdata['OSU_AP_RK'];
    $osu_cfp_rk = $fetchGMdata['OSU_CFP_RK'];
    $week = $fetchGMdata['Week'];

    /* If season < 2014 use AP | if season > 2014 and week < 10 use AP | if season > 2014 and week > 10 and not a CFP game use AP, if CFP game use CFP */
    if ($season_year < 2014) {
        if ($osu_ap_rk === '0') {
            return '';
        } else {
            return '#' . $osu_ap_rk;
        }
    }
    if ($season_year >= 2014 && $week < 10) {
        if ($osu_ap_rk === '0') {
            return '';
        } else {
            return "#" . $osu_ap_rk;
        }
    }
    if ($season_year >= 2014 && $week >= 9 && ($fetchGMdata['GM_Type'] === '41' || $fetchGMdata['GM_Type'] === '42')) {
        if ($osu_cfp_rk === '0') {
            return '';
        } else {
            return "#" . $osu_cfp_rk;
        }
    }
    if ($season_year >= 2014 && $week >= 9 && ($fetchGMdata['GM_Type'] != '41' || $fetchGMdata['GM_Type'] != '42')) {
        if ($osu_ap_rk === '0') {
            return '';
        } else {
            return "#" . $osu_ap_rk;
        }
    }
}

function calc_AP_RK_Diff($season, $week, $Post_AP) {

    if ($season < 47) {
        return 'AP Poll Did Not Exist';
    }
    if ($Post_AP === '0') {
        return '<span class="badge badge-secondary">Not Ranked</span>';
    }
    if ($week === '1') {
        return '#' . $Post_AP;
    } else {
        $prevWeek = $week - 1;
        $getPrevAP_RK = db_query("SELECT * FROM `games` WHERE Week='{$prevWeek}' and Season_ID={$season}");
        $fetchPrevAP_RK = $getPrevAP_RK->fetch_assoc();
        $Prev_AP = $fetchPrevAP_RK['Post_AP'];
        $diff = $Post_AP - $Prev_AP;
        if ($Prev_AP === '0') {
            return '#' . $Post_AP . " " . returnNRDiff($diff);
        } else {
            return '#' . $Post_AP . " " . returnDiff($diff);
        }
    }
}

function calc_CFP_RK_Diff($season, $week, $Post_CFP, $GM_ID) {

    if ($season < 125) {
        return 'CFP Rankings Begin 2014';
    }
    if ($week === '9' || return_game_type_ID($GM_ID) === '40') {
        return '#' . $Post_CFP;
    }
    if ($week < '9') {
        return 'First Rankings Week 9';
    }
    if ($week >= 13) {
        if (return_game_type_ID($GM_ID) === '41' || return_game_type_ID($GM_ID) === '42') {
            return 'CFP #' . $Post_CFP . ' Seed';
        } else {
            return 'CFP Rankings Complete';
        }
    }

    if ($week >= 9 && $week <= 13) {
        $prevWeek = $week - 1;
        $getPrevCFP_RK = db_query("SELECT * FROM `games` WHERE Week='{$prevWeek}'and Season_ID={$season}");
        $fetchPrevCFP_RK = $getPrevCFP_RK->fetch_assoc();

        $diff = $Post_CFP - $fetchPrevCFP_RK['Post_CFP'];
        return '#' . $Post_CFP . " " . returnDiff($diff);
    }
}

function returnDiff($diff) {

    if ($diff === 0) {
        return '<span class=text-warning>(' . $diff . ')</span>';
    }
    if ($diff > 0) {
        return '<span class=text-danger>(+' . $diff . ')</span>';
    }
    if ($diff < 0) {
        return '<span class=text-success>(' . $diff . ')</span>';
    }
}

function returnNRDiff($diff) {

    if ($diff === 0) {
        return '<span class=text-warning>(' . $diff . ')</span>';
    }
    if ($diff > 0) {
        return '<span class=text-success>(+' . $diff . ')</span>';
    }
    if ($diff < 0) {
        return '<span class=text-danger>(' . $diff . ')</span>';
    }
}

function locationLookup($Loc_ID) {

    $getLocData = db_query("SELECT * From `locations` WHERE Loc_ID='{$Loc_ID}'");
    $fetchLocData = $getLocData->fetch_assoc();

    if ($Loc_ID === '0') {
        return '';
    } else {
        return $fetchLocData['Stadium'] . " (" . $fetchLocData['City'] . ", " . $fetchLocData['State'] . ")";
    }
}

function conferenceLookup($Conf_ID) {

    $getConfData = db_query("SELECT * From `conferences` WHERE Conf_ID='{$Conf_ID}'");
    $fetchConfData = $getConfData->fetch_assoc();

    return $fetchConfData['Conf_Name'];
}

function divisionLookup($Div_ID) {

    $getDivData = db_query("SELECT * From `b10_divisions` WHERE Div_ID='{$Div_ID}'");
    $fetchDivData = $getDivData->fetch_assoc();

    return $fetchDivData['Div_Name'];
}

function gameTypeLookup($Type_ID) {

    $getGameTypeData = db_query("SELECT * From `game_types` WHERE Type_ID='{$Type_ID}'");
    $fetchGameTypeData = $getGameTypeData->fetch_assoc();
    return $fetchGameTypeData['Name'];
}

function returnMaxWeek($SeasonID) {

    $getMaxWeek = db_query("SELECT Max(Week) as MaxWeek From `games` WHERE Season_ID='{$SeasonID}'");
    $fetchMaxWeek = $getMaxWeek->fetch_assoc();
    return $fetchMaxWeek['MaxWeek'];
}

function returnPositionCount($posGroup, $season) {

    if ($posGroup === 'OL') {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `players` WHERE (Position='{$posGroup}' OR Position='LT' OR Position='LG' OR Position='C' OR Position='RG' OR Position='RT') AND Season='{$season}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    } elseif ($posGroup === 'DL') {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `players` WHERE (Position='{$posGroup}' OR Position='DE' OR Position='DT') AND Season='{$season}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    } elseif ($posGroup === 'LB') {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `players` WHERE (Position='{$posGroup}' OR Position='OLB' OR Position='MLB') AND Season='{$season}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    } elseif ($posGroup === 'KR' || $posGroup === 'PR' || $posGroup === 'H') {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `players` WHERE (Position='{$posGroup}' OR Position_2='{$posGroup}') AND Season='{$season}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    } else {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `players` WHERE Position='{$posGroup}' AND Season='{$season}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    }

    return $PositionCount;
}

function returnPos_PorS($posGroup, $pos1) {


    if ($posGroup === 'OL') {
        if ($pos1 === 'OL' || $pos1 === 'RT' || $pos1 === 'RG' || $pos1 === 'C' || $pos1 === 'LG' || $pos1 === 'LT') {
            return 'Primary';
        } else {
            return 'Secondary';
        }
    } elseif ($posGroup === 'DL') {
        if ($pos1 === 'DL' || $pos1 === 'DE' || $pos1 === 'DT') {
            return 'Primary';
        } else {
            return 'Secondary';
        }
    } elseif ($posGroup === 'LB') {
        if ($pos1 === 'LB' || $pos1 === 'OLB' || $pos1 === 'MLB') {
            return 'Primary';
        } else {
            return 'Secondary';
        }
    } elseif ($posGroup === ('KR' || 'PR' || 'H')) {
        if ($pos1 != ('KR' || 'PR' || 'H')) {
            return 'Secondary';
        } else {
            return 'Primary';
        }
    } else {
        if ($pos1 === $posGroup) {
            return 'Primary';
        } else {
            return 'Secondary';
        }
    }
}

function incrementPlayerMasterID() {

    $getMaxMasterID = db_query("SELECT Max(Player_Master_ID) as MaxID From `players`");
    $fetchMaxMasterID = $getMaxMasterID->fetch_assoc();
    $nextID = $fetchMaxMasterID['MaxID'] + 1;
    return $nextID;
}

function incrementPlayerRow() {

    $getMaxPlayerRow = db_query("SELECT Max(Player_Row) as MaxRow From `players`");
    $fetchMaxPlayerRow = $getMaxPlayerRow->fetch_assoc();
    $nextID = $fetchMaxPlayerRow['MaxRow'] + 1;
    return $nextID;
}

function returnPosGroupSelectStatement($posGroup, $season) {

    if ($posGroup === 'OL') {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position='LT' OR Position='LG' OR Position='C' OR Position='RG' OR Position='RT' OR Position_2='{$posGroup}' OR Position_2='LT' OR Position_2='LG' OR Position_2='C' OR Position_2='RG' OR Position_2='RT') AND Season='{$season}' ORDER BY Last_Name ASC";
    } elseif ($posGroup === 'DL') {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position='DE' OR Position='DT' OR Position_2='DE' OR Position_2='DT') AND Season='{$season}' ORDER BY Last_Name ASC";
    } elseif ($posGroup === 'LB') {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position='OLB' OR Position='MLB' OR Position_2='OLB' OR Position_2='MLB') AND Season='{$season}' ORDER BY Last_Name ASC";
    } elseif ($posGroup === 'KR' || $posGroup === 'PR' || $posGroup === 'H') {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position_2='{$posGroup}') AND Season='{$season}' ORDER BY Last_Name ASC";
    } else {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position_2='{$posGroup}')  AND Season='{$season}' ORDER BY Last_Name ASC";
    }
}

function returnSeasonDepth($Season_ID) {

    $getDepth = db_query("SELECT * FROM `seasons` WHERE Season_ID='{$Season_ID}'");
    $fetchDepth = $getDepth->fetch_assoc();
    $depth = $fetchDepth['DepthChart'];
    return $depth;
}

function returnMaxSeasonDecade() {

    $getMaxDecadeRow = db_query("SELECT Max(Decade_ID) as MaxDecade From `seasons`");
    $fetchMaxDecadeRow = $getMaxDecadeRow->fetch_assoc();
    $maxDecade = $fetchMaxDecadeRow['MaxDecade'];
    return $maxDecade;
}

function incrementPlayerClass($prevClass) {

    //Non Red Shirt Track
    if ($prevClass === 'FR') {
        return 'SO';
    }
    if ($prevClass === 'SO') {
        return 'JR';
    }
    if ($prevClass === 'JR') {
        return 'SR';
    }

    //Red Shirt Track
    if ($prevClass === 'FR (RS)') {
        return 'SO (RS)';
    }
    if ($prevClass === 'SO (RS)') {
        return 'JR (RS)';
    }
    if ($prevClass === 'JR (RS)') {
        return 'SR (RS)';
    }
}

function getPlayerFieldByRow($field, $player_row) {

    $getAttribute = db_query("SELECT * FROM `players` WHERE Player_Row='{$player_row}'");
    $fetchAttribute = $getAttribute->fetch_assoc();
    $attribute = $fetchAttribute[$field];
    return $attribute;
}

function getPlayerFieldByMasterID($field, $player_ID) {

    $getAttribute = db_query("SELECT * FROM `players` WHERE Player_Master_ID='{$player_ID}'");
    $fetchAttribute = $getAttribute->fetch_assoc();
    $attribute = $fetchAttribute[$field];
    return $attribute;
}

function opponentLookup($opp_ID) {

    $getOpp = db_query("SELECT * FROM `opponents` WHERE Team_ID='{$opp_ID}'");
    $fetchOpp = $getOpp->fetch_assoc();
    $oppName = $fetchOpp['School'];
    return $oppName;
}

function gameStatExists($gm_ID, $player_ID, $category, $week, $fname, $lname, $season) {

    $player_ID = returnPlayerMasterID($player_ID);

    $getStatRow = db_query("SELECT * FROM `stats_{$category}` WHERE Game_ID='{$gm_ID}' AND Player_ID='{$player_ID}'");

    $RowCount = mysqli_num_rows($getStatRow);

    if ($RowCount >= 1) {
        return '<button class="btn btn-sm btn-secondary"><span 
           class="oi oi-comment-square existingStat"
           data-toggle="modal" 
           data-target="#editStatModal"
           data-game=' . $gm_ID . ' data-player=' . $player_ID . ' data-cat=' . $category . ' data-week=' . $week . ' data-fname=' . $fname . ' data-lname=' . $lname . ' data-season=' . $season .
                '></span ></button>
           <button class="btn btn-sm btn-danger removeStat" data-cat="' . $category . '" data-game="' . $gm_ID . '" data-player="' . $player_ID . '"><span class="oi oi-minus"></span></button> ';
    } else {
        return '';
    }
}

function returnPlayerMasterID($playerRow) {

    $getMasterID = db_query("SELECT * FROM `players` WHERE Player_Row='{$playerRow}'");
    $fetchMasterID = $getMasterID->fetch_assoc();
    $masterID = $fetchMasterID['Player_Master_ID'];
    return $masterID;
}

//Build the player detail stat card for the category sent
function returnPlayerDetailStatCard($master_ID, $category) {

    $getPlayerStatRows = db_query("SELECT * FROM `stats_{$category}` WHERE Player_ID='{$master_ID}'");

    $yearArray = [];

    while ($fetchPlayerStatRows = $getPlayerStatRows->fetch_assoc()) {

        $rowYear = getGameYear($fetchPlayerStatRows['Game_ID']);

        if (!in_array($rowYear, $yearArray)) {

            array_push($yearArray, $rowYear);
        }
    }
    $rowCount = mysqli_num_rows($getPlayerStatRows);


    echo '<div class="card">';
    echo '<div class="card-header">';
    echo categoryToTitle($category);
    echo '</div>';
    echo '<div class="card-body">';
    echo '<table class="table">';
    echo '<thead><tr>';
    //Build table header based on category
    echo playerStatCardthead($category);
    echo '<tr></thead>';
    foreach ($yearArray as $year) {
        echo '<tr>';
        //Build each year's stat summary based on the year, category and player master ID
        echo playerStatCardrow($category, $year, $master_ID);
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '</div>';
}

function getGameYear($GM_ID) {

    $getGameSeason = db_query("SELECT * FROM `games` WHERE GM_ID='{$GM_ID}'");
    $fetchGameSeason = $getGameSeason->fetch_assoc();
    $Season = $fetchGameSeason['Season_ID'];
    $Year = getSeason_Year($Season);
    return $Year;
}

//Build the table headings for the player stat summary
function playerStatCardthead($cagetory) {

    if ($cagetory === 'Passing') {

        return '<th></th><th>Completions</th><th>Attempts</th><th>Completion %</th><th>Yards</th><th>TDs</th><th>INTs</th><th>QB Rating</th>';
    }
    if ($cagetory === 'Rushing') {

        return '<th></th><th>Attemps</th><th>Yards</th><th>TDs</th>';
    }
    if ($cagetory === 'rec') {

        return '<th></th><th>Receptions</th><th>Yards</th><th>TDs</th>';
    }
    if ($cagetory === 'def') {

        return '<th></th><td>Tackles</td><td>For Loss</td><td>Sacks</td><td>INTs</td><td>INT TDs</td><td>Passes Defended</td><td>Forced Fumbles</td><td>Fumble Recoveries</td><td>Fumble TDs</td>';
    }
    if ($cagetory === 'ret') {

        return '<th></th><td>Kick Returns</td><td>Kick Return Yards</td><td>Kick Return TDs</td><td>Punt Returns</td><td>Punt Return Yards</td><td>Punt Return TDs</td>';
    }
    if ($cagetory === 'Kicking') {

        return '<th></th><td>Extra Points Made</td><td>Extra Point Attempts</td><td>Extra Point %</td><td>Field Goals Made</td><td>Field Goal Attempts</td><td>Field Goal %</td>';
    }
    if ($cagetory === 'Punting') {

        return '<th></th><td>Punts</td><td>Punt Yards</td><td>Punt Average</td>';
    }
}

//Build the table rows for the player stat summary
function playerStatCardrow($category, $year, $master_ID) {

    if ($category === 'Passing') {

        $comp = 0;
        $att = 0;
        $yards = 0;
        $TDs = 0;
        $INTs = 0;
        $Rate = 0;
        $RateCount = 0;

        $getPassingStats = db_query("SELECT * FROM `stats_passing` WHERE Player_ID='{$master_ID}'");
        while ($fetchPassingStats = $getPassingStats->fetch_assoc()) {

            if (getGameYear($fetchPassingStats['Game_ID']) === $year) {

                $comp = $comp + $fetchPassingStats['Comp'];
                $att = $att + $fetchPassingStats['Att'];
                $yards = $yards + $fetchPassingStats['Yards'];
                $TDs = $TDs + $fetchPassingStats['TDs'];
                $INTs = $INTs + $fetchPassingStats['INTs'];
                $Rate = $Rate + $fetchPassingStats['Rate'];
                $RateCount++;
            }
        }

        $CompPercentage = $comp / $att;
        $RateAVG = $Rate / $RateCount;

        echo '<td>' . $year . '</td><td>' . $comp . '</td><td>' . $att . '</td><td>' . toPercent($CompPercentage) . '</td><td>' . number_format($yards) . '</td><td>' . $TDs . '</td><td>' . $INTs . '</td><td>' . number_format($RateAVG, 1) . '</td>';
    }

    if ($category === 'Rushing') {

        $att = 0;
        $yards = 0;
        $TDs = 0;

        $getRushingStats = db_query("SELECT * FROM `stats_rushing` WHERE Player_ID='{$master_ID}'");
        while ($fetchRushingStats = $getRushingStats->fetch_assoc()) {

            if (getGameYear($fetchRushingStats['Game_ID']) === $year) {

                $att = $att + $fetchRushingStats['Att'];
                $yards = $yards + $fetchRushingStats['Yards'];
                $TDs = $TDs + $fetchRushingStats['TDs'];
            }
        }

        echo '<td>' . $year . '</td><td>' . $att . '</td><td>' . number_format($yards) . '</td><td>' . $TDs . '</td>';
    }

    if ($category === 'rec') {

        $rec = 0;
        $yards = 0;
        $TDs = 0;

        $getReceivingStats = db_query("SELECT * FROM `stats_rec` WHERE Player_ID='{$master_ID}'");
        while ($fetchReceivingStats = $getReceivingStats->fetch_assoc()) {

            if (getGameYear($fetchReceivingStats['Game_ID']) === $year) {

                $rec = $rec + $fetchReceivingStats['Rec'];
                $yards = $yards + $fetchReceivingStats['Yards'];
                $TDs = $TDs + $fetchReceivingStats['TDs'];
            }
        }

        echo '<td>' . $year . '</td><td>' . $rec . '</td><td>' . number_format($yards) . '</td><td>' . $TDs . '</td>';
    }

    if ($category === 'def') {

        $tak = 0;
        $forloss = 0;
        $sacks = 0;
        $INTs = 0;
        $INTTDs = 0;
        $passDef = 0;
        $ff = 0;
        $fumRec = 0;
        $fumTDs = 0;

        $getDefStats = db_query("SELECT * FROM `stats_def` WHERE Player_ID='{$master_ID}'");
        while ($fetchDefStats = $getDefStats->fetch_assoc()) {

            if (getGameYear($fetchDefStats['Game_ID']) === $year) {

                $tak = $tak + $fetchDefStats['Tackles'];
                $forloss = $forloss + $fetchDefStats['ForLoss'];
                $sacks = $sacks + $fetchDefStats['Sacks'];
                $INTs = $INTs + $fetchDefStats['INTs'];
                $INTTDs = $INTTDs + $fetchDefStats['INT_TDs'];
                $passDef = $passDef + $fetchDefStats['PassDef'];
                $ff = $ff + $fetchDefStats['ForcedFumbles'];
                $fumRec = $fumRec + $fetchDefStats['FumbleRec'];
                $fumTDs = $fumTDs + $fetchDefStats['FumbleTDs'];
            }
        }

        echo '<td>' . $year . '</td><td>' . $tak . '</td><td>' . $forloss . '</td><td>' . $sacks . '</td><td>' . $INTs . '</td><td>' . $INTTDs . '</td><td>' . $passDef . '</td><td>' . $ff . '</td><td>' . $fumRec . '</td><td>' . $fumTDs . '</td>';
    }

    if ($category === 'ret') {

        $KRs = 0;
        $KRyards = 0;
        $KRTDs = 0;
        $PRs = 0;
        $PRyards = 0;
        $PRTDs = 0;

        $getRetStats = db_query("SELECT * FROM `stats_ret` WHERE Player_ID='{$master_ID}'");
        while ($fetchRetStats = $getRetStats->fetch_assoc()) {

            if (getGameYear($fetchRetStats['Game_ID']) === $year) {

                $KRs = $KRs + $fetchRetStats['KR_Ret'];
                $KRyards = $KRyards + $fetchRetStats['KR_Yards'];
                $KRTDs = $KRTDs + $fetchRetStats['KR_TDs'];
                $PRs = $PRs + $fetchRetStats['PR_Ret'];
                $PRyards = $PRyards + $fetchRetStats['PR_Yards'];
                $PRTDs = $PRTDs + $fetchRetStats['PR_TDs'];
            }
        }

        echo '<td>' . $year . '</td><td>' . $KRs . '</td><td>' . $KRyards . '</td><td>' . $KRTDs . '</td><td>' . $PRs . '</td><td>' . $PRyards . '</td><td>' . $PRTDs . '</td>';
    }

    if ($category === 'Kicking') {

        $XPM = 0;
        $XPA = 0;
        $FGM = 0;
        $FGA = 0;

        $getKickingStats = db_query("SELECT * FROM `stats_kicking` WHERE Player_ID='{$master_ID}'");
        while ($fetchKickingStats = $getKickingStats->fetch_assoc()) {

            if (getGameYear($fetchKickingStats['Game_ID']) === $year) {

                $XPM = $XPM + $fetchKickingStats['XPM'];
                $XPA = $XPA + $fetchKickingStats['XPA'];
                $FGM = $FGM + $fetchKickingStats['FGM'];
                $FGA = $FGA + $fetchKickingStats['FGA'];
            }
        }

        $XP_Percent = $XPM / $XPA;
        $FG_Percent = $FGM / $FGA;

        echo '<td>' . $year . '</td><td>' . $XPM . '</td><td>' . $XPA . '</td><td>' . toPercent($XP_Percent) . '</td><td>' . $FGM . '</td><td>' . $FGA . '</td><td>' . toPercent($FG_Percent) . '</td>';
    }

    if ($category === 'Punting') {

        $punts = 0;
        $puntYards = 0;

        $getPuntingStats = db_query("SELECT * FROM `stats_punting` WHERE Player_ID='{$master_ID}'");
        while ($fetchPuntingStats = $getPuntingStats->fetch_assoc()) {

            if (getGameYear($fetchPuntingStats['Game_ID']) === $year) {

                $punts = $punts + $fetchPuntingStats['Att'];
                $puntYards = $puntYards + $fetchPuntingStats['Yards'];
            }
        }

        $punt_Avg = $puntYards / $punts;

        echo '<td>' . $year . '</td><td>' . $punts . '</td><td>' . $puntYards . '</td><td>' . number_format($punt_Avg, 1) . '</td>';
    }
}

function toPercent($num) {

    return sprintf("%.0f%%", $num * 100);
}

//Check to see if the player has at least one row for the provided category || If so return true, If not return false
function oneStatRowExists($category, $master_ID) {

    $checkStatRow = db_query("SELECT * FROM `stats_{$category}` WHERE Player_ID='{$master_ID}'");
    $num_rows = mysqli_num_rows($checkStatRow);

    if ($num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function categoryToTitle($category) {

    if ($category === 'rec') {
        return 'Receiving';
    } elseif ($category === 'def') {
        return 'Defense';
    } elseif ($category === 'ret') {
        return 'Returns';
    } else {
        return $category;
    }
}

function checkOT($GM_ID) {

    $getOTData = db_query("SELECT * FROM `games` WHERE GM_ID='{$GM_ID}'");
    $fetchOTData = $getOTData->fetch_assoc();

    if ($fetchOTData['OT'] === 'Y') {

        if ($fetchOTData['OT_Num'] > 1) {
            return 'in ' . $fetchOTData['OT_Num'] . 'OT';
        } else {
            return 'in OT';
        }
    }
}

function return_game_type_ID($GM_ID) {

    $getGameTypeData = db_query("SELECT * FROM `games` WHERE GM_ID='{$GM_ID}'");
    $fetchGameTypeData = $getGameTypeData->fetch_assoc();

    return $fetchGameTypeData['GM_Type'];
}

function returnSeasonAP($AP_RK, $season_ID) {

    if ($season_ID < 45) {
        return 'Start 1934';
    } else {
        if ($AP_RK === '0') {
            return 'NR';
        } else {
            return $AP_RK;
        }
    }
}

function returnSeasonCFP($CFP_RK, $season_ID) {

    if ($season_ID < 125) {
        return 'Start 2014';
    } else {
        if ($CFP_RK === '0') {
            return 'NR';
        } else {
            return $CFP_RK;
        }
    }
}

function returnSeriesRecord($OppID) {

    $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$OppID}'");

    $wins = 0;
    $losses = 0;
    $ties = 0;

    while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

        if ($fetchoppGMdata['OSU_Score'] > $fetchoppGMdata['Opp_Score']) {
            $wins++;
        }
        if ($fetchoppGMdata['OSU_Score'] < $fetchoppGMdata['Opp_Score']) {
            $losses++;
        }
        if ($fetchoppGMdata['OSU_Score'] === $fetchoppGMdata['Opp_Score']) {
            $ties++;
        }
    }

    return '( ' . $wins . ' - ' . $losses . ' - ' . $ties . ' )';
}

function HomeAwayLookup($H_A) {

    if ($H_A === 'H') {
        return 'Home';
    }
    if ($H_A === 'A') {
        return 'Away';
    }
    if ($H_A === 'N') {
        return 'Neutral Site';
    }
}

function returnGameOutcome($OSU_Score, $Opp_Score) {

    if ($OSU_Score > $Opp_Score) {
        return 'Won';
    }
    if ($OSU_Score < $Opp_Score) {
        return 'Lost';
    }
    if ($OSU_Score === $Opp_Score) {
        return 'Tied';
    }
}

function returnOppSummaryItem($OppID, $Item) {

    if ($Item === 'HomeRec') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$OppID}' AND H_A='H'");

        $wins = 0;
        $losses = 0;
        $ties = 0;

        while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

            if ($fetchoppGMdata['OSU_Score'] > $fetchoppGMdata['Opp_Score']) {
                $wins++;
            }
            if ($fetchoppGMdata['OSU_Score'] < $fetchoppGMdata['Opp_Score']) {
                $losses++;
            }
            if ($fetchoppGMdata['OSU_Score'] === $fetchoppGMdata['Opp_Score']) {
                $ties++;
            }
        }
        return '( ' . $wins . ' - ' . $losses . ' - ' . $ties . ' )';
    }
    if ($Item === 'AwayRec') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$OppID}' AND H_A='A'");

        $wins = 0;
        $losses = 0;
        $ties = 0;

        while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

            if ($fetchoppGMdata['OSU_Score'] > $fetchoppGMdata['Opp_Score']) {
                $wins++;
            }
            if ($fetchoppGMdata['OSU_Score'] < $fetchoppGMdata['Opp_Score']) {
                $losses++;
            }
            if ($fetchoppGMdata['OSU_Score'] === $fetchoppGMdata['Opp_Score']) {
                $ties++;
            }
        }
        return '( ' . $wins . ' - ' . $losses . ' - ' . $ties . ' )';
    }

    if ($Item === 'OSUTotalFor') {
        return OSUseriesTotal($OppID);
    }

    if ($Item === 'OppTotalFor') {
        return OppSeriesTotal($OppID);
    }
    if ($Item === 'OSUAvgFor') {
        $OSUTotal = OSUseriesTotal($OppID);
        $gameCount = countSeriesGames($OppID);

        return $OSUTotal / $gameCount;
    }
    if ($Item === 'OppAvgFor') {
        $OppTotal = OppseriesTotal($OppID);
        $gameCount = countSeriesGames($OppID);

        return $OppTotal / $gameCount;
    }
}

function OSUseriesTotal($OppID) {

    $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$OppID}'");

    $OSUTotal = 0;

    while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

        $OSUTotal = $OSUTotal + $fetchoppGMdata['OSU_Score'];
    }
    return $OSUTotal;
}

function OppSeriesTotal($OppID) {
    $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$OppID}'");

    $OppTotal = 0;

    while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

        $OppTotal = $OppTotal + $fetchoppGMdata['Opp_Score'];
    }
    return $OppTotal;
}

function countSeriesGames($OppID) {

    $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$OppID}'");

    $gameCount = 0;

    while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

        $gameCount++;
    }
    return $gameCount;
}

function returnSeriesGames($OppID, $GMType, $OppName) {

    if ($GMType === '1v2') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$OppID}' AND (Opp_AP_RK = 1 OR OSU_AP_RK = 1) AND (Opp_AP_RK = 2 OR OSU_AP_RK = 2)");

        $rows = mysqli_num_rows($oppGMdata);

        if ($rows < 1) {
            echo 'None';
        } else {
            while ($fetchOppGMdata = $oppGMdata->fetch_assoc()) {
                echo '<tr class="' . returnGameOutcomeClass($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '">';
                echo '<td>' . getSeason_Year($fetchOppGMdata['Season_ID']) . ' - Week ' . $fetchOppGMdata['Week'] . '</td>';
                echo '<td>' . $fetchOppGMdata['Date'] . '</td>';
                echo '<td>' . locationLookup($fetchOppGMdata['Location']) . '</td>';
                echo '<td><span class="badge badge-secondary">#' . $fetchOppGMdata['OSU_AP_RK'] . '</span> OSU - ' . $fetchOppGMdata['OSU_Score'] . ' <span class="badge badge-secondary">#' . $fetchOppGMdata['Opp_AP_RK'] . '</span> ' . $OppName . '- ' . $fetchOppGMdata['Opp_Score'] . '</td>';
                echo '</tr>';
            }
        }
    }
    if ($GMType === 'Top5') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE (VS='{$OppID}' AND (Opp_AP_RK <= 5 AND Opp_AP_RK > 0 AND OSU_AP_RK <=5 AND OSU_AP_RK > 0))");

        $rows = mysqli_num_rows($oppGMdata);

        if ($rows < 1) {
            echo 'None';
        } else {

            while ($fetchOppGMdata = $oppGMdata->fetch_assoc()) {
                echo '<tr class="' . returnGameOutcomeClass($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '">';
                echo '<td>' . getSeason_Year($fetchOppGMdata['Season_ID']) . ' - Week ' . $fetchOppGMdata['Week'] . '</td>';
                echo '<td>' . $fetchOppGMdata['Date'] . '</td>';
                echo '<td>' . locationLookup($fetchOppGMdata['Location']) . '</td>';
                echo '<td><span class="badge badge-secondary">#' . $fetchOppGMdata['OSU_AP_RK'] . '</span> OSU - ' . $fetchOppGMdata['OSU_Score'] . ' <span class="badge badge-secondary">#' . $fetchOppGMdata['Opp_AP_RK'] . '</span> ' . $OppName . '- ' . $fetchOppGMdata['Opp_Score'] . '</td>';
                echo '</tr>';
            }
        }
    }
    if ($GMType === 'Top10') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE (VS='{$OppID}' AND (Opp_AP_RK <= 10 AND Opp_AP_RK > 0 AND OSU_AP_RK <=10 AND OSU_AP_RK > 0))");

        $rows = mysqli_num_rows($oppGMdata);

        if ($rows < 1) {
            echo 'None';
        } else {

            while ($fetchOppGMdata = $oppGMdata->fetch_assoc()) {
                echo '<tr class="' . returnGameOutcomeClass($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '">';
                echo '<td>' . getSeason_Year($fetchOppGMdata['Season_ID']) . ' - Week ' . $fetchOppGMdata['Week'] . '</td>';
                echo '<td>' . $fetchOppGMdata['Date'] . '</td>';
                echo '<td>' . locationLookup($fetchOppGMdata['Location']) . '</td>';
                echo '<td><span class="badge badge-secondary">#' . $fetchOppGMdata['OSU_AP_RK'] . '</span> OSU - ' . $fetchOppGMdata['OSU_Score'] . ' <span class="badge badge-secondary">#' . $fetchOppGMdata['Opp_AP_RK'] . '</span> ' . $OppName . '- ' . $fetchOppGMdata['Opp_Score'] . '</td>';
                echo '</tr>';
            }
        }
    }
    if ($GMType === 'Top25') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE (Opp_AP_RK <= 25 AND Opp_AP_RK > 0 AND OSU_AP_RK <=25 AND OSU_AP_RK > 0) AND Vs='{$OppID}'");

        $rows = mysqli_num_rows($oppGMdata);

        if ($rows < 1) {
            echo 'None';
        } else {

            while ($fetchOppGMdata = $oppGMdata->fetch_assoc()) {
                echo '<tr class="' . returnGameOutcomeClass($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '">';
                echo '<td>' . getSeason_Year($fetchOppGMdata['Season_ID']) . ' - Week ' . $fetchOppGMdata['Week'] . '</td>';
                echo '<td>' . $fetchOppGMdata['Date'] . '</td>';
                echo '<td>' . locationLookup($fetchOppGMdata['Location']) . '</td>';
                echo '<td><span class="badge badge-secondary">#' . $fetchOppGMdata['OSU_AP_RK'] . '</span> OSU - ' . $fetchOppGMdata['OSU_Score'] . ' <span class="badge badge-secondary">#' . $fetchOppGMdata['Opp_AP_RK'] . '</span> ' . opponentLookup($fetchOppGMdata['Vs']) . '- ' . $fetchOppGMdata['Opp_Score'] . '</td>';
                echo '</tr>';
            }
        }
    }
}

function returnGameOutcomeClass($OSU_Score, $Opp_Score) {

    if ($OSU_Score > $Opp_Score) {
        return "table-success";
    }
    if ($OSU_Score === $Opp_Score) {
        return "table-warning";
    }
    if ($OSU_Score < $Opp_Score) {
        return "table-danger";
    }
}

function playerCompareHeader($startYear, $endYear) {

    $year = $startYear;

    echo '<tr>';

    do {

        echo '<th>';
        echo $year;
        echo '</th>';
        $year++;
    } while ($year <= $endYear);

    echo '</tr>';
}

function playerCompareBody($startYear, $endYear) {

    $season = $startYear;

    $masterIDs = [];

    $getPlayerMasterIDs = db_query("SELECT DISTINCT Player_Master_ID FROM `players` WHERE Season BETWEEN '{$startYear}' AND '{$endYear}' ORDER BY Last_Name");

    while ($fetch = $getPlayerMasterIDs->fetch_assoc()) {

        array_push($masterIDs, $fetch['Player_Master_ID']);
    }

    foreach ($masterIDs as $ID) {
        echo '<tr>';

        while ($season <= $endYear) {

            $getPlayerData = db_query("SELECT * FROM `players` WHERE Player_Master_ID={$ID} AND Season={$season}");
            $fetchPlayerData = $getPlayerData->fetch_assoc();

            if (mysqli_num_rows($getPlayerData) === 0) {
                echo '<td>-</td>';
            } else {

                echo '<td>' . $fetchPlayerData['Player_Master_ID'] . " " . $fetchPlayerData['First_Name'] . " " . $fetchPlayerData['Last_Name'] . " " . $fetchPlayerData['Class'] . " " . $fetchPlayerData['Position'] . '</td>';
            }
            $season++;
        }

        $season = $startYear;

        echo '</tr>';
    }
}

function playerCompareAddYearsBtn($startYear, $endYear, $location) {

    $leftYear = $startYear - 1;
    $rightYear = $endYear + 1;

    if ($location === 'Left') {
        echo '<button id="nextCompareYearLeft" class="btn btn-success btn-sm" data-year="' . getSeason_Year($leftYear) . '"><span class="oi oi-plus"></span></button>';
    }
    if ($location === 'Right') {
        echo '<button id="nextCompareYearRight" class="btn btn-success btn-sm" data-year="' . getSeason_Year($rightYear) . '"><span class="oi oi-plus"></span></button>';
    }
}

/* Carousel Functions */

function buildCarousel($id) {

    echo '<div id="playerPhotoIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">';
    echo buildCarouselIndicators();
    echo '</ol>
  <div class="carousel-inner">';
    echo buildCarouselImages();
    echo '</div>
  <a class="carousel-control-prev" href="#playerPhotoIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#playerPhotoIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>';
}

function buildCarouselIndicators() {

    $i = 0;
    $getImages = db_query('SELECT * FROM `photos`');
    while ($fetchImages = $getImages->fetch_assoc()) {
        echo '<li data-target = "#playerPhotoIndicators" data-slide-to = "' . $i . '"></li>';
        $i++;
    }
}

function buildCarouselImages() {

    $i = 0;
    $getImages = db_query('SELECT * FROM `photos`');
    while ($fetchImages = $getImages->fetch_assoc()) {

        echo '<div class = "carousel-item ';
        if ($i === 0) {
            echo 'active';
        }
        echo '">
    <img class = "d-block w-100" src = "/buckeyefootball/libs/images/' . $fetchImages['Photo_Name'] . '.' . $fetchImages['Extension'] . '">
    </div>';
        $i++;
    }
}
