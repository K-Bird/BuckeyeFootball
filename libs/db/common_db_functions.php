<?php

/* Database Functions - database processing or field lookup */

//Create a database connection
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

//Execute a database query
function db_query($query) {
    // Connect to the database
    $connection = db_connect();

    // Query the database
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    return $result;
}

//Escape a database query
function db_quote($query) {
    $connection = db_connect();
    return "'" . mysqli_real_escape_string($connection, $query) . "'";
}

//Take a season ID and return the associated year
function getSeason_Year($Season_ID) {

    $get_seasonYear = db_query("SELECT * FROM `Seasons` WHERE `Season_ID`='{$Season_ID}'");
    $fetch_seasonYear = $get_seasonYear->fetch_assoc();
    $Season_Year = $fetch_seasonYear['Year'];

    return $Season_Year;
}

//Take a season year and return the associated ID
function getSeason_ID($Season_Year) {

    $get_seasonYear = db_query("SELECT * FROM `Seasons` WHERE `Year`='{$Season_Year}'");
    $fetch_seasonYear = $get_seasonYear->fetch_assoc();
    $Season_ID = $fetch_seasonYear['Season_ID'];

    return $Season_ID;
}

//Return the maximum week for a given season
function returnMaxWeek($SeasonID) {

    $getMaxWeek = db_query("SELECT Max(Week) as MaxWeek From `games` WHERE Season_ID='{$SeasonID}'");
    $fetchMaxWeek = $getMaxWeek->fetch_assoc();
    return $fetchMaxWeek['MaxWeek'];
}

//Return the largest game ID from games table
function returnMaxGameID() {

    $getLastGame = db_query("SELECT Max(GM_ID) as LastGame From `games`");
    $fetchLastGame = $getLastGame->fetch_assoc();
    $lastGameID = $fetchLastGame['LastGame'];

    return $lastGameID;
}

//Return the season ID of the given game
function getSeasonIDbyGameID($GameID) {

    $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID={$GameID}");
    $fecthGameData = $getGameData->fetch_assoc();
    $Season_ID = $fecthGameData['Season_ID'];
    return $Season_ID;
}

//Return what the next Player Master ID would be
function incrementPlayerMasterID() {

    $getMaxMasterID = db_query("SELECT Max(Player_Master_ID) as MaxID From `players`");
    $fetchMaxMasterID = $getMaxMasterID->fetch_assoc();
    $nextID = $fetchMaxMasterID['MaxID'] + 1;
    return $nextID;
}

//Return what the next Player row ID would be
function incrementPlayerRow() {

    $getMaxPlayerRow = db_query("SELECT Max(Player_Row) as MaxRow From `players`");
    $fetchMaxPlayerRow = $getMaxPlayerRow->fetch_assoc();
    $nextID = $fetchMaxPlayerRow['MaxRow'] + 1;
    return $nextID;
}

//Return the requested field from the games table
function returnGameFieldByGameID($db_field, $GameID) {

    $getGameField = db_query("SELECT * FROM `games` WHERE GM_ID={$GameID}");
    $fetchGameField = $getGameField->fetch_assoc();
    $value = $fetchGameField[$db_field];
    return $value;
}

//Return a player's master ID based on the player row
function returnPlayerMasterID($player_row) {

    $getMasterID = db_query("SELECT * FROM `players` WHERE Player_Row='{$player_row}'");
    $fetchMasterID = $getMasterID->fetch_assoc();
    $masterID = $fetchMasterID['Player_Master_ID'];
    return $masterID;
}

/* Display Functions - Output is used in page display */

//Check if a game went to OT and display appropriately
function checkOT($Game_ID) {

    $getOTData = db_query("SELECT * FROM `games` WHERE GM_ID='{$Game_ID}'");
    $fetchOTData = $getOTData->fetch_assoc();

    if ($fetchOTData['OT'] === 'Y') {

        if ($fetchOTData['OT_Num'] > 1) {
            return 'in ' . $fetchOTData['OT_Num'] . 'OT';
        } else {
            return 'in OT';
        }
    }
}

//Return OSU record part based on part and level needed
function returnRecord($Season_ID, $record_part, $record_level) {

    $getRecordData = db_query("SELECT * FROM `games` WHERE Season_ID='{$Season_ID}' AND GM_Type <> 52");

    //Set count of record to 0
    $recordCount = 0;

    while ($fetchRecordData = $getRecordData->fetch_assoc()) {

        //If both scores are 0 then skip calculation [game has not been played]
        if ($fetchRecordData['OSU_Score'] === '0' && $fetchRecordData['Opp_Score'] === '0') {
            
        } else {
            //Calculate OVR Record block
            if ($record_part === 'W' && $record_level === 'Ovr') {
                if ($fetchRecordData['OSU_Score'] > $fetchRecordData['Opp_Score']) {
                    $recordCount++;
                }
            }
            if ($record_part === 'L' && $record_level === 'Ovr') {
                if ($fetchRecordData['OSU_Score'] < $fetchRecordData['Opp_Score']) {
                    $recordCount++;
                }
            }
            if ($record_part === 'T' && $record_level === 'Ovr') {
                if ($fetchRecordData['OSU_Score'] == $fetchRecordData['Opp_Score']) {
                    $recordCount++;
                }
            }

            //Calculate Conf Record block
            if ($record_part === 'W' && $record_level === 'Conf') {
                if ($fetchRecordData['OSU_Score'] > $fetchRecordData['Opp_Score'] && $fetchRecordData['Conf_GM'] === 'Y') {
                    $recordCount++;
                }
            }
            if ($record_part === 'L' && $record_level === 'Conf') {
                if ($fetchRecordData['OSU_Score'] < $fetchRecordData['Opp_Score'] && $fetchRecordData['Conf_GM'] === 'Y') {
                    $recordCount++;
                }
            }
            if ($record_part === 'T' && $record_level === 'Conf') {
                if ($fetchRecordData['OSU_Score'] == $fetchRecordData['Opp_Score'] && $fetchRecordData['Conf_GM'] === 'Y') {
                    $recordCount++;
                }
            }

            //Calculate Div Record block
            if ($record_part === 'W' && $record_level === 'Div') {
                if ($fetchRecordData['OSU_Score'] > $fetchRecordData['Opp_Score'] && $fetchRecordData['Div_GM'] === 'Y') {
                    $recordCount++;
                }
            }
            if ($record_part === 'L' && $record_level === 'Div') {
                if ($fetchRecordData['OSU_Score'] < $fetchRecordData['Opp_Score'] && $fetchRecordData['Div_GM'] === 'Y') {
                    $recordCount++;
                }
            }
            if ($record_part === 'T' && $record_level === 'Div') {
                if ($fetchRecordData['OSU_Score'] == $fetchRecordData['Opp_Score'] && $fetchRecordData['Div_GM'] === 'Y') {
                    $recordCount++;
                }
            }
        }
    }

    return $recordCount;
}

//Return a player's first and last name together
function returnPlayerName($Player_Master_ID) {
    $getPlayer = db_query("SELECT * FROM `players` WHERE Player_Master_ID='{$Player_Master_ID}'");
    $fetchPlayerName = $getPlayer->fetch_assoc();
    return $fetchPlayerName['First_Name'] . " " . $fetchPlayerName['Last_Name'];
}

//Build the table headings for player state card summary
function playerStatCardthead($cagetory) {

    if ($cagetory === 'Passing') {

        return '<th></th><th>Completions</th><th>Attempts</th><th>Completion %</th><th>Yards</th><th>TDs</th><th>INTs</th><th>QB Rating</th>';
    }
    if ($cagetory === 'Rushing') {

        return '<th></th><th>Attempts</th><th>Yards</th><th>TDs</th>';
    }
    if ($cagetory === 'rec') {

        return '<th></th><th>Receptions</th><th>Yards</th><th>TDs</th>';
    }
    if ($cagetory === 'def') {

        return '<th></th><td>Tackles</td><td>For Loss</td><td>Sacks</td><td>INTs</td><td>INT TDs</td><td>Passes Defended</td><td>QB Hurries</td><td>Fumble Recoveries</td><td>Fumble TDs</td>';
    }
    if ($cagetory === 'ret') {

        return '<th></th><td>Kick Returns</td><td>Kick Return Yards</td><td>Kick Return TDs</td><td>Punt Returns</td><td>Punt Return Yards</td><td>Punt Return TDs</td>';
    }
    if ($cagetory === 'Kicking') {

        return '<th></th><td>Extra Points Made</td><td>Extra Point Attempts</td><td>Extra Point %</td><td>Field Goals Made</td><td>Field Goal Attempts</td><td>Field Goal %</td><td>Field Goal Long</td>';
    }
    if ($cagetory === 'Punting') {

        return '<th></th><td>Punts</td><td>Punt Yards</td><td>Punt Average</td><td>Punt Long</td>';
    }
}

//Build depth chart button for given position (I formation and spread)
function return_depth_btn($Season_ID, $position, $depth_chart_num) {

    $getPlayerData = db_query("SELECT * FROM `Players` WHERE Season='{$Season_ID}' AND Position='{$position}' AND Depth='{$depth_chart_num}'");
    $fetchPlayerData = $getPlayerData->fetch_assoc();

    if (empty($fetchPlayerData)) {
        $getPlayerData = db_query("SELECT * FROM `Players` WHERE Season='{$Season_ID}' AND Position_2='{$position}' AND Depth_2='{$depth_chart_num}'");
        $fetchPlayerData = $getPlayerData->fetch_assoc();
    }

    $fname = $fetchPlayerData['First_Name'];
    $lname = $fetchPlayerData['Last_Name'];
    $fullName = $fname . " " . $lname;
    //Build a span that acts like a button based on position. showDepthCard class enables the popover with other players at that position
    if ($position === 'KR' || $position === 'PR' || $position === 'LS' || $position === 'H') {
        echo '<span id="', $position . $depth_chart_num, '" class="btn btn-sm btn-secondary">';
        echo '<small>', $position . $depth_chart_num, " - ", $fullName, " - ", $fetchPlayerData['Class'], '</small>';
        echo '</span>';
    } else {

        echo '<span id="', $position . $depth_chart_num, '" class="btn btn-sm btn-secondary showDepthCard">';
        echo '<small>', $position . $depth_chart_num, " - ", $fullName, " - ", $fetchPlayerData['Class'], '</small>';
        echo '</span>';
    }
}

//Calculate the years a player played for display
function returnYearsPlayed($Player_Master_ID) {


    $getSeasonsByMasterID = db_query("SELECT * FROM `players` WHERE Player_Master_ID='{$Player_Master_ID}' ORDER BY Season ASC");
    $Season_IDs = [];

    while ($fetchSeasons = $getSeasonsByMasterID->fetch_assoc()) {

        array_push($Season_IDs, $fetchSeasons['Season']);
    }

    //Count how many years are in the array
    $numYears = count($Season_IDs);

    //If there is only 1 year in the array
    if ($numYears === 1) {

        //get season year by the season ID
        $Season_ID = getSeason_Year($Season_IDs[0]);
        //If the season is the current year display dash
        if ($Season_ID === date('Y')) {
            return '(' . $Season_ID . ' - )';
        } else {
            return '(' . $Season_ID . ')';
        }
        //If there is more than 1 year in the array
    } else {
        //Check if the array contains sequential seasons
        $checkSequential = is_array_sequential($Season_IDs);
        //If the array is sequential
        if ($checkSequential === true) {

            //sort array smallest to largest
            sort($Season_IDs);
            //return mix and max year by season id
            $largestYear = max($Season_IDs);
            $smallestYear = min($Season_IDs);

            return '(' . getSeason_Year($smallestYear) . ' - ' . getSeason_Year($largestYear) . ')';

            //If the array is not sequential    
        } else {
            //remove the first season and set to a variable
            $firstSeason = array_shift($Season_IDs);
            //is the remaining array sequential? If yes, take the min/max season and return both the sequential and non-sequential parts
            if (is_array_sequential($Season_IDs)) {
                $firstSequential = min($Season_IDs);
                $lastSequential = max($Season_IDs);
                return getSeason_Year($firstSeason) . ', (' . getSeason_Year($firstSequential) . ' - ' . getSeason_Year($lastSequential) . ')';
            }
        }
    }
}

//Returns outcome of a game based on the OSU and Opponent scores (full text)
function returnGameOutcome($OSU_Score, $Opp_Score) {

    if ($OSU_Score === '0' && $Opp_Score === '0') {
        return 'Not Played';
    }
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

//Returns outcome of a game based on the OSU and Opponent scores (abbreviated)
function returnGameOutcomeAbbrev($OSU_Score, $Opp_Score) {

    if ($OSU_Score > $Opp_Score) {
        return '<span style="color: green; font-weight: bold">W</span>';
    }
    if ($OSU_Score < $Opp_Score) {
        return '<span style="color: red; font-weight: bold">L</span>';
    }
    if ($OSU_Score === $Opp_Score) {
        return '<span style="color: yellow; font-weight: bold">T</span>';
    }
}

//Return the date a given game was played
function returnGameDate($GameID) {

    $getGameDate = db_query("SELECT * FROM `games` WHERE GM_ID='{$GameID}'");
    $fetchGameDate = $getGameDate->fetch_assoc();
    return $fetchGameDate['Date'];
}

//Returns display text for home, away or neutral site games
function HomeAwayLookup($HomeOrAway) {

    if ($HomeOrAway === 'H') {
        return 'Home';
    }
    if ($HomeOrAway === 'A') {
        return 'Away';
    }
    if ($HomeOrAway === 'N') {
        return 'Neutral Site';
    }
}

//Display formatted home or away for given game
function returnVsAtN($HomeOrAway) {

    if ($HomeOrAway === 'H') {
        return 'vs';
    }
    if ($HomeOrAway === 'A') {
        return 'at';
    }
}

//Return the tag name of a misc tag based on the Misc video Tag ID
function returnMiscTagNameByIDphoto($Misc_ID_Photo) {

    $getTagName = db_query("SELECT * FROM `ref_misc_photo_tags` WHERE Tag_ID='{$Misc_ID_Photo}'");
    $fetchTagName = $getTagName->fetch_assoc();
    $TagName = $fetchTagName['Tag_Name'];
    return $TagName;
}

//Return the tag name of a misc tag based on the Misc video Tag ID
function returnMiscTagNameByIDvideo($Misc_ID_Video) {

    $getTagName = db_query("SELECT * FROM `ref_misc_video_tags` WHERE Tag_ID='{$Misc_ID_Video}'");
    $fetchTagName = $getTagName->fetch_assoc();
    $TagName = $fetchTagName['Tag_Name'];
    return $TagName;
}

//recevie a player id and genterate all images tagged with the player ID
function buildPlayerPhotoGallery($Player_Master_ID) {

    $taggedPhotos = taggedPhotoIDs($Player_Master_ID, 'player');


    foreach ($taggedPhotos as $photoID) {

        $getPhotoDetails = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photoID}'");
        $fetchPhotoDetails = $getPhotoDetails->fetch_assoc();

        echo '<div class="gg-element">';
        echo '<img class="playerPhoto" src="/buckeyefootball/libs/images/uploaded/' . $fetchPhotoDetails['Photo_Name'] . '.' . $fetchPhotoDetails['Extension'] . '">';
        echo '</div>';
    }
}

//recevie a game id and genterate all images tagged with the player ID
function buildGamePhotoGallery($Game_ID) {

    $taggedPhotos = taggedPhotoIDs($Game_ID, 'game');


    foreach ($taggedPhotos as $photoID) {

        $getPhotoDetails = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photoID}'");
        $fetchPhotoDetails = $getPhotoDetails->fetch_assoc();

        echo '<div class="gg-element">';
        echo '<img class="playerPhoto" src="/buckeyefootball/libs/images/uploaded/' . $fetchPhotoDetails['Photo_Name'] . '.' . $fetchPhotoDetails['Extension'] . '">';
        echo '</div>';
    }
}

//recevie a misc tag id and genterate all images tagged with the player ID
function buildMiscPhotoGallery($Misc_ID_Photo) {

    $taggedPhotos = taggedPhotoIDs($Misc_ID_Photo, 'misc');


    foreach ($taggedPhotos as $photoID) {

        $getPhotoDetails = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photoID}'");
        $fetchPhotoDetails = $getPhotoDetails->fetch_assoc();

        echo '<div class="gg-element">';
        echo '<img class="playerPhoto" src="/buckeyefootball/libs/images/uploaded/' . $fetchPhotoDetails['Photo_Name'] . '.' . $fetchPhotoDetails['Extension'] . '">';
        echo '</div>';
    }
}

//recevie a misc tag or game tag and return gallery of videos
function buildVideoGallery($ID, $category) {

    $i = 1;

    if ($category === 'all') {

        $getVideoDetails = db_query("SELECT * FROM `videos`");
        while ($fetchVideoDetails = $getVideoDetails->fetch_assoc()) {
            echo displayVideo($fetchVideoDetails);
            echo '&nbsp;';
            if ($i % 3 == 0) {
                echo '<br>';
            }
            $i++;
        }
    }

    if ($category === 'game') {
        $taggedVideos = taggedVideoIDs($ID, 'game');

        foreach ($taggedVideos as $videoID) {

            $getVideoDetails = db_query("SELECT * FROM `videos` WHERE Video_ID='{$videoID}'");
            $fetchVideoDetails = $getVideoDetails->fetch_assoc();
            echo displayVideo($fetchVideoDetails);
            echo '&nbsp;';
            if ($i % 3 == 0) {
                echo '<br>';
            }
            $i++;
        }
    }

    if ($category === 'misc') {
        $taggedVideos = taggedVideoIDs($ID, 'misc');

        foreach ($taggedVideos as $videoID) {

            $getVideoDetails = db_query("SELECT * FROM `videos` WHERE Video_ID='{$videoID}'");
            $fetchVideoDetails = $getVideoDetails->fetch_assoc();
            echo displayVideo($fetchVideoDetails);

            echo '&nbsp;';
            if ($i % 3 == 0) {
                echo '<br>';
            }
            $i++;
        }
    }
}

function displayVideo($videoResult) {

    if ($videoResult['Extension'] === 'gif') {
        echo '<img src="/buckeyefootball/libs/video/uploaded/' . $videoResult['Video_Name'] . '.' . $videoResult['Extension'] . '" height="200px" width="400px">';
    } else {
        echo '<video controls height="200px" width="400px">';
        echo '<source src="/buckeyefootball/libs/video/uploaded/' . $videoResult['Video_Name'] . '.' . $videoResult['Extension'] . '" type=video/' . $videoResult['Extension'] . '">';
        echo '</video>';
    }
}

//Build the tags for displaying on a video of any category
function returnVideoTags($video_id, $category) {

    $getVideoTags = db_query("SELECT * FROM `videos` WHERE Video_ID='{$video_id}'");
    $fetchVideotag = $getVideoTags->fetch_assoc();

    if ($category === 'game') {
        $gameTags = $fetchVideotag['Game_Tags'];

        if (empty($gameTags)) {
            
        } else {

            $eachTag = explode(',', $gameTags);

            foreach ($eachTag as $tag) {
                echo '<span class="badge badge-pill badge-secondary">';

                $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$tag}'");
                $fetchGameData = $getGameData->fetch_assoc();

                echo $fetchGameData['Date'] . " - (" . HomeAwayLookup($fetchGameData ['H_A']) . ") Vs " . opponentLookup($fetchGameData['Vs']);

                echo '&nbsp;<span aria-hidden="true" data-tag="', $tag, '" data-video="', $video_id, '" class="gameTagRemovev">&times;</span>';
                echo '</span>';
            }
        }
    }

    if ($category === 'misc') {
        $miscTags = $fetchVideotag['Misc_Tags'];

        if (empty($miscTags)) {
            
        } else {

            $eachTag = explode(',', $miscTags);

            foreach ($eachTag as $tag) {
                echo '<span class="badge badge-pill badge-secondary">';

                echo returnMiscTagNameByIDvideo($tag);

                echo '&nbsp;<span aria-hidden="true" data-tag="', $tag, '" data-video="', $video_id, '" class="miscTagRemovev">&times;</span>';
                echo '</span>';
            }
        }
    }
}

//Based on stat category return the appropriate title
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

/* Season Functions - Season specific functions */

//return The total points OSU scored in a season
function returnPTSfor($Season_ID) {

    $getPTSforData = db_query("SELECT * FROM `games` WHERE Season_ID='{$Season_ID}' AND VS <> 129");

    $ptsFor = 0;

    while ($fetchPTSforData = $getPTSforData->fetch_assoc()) {

        $ptsFor = $ptsFor + $fetchPTSforData['OSU_Score'];
    }

    return $ptsFor;
}

//return the total points opponents scored in a season
function returnPTSaga($Season_ID) {

    $getPTSagaData = db_query("SELECT * FROM `games` WHERE Season_ID='{$Season_ID}' AND VS <> 129");

    $ptsAga = 0;

    while ($fetchPTSagaData = $getPTSagaData->fetch_assoc()) {

        $ptsAga = $ptsAga + $fetchPTSagaData['Opp_Score'];
    }

    return $ptsAga;
}

//Return an opponents rank for a given game
function returnOppRk($Game_ID) {

    $getGMdata = db_query("SELECT * FROM `games` WHERE GM_ID={$Game_ID}");
    $fetchGMdata = $getGMdata->fetch_assoc();

    $Season_ID_year = getSeason_Year($fetchGMdata['Season_ID']);
    $opp_ap_rk = $fetchGMdata['Opp_AP_RK'];
    $opp_cfp_rk = $fetchGMdata['Opp_CFP_RK'];
    $season_week = $fetchGMdata['Week'];

    /* If season < 2014 use AP | if season > 2014 and week < 10 use AP | if season > 2014 and week > 10 and not a CFP game use AP, if CFP game use CFP */
    if ($Season_ID_year < 2014) {
        if ($opp_ap_rk === '0') {
            return '';
        } else {
            return 'AP #' . $opp_ap_rk;
        }
    }
    if ($Season_ID_year >= 2014 && $season_week < 10) {
        if ($opp_ap_rk === '0') {
            return '';
        } else {
            return "AP #" . $opp_ap_rk;
        }
    }
    if ($Season_ID_year >= 2014 && $season_week >= 9 && ($fetchGMdata['GM_Type'] === '41' || $fetchGMdata['GM_Type'] === '42')) {
        if ($opp_cfp_rk === '0') {
            return '';
        } else {
            return "CFP #" . $opp_cfp_rk;
        }
    }
    if ($Season_ID_year >= 2014 && $season_week >= 9 && ($fetchGMdata['GM_Type'] != '41' || $fetchGMdata['GM_Type'] != '42')) {
        if ($opp_ap_rk === '0') {
            return '';
        } else {
            return "CFP #" . $opp_ap_rk;
        }
    }
}

//Return OSUs rank for a given game
function returnOSURk($Game_ID) {

    $getGMdata = db_query("SELECT * FROM `games` WHERE GM_ID={$Game_ID}");
    $fetchGMdata = $getGMdata->fetch_assoc();

    $Season_ID_year = getSeason_Year($fetchGMdata['Season_ID']);
    $osu_ap_rk = $fetchGMdata['OSU_AP_RK'];
    $osu_cfp_rk = $fetchGMdata['OSU_CFP_RK'];
    $season_week = $fetchGMdata['Week'];

    /* If season < 2014 use AP | if season > 2014 and week < 10 use AP | if season > 2014 and week > 10 and not a CFP game use AP, if CFP game use CFP */
    if ($Season_ID_year < 2014) {
        if ($osu_ap_rk === '0') {
            return '';
        } else {
            return 'AP #' . $osu_ap_rk;
        }
    }
    if ($Season_ID_year >= 2014 && $season_week < 10) {
        if ($osu_ap_rk === '0') {
            return '';
        } else {
            return "AP #" . $osu_ap_rk;
        }
    }
    if ($Season_ID_year >= 2014 && $season_week >= 9 && ($fetchGMdata['GM_Type'] === '41' || $fetchGMdata['GM_Type'] === '42')) {
        if ($osu_cfp_rk === '0') {
            return '';
        } else {
            return "CFP #" . $osu_cfp_rk;
        }
    }
    if ($Season_ID_year >= 2014 && $season_week >= 9 && ($fetchGMdata['GM_Type'] != '41' || $fetchGMdata['GM_Type'] != '42')) {
        if ($osu_ap_rk === '0') {
            return '';
        } else {
            return "CFP #" . $osu_ap_rk;
        }
    }
}

//Given the season and week calcuate and display the following week's AP ranking difference
function calc_AP_RK_Diff($Season_ID, $season_week) {

    //Get the given (current) week's AP ranking
    $getCurr_AP_RK = db_query("SELECT * FROM `games` WHERE Week='{$season_week}' and Season_ID={$Season_ID}");
    $fetchCurr_AP_RK = $getCurr_AP_RK->fetch_assoc();
    $curr_AP_RK = $fetchCurr_AP_RK['OSU_AP_RK'];

    //If the season is prior to 1936 return the poll not existing 
    if ($Season_ID < 47) {
        return 'AP Poll Did Not Exist';
    }
    //If the week is one then display the starting AP rank, if not calculate the differece between the current week's AP rank and the following week's AP rank
    if ($season_week === '1') {
        return '#' . $curr_AP_RK;
    } else {
        //Select game from next week of the given season
        $nextWeek = $season_week + 1;
        $getNext_AP_RK = db_query("SELECT * FROM `games` WHERE Week='{$nextWeek}' and Season_ID={$Season_ID}");

        //If the next week doesn't exist (the result is empty) then find the final AP ranking to display on the last week of the season
        if (mysqli_num_rows($getNext_AP_RK) === 0) {

            $getFinal_AP_RK = db_query("SELECT * FROM `seasons` WHERE Season_ID={$Season_ID}");
            $fetchFinal_AP_RK = $getFinal_AP_RK->fetch_assoc();
            $final_AP_RK = $fetchFinal_AP_RK['AP_Final'];
            //If the final AP rank is not ranked (0) then display not ranked
            if ($final_AP_RK === '0') {
                return '<span class="badge badge-secondary">Not Ranked</span>';
            } else {
                $num_diff = $final_AP_RK - $curr_AP_RK;
                return '#' . $final_AP_RK . " " . returnDiff($num_diff);
            }
        }
        //If the next week does exist then calucate the difference between the rankings
        $fetchNext_AP_RK = $getNext_AP_RK->fetch_assoc();
        $next_AP_RK = $fetchNext_AP_RK['OSU_AP_RK'];
        //If the team is not ranked for the next week then display not ranked 
        if ($next_AP_RK === '0') {
            return '<span class="badge badge-secondary">Not Ranked</span>';
        }
        //If the team was previously not ranked (0) then display the new ranking. If they were ranked calculate the normal difference (returnDiff function)
        if ($curr_AP_RK === '0') {
            return '#' . $next_AP_RK;
        } else {
            $num_diff = $next_AP_RK - $curr_AP_RK;
            return '#' . $next_AP_RK . " " . returnDiff($num_diff);
        }
    }
}

//Given the season and week calcuate and display the following week's CFP ranking difference
function calc_CFP_RK_Diff($Season_ID, $season_week, $Game_ID) {

    //Get the given (current) week's CFP ranking
    $getCurr_CFP_RK = db_query("SELECT * FROM `games` WHERE Week='{$season_week}' and Season_ID={$Season_ID}");
    $fetchCurr_CFP_RK = $getCurr_CFP_RK->fetch_assoc();
    $curr_CFP_RK = $fetchCurr_CFP_RK['OSU_CFP_RK'];

    //Get the given (current) season's week that the CFP rankings began
    $get_CFP_RK_Start = db_query("SELECT * FROM `seasons` WHERE Season_ID={$Season_ID}");
    $fetch_CFP_RK_Start = $get_CFP_RK_Start->fetch_assoc();
    $CFP_RK_Start = $fetch_CFP_RK_Start['CFP_RK_Start'];


    //If season is less than 2014 display that the CFP rankings did not exist
    if ($Season_ID < 125) {
        return 'CFP Rankings Begin 2014';
    }
    //If the week is equal to the start of the CFP rankings for that year just display the CFP ranking for that week 
    if ($season_week === $CFP_RK_Start) {
        return '#' . $curr_CFP_RK;
    }
    //If the week is earlier than the CFP rankings start week then display that the rankings start the week the first rankings come out
    if ($season_week < $CFP_RK_Start) {
        return 'Start Week ' . $CFP_RK_Start;
    }
    //If the week is afer the start week of the CFP rankings but not a CFP game then calcuate the difference between the current week's CFP ranking and the following week's CFP ranking
    if ($season_week >= $CFP_RK_Start) {

        //If the game is the CFP Semis or CFP Finals then just display the CFP seeding (last CFP rank)
        if (return_game_type_ID($Game_ID) === '41' || return_game_type_ID($Game_ID) === '42') {
            return 'CFP #' . $curr_CFP_RK . ' Seed';
        }
        //If the game is a bowl then display that the CFP rankings are complete
        if (return_game_type_by_ID($Game_ID) === 'Bowl') {
            return 'CFP Rankings Complete';
        }

        $nextWeek = $season_week + 1;
        $getNextCFP_RK = db_query("SELECT * FROM `games` WHERE Week='{$nextWeek}'and Season_ID={$Season_ID}");
        $fetchNextCFP_RK = $getNextCFP_RK->fetch_assoc();
        $Next_CFP = $fetchNextCFP_RK['OSU_CFP_RK'];

        $num_diff = $Next_CFP - $curr_CFP_RK;
        return '#' . $Next_CFP . " " . returnDiff($num_diff);
    }
}

//Return the type of depth chart associated to a season
function returnSeasonDepth($Season_ID) {

    $getDepth = db_query("SELECT * FROM `seasons` WHERE Season_ID='{$Season_ID}'");
    $fetchDepth = $getDepth->fetch_assoc();
    $depth_chart_num = $fetchDepth['DepthChart'];
    return $depth_chart_num;
}

//Return the most recent decade in existance for recorded seasons
function returnMaxSeasonDecade() {

    $getMaxDecadeRow = db_query("SELECT Max(Decade_Row) as MaxDecade From `decades`");
    $fetchMaxDecadeRow = $getMaxDecadeRow->fetch_assoc();
    $maxDecade = $fetchMaxDecadeRow['MaxDecade'];
    return $maxDecade;
}

//Return game indicator for given category if exists
function returnGameIndicator($category, $Game_ID) {

    if ($category === 'stats') {
        $checkGameStatsExist = db_query("SELECT `Game_ID` FROM `stats_def` WHERE `Game_ID` = '{$Game_ID}'
            UNION ALL
            SELECT `Game_ID` FROM `stats_kicking` WHERE `Game_ID` = '{$Game_ID}'
            UNION ALL
            SELECT `Game_ID` FROM `stats_passing` WHERE `Game_ID` = '{$Game_ID}'
            UNION ALL
            SELECT `Game_ID` FROM `stats_punting` WHERE `Game_ID` = '{$Game_ID}'
            UNION ALL
            SELECT `Game_ID` FROM `stats_rec` WHERE `Game_ID` = '{$Game_ID}'
            UNION ALL
            SELECT `Game_ID` FROM `stats_ret` WHERE `Game_ID` = '{$Game_ID}'
            UNION ALL
            SELECT `Game_ID` FROM `stats_rushing` WHERE `Game_ID` = '{$Game_ID}'");

        if (mysqli_num_rows($checkGameStatsExist) > 0) {
            return '<span class="oi oi-spreadsheet" title="Stats"></span>';
        }
    }
    if ($category === 'box') {

        $checkGamePhotosExist = db_query("SELECT * FROM `games_box_scores` WHERE `GM_ID` = '{$Game_ID}'");

        if (mysqli_num_rows($checkGamePhotosExist) > 0) {
            return '<span class="oi oi-box" title="Box Score"></span>';
        }
    }
    if ($category === 'photo') {

        $checkGamePhotosExist = db_query("SELECT `Game_Tags` FROM `photos` WHERE `Game_Tags` = '{$Game_ID}'");

        if (mysqli_num_rows($checkGamePhotosExist) > 0) {
            return '<span class="oi oi-image" title="Photos"></span>';
        }
    }
    if ($category === 'video') {

        $checkGamePhotosExist = db_query("SELECT `Game_Tags` FROM `videos` WHERE `Game_Tags` = '{$Game_ID}'");

        if (mysqli_num_rows($checkGamePhotosExist) > 0) {
            return '<span class="oi oi-video" title="Videos"></span>';
        }
    }
}

/* Player Functions - Player specific functions */

//Return if a player is a stater at their position in context of depth chart number
function checkForStarter($positionGroup, $depth_chart_num) {

    if ($positionGroup === 'OL') {
        if ($depth_chart_num === '1' || $depth_chart_num === '2' || $depth_chart_num === '3' || $depth_chart_num === '4' || $depth_chart_num === '5') {
            return true;
        }
    }
    if ($positionGroup === 'DL') {
        if ($depth_chart_num === '1' || $depth_chart_num === '2' || $depth_chart_num === '3' || $depth_chart_num === '4') {
            return true;
        }
    }
    if ($positionGroup === 'LB') {
        if ($depth_chart_num === '1' || $depth_chart_num === '2' || $depth_chart_num === '3') {
            return true;
        }
    }
    if ($positionGroup === 'DB') {
        if ($depth_chart_num === '1' || $depth_chart_num === '2' || $depth_chart_num === '3' || $depth_chart_num === '4') {
            return true;
        }
    }
}

//Return requested field based on a give player row
function getPlayerFieldByRow($db_field, $player_row) {

    $getAttribute = db_query("SELECT * FROM `players` WHERE Player_Row='{$player_row}'");
    $fetchAttribute = $getAttribute->fetch_assoc();
    $attribute = $fetchAttribute[$db_field];
    return $attribute;
}

//Return requested field based on a Player Master ID (season doesn't matter)
function getPlayerFieldByMasterID($db_field, $Player_Master_ID) {

    $getAttribute = db_query("SELECT * FROM `players` WHERE Player_Master_ID='{$Player_Master_ID}'");
    $fetchAttribute = $getAttribute->fetch_assoc();
    $attribute = $fetchAttribute[$db_field];
    return $attribute;
}

//Return requested field based on a Player Master ID and Season ID
function getPlayerFieldByMasterIDSeasonID($db_field, $Player_Master_ID, $Season_ID_ID) {

    $getAttribute = db_query("SELECT * FROM `players` WHERE Player_Master_ID='{$Player_Master_ID}' AND Season='{$Season_ID_ID}'");
    $fetchAttribute = $getAttribute->fetch_assoc();
    $attribute = $fetchAttribute[$db_field];
    return $attribute;
}

//Return a specific players stat for a given stat category and game
function returnGameStat($GameID, $Player_Master_ID, $category, $db_field) {

    $getGameStat = db_query("SELECT * FROM `stats_{$category}` WHERE Game_ID={$GameID} AND Player_ID={$Player_Master_ID}");
    $fetchGameStat = $getGameStat->fetch_assoc();
    return $fetchGameStat[$db_field];
}

//Return and array of the seasons a player played
function returnYearsPlayedArray($Player_Master_ID) {

    $getSeasonsByMasterID = db_query("SELECT * FROM `players` WHERE Player_Master_ID='{$Player_Master_ID}' ORDER BY Season DESC");
    $Season_IDs = [];

    while ($fetchSeasons = $getSeasonsByMasterID->fetch_assoc()) {

        array_push($Season_IDs, $fetchSeasons['Season']);
    }

    return $Season_IDs;
}

//Return the current player in focus of input player stats
function getInputPlayerAddStat() {

    $getInputAddStat = db_query("SELECT * from `controls` WHERE Control='Input_Stats_Player'");
    $fetchInputAddStat = $getInputAddStat->fetch_assoc();
    $row = $fetchInputAddStat['Value'];
    return $row;
}

/* Game Functions - Game specific functions */

//Return the game type ID for a given game
function return_game_type_ID($Game_ID) {

    $getGameTypeData = db_query("SELECT * FROM `games` WHERE GM_ID='{$Game_ID}'");
    $fetchGameTypeData = $getGameTypeData->fetch_assoc();

    return $fetchGameTypeData['GM_Type'];
}

//Return the type of a given game
function return_game_type_by_ID($Game_ID) {

    $getGameTypeData = db_query("SELECT * FROM `games` WHERE GM_ID='{$Game_ID}'");
    $fetchGameTypeData = $getGameTypeData->fetch_assoc();
    $GM_Type = $fetchGameTypeData['GM_Type'];

    $getGameType = db_query("SELECT * FROM `game_types` WHERE Type_ID={$GM_Type}");
    $fetchGameType = $getGameType->fetch_assoc();
    $type = $fetchGameType['Type'];
    return $type;
}

//Returns game type name based on ID
function gameTypeLookup($Game_Type_ID) {

    $getGameTypeData = db_query("SELECT * From `game_types` WHERE Type_ID='{$Game_Type_ID}'");
    $fetchGameTypeData = $getGameTypeData->fetch_assoc();
    return $fetchGameTypeData['Name'];
}

//Return the season year for a given game
function getGameYear($Game_ID) {

    $getGameSeason = db_query("SELECT * FROM `games` WHERE GM_ID='{$Game_ID}'");
    $fetchGameSeason = $getGameSeason->fetch_assoc();
    $Season = $fetchGameSeason['Season_ID'];
    $Season_Year = getSeason_Year($Season);
    return $Season_Year;
}

/* Support Functions - functions that support other functions or serve universal purpose */

//Returns the difference between two numbers color coded
function returnDiff($num_diff) {

    if ($num_diff === 0) {
        return '<span class=text-warning>(' . $num_diff . ')</span>';
    }
    if ($num_diff > 0) {
        return '<span class=text-danger>(+' . $num_diff . ')</span>';
    }
    if ($num_diff < 0) {
        return '<span class=text-success>(' . $num_diff . ')</span>';
    }
}

//Returns formatted location based on ID
function locationLookup($Location_ID) {

    $getLocData = db_query("SELECT * From `locations` WHERE Loc_ID='{$Location_ID}'");
    $fetchLocData = $getLocData->fetch_assoc();

    if ($Location_ID === '0') {
        return '';
    } else {
        return $fetchLocData['Stadium'] . " (" . $fetchLocData['City'] . ", " . $fetchLocData['State'] . ")";
    }
}

//Returns conference name based on ID
function conferenceLookup($Conference_ID) {

    $getConfData = db_query("SELECT * From `conferences` WHERE Conf_ID='{$Conference_ID}'");
    $fetchConfData = $getConfData->fetch_assoc();

    return $fetchConfData['Conf_Name'];
}

//Returns division name based on ID
function divisionLookup($Division_ID) {

    $getDivData = db_query("SELECT * From `b10_divisions` WHERE Div_ID='{$Division_ID}'");
    $fetchDivData = $getDivData->fetch_assoc();

    return $fetchDivData['Div_Name'];
}

//Return the school name of a given opponent
function opponentLookup($opp_ID) {

    $getOpp = db_query("SELECT * FROM `opponents` WHERE Team_ID='{$opp_ID}'");
    $fetchOpp = $getOpp->fetch_assoc();
    $oppName = $fetchOpp['School'];
    return $oppName;
}

//Convert a number to a percentage
function toPercent($num) {

    return sprintf("%.0f%%", $num * 100);
}

//Return an array of photo IDs that a given category (player, game, misc)  is tagged in
function taggedPhotoIDs($ID, $category) {

    if ($category === 'player') {

        $getAllTaggedPlayers = db_query("SELECT * FROM `photos`");
        $Players = [];

        while ($fetchAllTaggedPlayers = $getAllTaggedPlayers->fetch_assoc()) {

            $IDs = $fetchAllTaggedPlayers['Player_Tags'];
            $eachTag = explode(',', $IDs);

            foreach ($eachTag as $ID_loop) {
                if ($ID_loop === $ID) {
                    $photoID = $fetchAllTaggedPlayers['Photo_ID'];
                    array_push($Players, $photoID);
                }
            }
        }
        return $Players;
    }

    if ($category === 'game') {

        $getAllTaggedGames = db_query("SELECT * FROM `photos`");
        $Games = [];

        while ($fetchAllTaggedGames = $getAllTaggedGames->fetch_assoc()) {

            $IDs = $fetchAllTaggedGames['Game_Tags'];
            $eachTag = explode(',', $IDs);

            foreach ($eachTag as $ID_loop) {
                if ($ID_loop === $ID) {
                    $photoID = $fetchAllTaggedGames['Photo_ID'];
                    array_push($Games, $photoID);
                }
            }
        }
        return $Games;
    }

    if ($category === 'misc') {

        $getAllTaggedMisc = db_query("SELECT * FROM `photos`");
        $Misc = [];

        while ($fetchAllTaggedMisc = $getAllTaggedMisc->fetch_assoc()) {

            $IDs = $fetchAllTaggedMisc['Misc_Tags'];
            $eachTag = explode(',', $IDs);

            foreach ($eachTag as $ID_loop) {
                if ($ID_loop === $ID) {
                    $photoID = $fetchAllTaggedMisc['Photo_ID'];
                    array_push($Misc, $photoID);
                }
            }
        }
        return $Misc;
    }
}

//Return an array of video IDs that a given category (player, game, misc)  is tagged in
function taggedVideoIDs($ID, $category) {

    if ($category === 'game') {

        $getAllTaggedGames = db_query("SELECT * FROM `videos`");
        $IDgedGames = [];

        while ($fetchAllTaggedGames = $getAllTaggedGames->fetch_assoc()) {

            $IDs = $fetchAllTaggedGames['Game_Tags'];
            $eachTag = explode(',', $IDs);

            foreach ($eachTag as $ID_loop) {
                if ($ID_loop === $ID) {
                    $videoID = $fetchAllTaggedGames['Video_ID'];
                    array_push($IDgedGames, $videoID);
                }
            }
        }
        return $IDgedGames;
    }

    if ($category === 'misc') {

        $getAllTaggedMisc = db_query("SELECT * FROM `videos`");
        $IDgedMisc = [];

        while ($fetchAllTaggedMisc = $getAllTaggedMisc->fetch_assoc()) {

            $IDs = $fetchAllTaggedMisc['Misc_Tags'];
            $eachTag = explode(',', $IDs);

            foreach ($eachTag as $ID_loop) {
                if ($ID_loop === $ID) {
                    $videoID = $fetchAllTaggedMisc['Video_ID'];
                    array_push($IDgedMisc, $videoID);
                }
            }
        }
        return $IDgedMisc;
    }
}

//Determine if the numbers in an array are in sequential order
function is_array_sequential($array) {
    $delta = $array[1] - $array[0];
    for ($index = 0; $index < sizeof($array) - 1; $index++) {
        if (($array[$index + 1] - $array[$index]) != $delta) {

            return false;
        }
    }
    return true;
}

//Create and return an array of all player positions
function returnPositionArray() {

    $posArray = array('QB', 'FB', 'H-B', 'RB', 'WR', 'TE', 'OL', 'LT', 'LG', 'C', 'RG', 'RT', 'DL', 'DE', 'DT', 'LB', 'OLB', 'MLB', 'CB', 'S', 'K', 'P', 'KR', 'PR', 'LS', 'H');
    return $posArray;
}

/* Box Score Functions - Box score and scoring play functions */

//Take scoring play type and return full verbiage
function returnScoringPlayTypeVerb($type, $OSU_OPP) {

    if ($type === 'passTD') {

        if ($OSU_OPP === 'OSU') {
            return ' pass from ';
        }
        if ($OSU_OPP === 'OPP') {
            return ' pass ';
        }
    }
    if ($type === 'rushTD') {

        return ' run ';
    }
    if ($type === 'FG') {

        return ' field goal ';
    }
    if ($type === 'INT') {

        return ' interception return ';
    }
    if ($type === 'Fum') {

        return ' fumble recovery ';
    }
    if ($type === 'KR') {

        return ' kickoff return ';
    }
    if ($type === 'PR') {

        return ' punt return ';
    }
    if ($type === 'Saf') {

        return ' Safety ';
    }
}

//Display OSU scoring play
function displayOSUScoringPlay($fetchScoringPlays) {

    echo '<li class="list-group-item small" style="background-color : #BB0000; color: white">';
    echo getPlayerFieldByMasterID('First_Name', $fetchScoringPlays['Scoring_Player']) . " ";
    echo getPlayerFieldByMasterID('Last_Name', $fetchScoringPlays['Scoring_Player']) . " ";
    echo $fetchScoringPlays['Distance'] . " Yard";
    echo returnScoringPlayTypeVerb($fetchScoringPlays['Play_Type'], $fetchScoringPlays['OSU_OPP']);

    if ($fetchScoringPlays['Play_Type'] === 'passTD') {

        echo getPlayerFieldByMasterID('First_Name', $fetchScoringPlays['From_Player']) . " ";
        echo getPlayerFieldByMasterID('Last_Name', $fetchScoringPlays['From_Player']) . " ";
    }
    echo " (" . $fetchScoringPlays['Time_Left'] . " Remaining)";
    echo '&nbsp;&nbsp;<span id="', $fetchScoringPlays['Play_ID'], '" class="oi oi-circle-x removeScoringPlay" style="color: white"></span>';
    echo '</li>';
}

//Display OPP scoring play
function displayOPPScoringPlay($fetchScoringPlays, $oppName) {

    echo '<li class="list-group-item small">';
    echo $oppName . " ";
    echo $fetchScoringPlays['Distance'] . " Yard";
    echo returnScoringPlayTypeVerb($fetchScoringPlays['Play_Type'], $fetchScoringPlays['OSU_OPP']);

    if ($fetchScoringPlays['Play_Type'] === 'passTD') {

        echo getPlayerFieldByMasterID('First_Name', $fetchScoringPlays['From_Player']) . " ";
        echo getPlayerFieldByMasterID('Last_Name', $fetchScoringPlays['From_Player']) . " ";
    }
    echo " (" . $fetchScoringPlays['Time_Left'] . " Remaining)";
    echo '&nbsp;&nbsp;<span id="', $fetchScoringPlays['Play_ID'], '" class="oi oi-circle-x removeScoringPlay" style="color:red"></span>';
    echo '</li>';
}

//Display OSU scoring play - light options
function displayOSUScoringPlayLight($fetchScoringPlays) {

    echo getPlayerFieldByMasterID('First_Name', $fetchScoringPlays['Scoring_Player']) . " ";
    echo getPlayerFieldByMasterID('Last_Name', $fetchScoringPlays['Scoring_Player']) . " ";
    echo $fetchScoringPlays['Distance'] . " Yard";
    echo returnScoringPlayTypeVerb($fetchScoringPlays['Play_Type'], $fetchScoringPlays['OSU_OPP']);

    if ($fetchScoringPlays['Play_Type'] === 'passTD') {

        echo getPlayerFieldByMasterID('First_Name', $fetchScoringPlays['From_Player']) . " ";
        echo getPlayerFieldByMasterID('Last_Name', $fetchScoringPlays['From_Player']) . " ";
    }
    echo '&nbsp;&nbsp;<span id="', $fetchScoringPlays['Play_ID'], '" class="oi oi-circle-x removeScoringPlay" style="color:red"></span>';
}

//Display OPP scoring play - light options
function displayOPPScoringPlayLight($fetchScoringPlays, $oppName) {

    echo $oppName . " ";
    echo $fetchScoringPlays['Distance'] . " Yard";
    echo returnScoringPlayTypeVerb($fetchScoringPlays['Play_Type'], $fetchScoringPlays['OSU_OPP']);

    if ($fetchScoringPlays['Play_Type'] === 'passTD') {

        echo getPlayerFieldByMasterID('First_Name', $fetchScoringPlays['From_Player']) . " ";
        echo getPlayerFieldByMasterID('Last_Name', $fetchScoringPlays['From_Player']) . " ";
    }
    echo '&nbsp;&nbsp;<span id="', $fetchScoringPlays['Play_ID'], '" class="oi oi-circle-x removeScoringPlay" style="color:red"></span>';
}

function calculateGameFlowPoints($Score_Type, $Post_Points) {

    $points = 0;

    if ($Score_Type === 'passTD' || $Score_Type === 'rushTD' || $Score_Type === 'INT' || $Score_Type === 'fum' || $Score_Type === 'KR' || $Score_Type === 'PR') {
        $points = 6 + $Post_Points;
    }
    if ($Score_Type === 'FG') {
        $points = 3;
    }
    if ($Score_Type === 'Saf') {
        $points = 2;
    }

    return $points;
}

function displayFlowScoreType($Score_Type) {

    if ($Score_Type === 'passTD' || $Score_Type === 'rushTD' || $Score_Type === 'INT' || $Score_Type === 'fum' || $Score_Type === 'KR' || $Score_Type === 'PR') {
        $type = 'TD';
    }
    if ($Score_Type === 'FG') {
        $type = 'FG';
    }
    if ($Score_Type === 'Saf') {
        $type = 'Saftey';
    }
    return $type;
}
