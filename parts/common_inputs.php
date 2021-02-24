<?php

//Build Decades Select List
function displayDecadeSelect($current, $Season_ID) {

    echo '<select id="DecadeSelect" data-season="', $Season_ID, '" class="form-control" name="decadesSelect">';

    $getDecadeData = db_query("SELECT * FROM `decades`");
    while ($fetchDecadeData = $getDecadeData->fetch_assoc()) {

        echo '<option value="', $fetchDecadeData['Decade_Row'], '" ';

        if ($current === $fetchDecadeData['Decade_Row']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchDecadeData['DecadeName'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Conferences Select List
function displayConfSelect($current, $Season_ID) {

    echo '<select id="ConfSelect" data-season="', $Season_ID, '" class="form-control" name="confSelect">';

    $getConfData = db_query("SELECT * FROM `conferences`");
    while ($fetchConfData = $getConfData->fetch_assoc()) {

        echo '<option value="', $fetchConfData['Conf_ID'], '" ';

        if ($current === $fetchConfData['Conf_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchConfData['Conf_Name'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Division Select List
function displayDivSelect($current, $Season_ID) {

    echo '<select id="DivSelect" data-season="', $Season_ID, '" class="form-control" name="divSelect">';

    $getDivData = db_query("SELECT * FROM `b10_divisions`");
    while ($fetchDivData = $getDivData->fetch_assoc()) {

        echo '<option value="', $fetchDivData['Div_ID'], '" ';

        if ($current === $fetchDivData['Div_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchDivData['Div_Name'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Conf Champ Select List
function displayConfChampSelect($current, $Season_ID) {

    echo '<select id="ConfChampSelect" data-season="', $Season_ID, '" class="form-control" name="ConChampSelect">';


    echo '<option value="Champions" ';
    if ($current === 'Champions') {

        echo 'Selected="Selected"';
    }
    echo '>Champions</option>';

    echo '<option value="Shared" ';
    if ($current === 'Shared') {

        echo 'Selected="Selected"';
    }
    echo '>Shared</option>';

    echo '<option value="No" ';
    if ($current === 'No') {

        echo 'Selected="Selected"';
    }
    echo '>No</option>';

    echo '<option value="N/A" ';
    if ($current === 'N/A') {

        echo 'Selected="Selected"';
    }
    echo '>N/A</option>';

    echo '</select>';
}

//Build National Champ Select List
function displayNatChampSelect($current, $Season_ID) {

    echo '<select id="NatChampSelect" data-season="', $Season_ID, '" class="form-control" name="NatChampSelect">';


    echo '<option value="Yes" ';
    if ($current === 'Yes') {

        echo 'Selected="Selected"';
    }
    echo '>Yes</option>';

    echo '<option value="No" ';
    if ($current === 'No') {

        echo 'Selected="Selected"';
    }
    echo '>No</option>';

    echo '</select>';
}

//Build Head Coach Select List
function displayHCSelect($current, $Season_ID) {

    echo '<select id="HCSelect" data-season="', $Season_ID, '" class="form-control" name="HCSelect">';

    $getHCData = db_query("SELECT * FROM `coaches` WHERE Type='HC'");
    while ($fetchHCData = $getHCData->fetch_assoc()) {

        echo '<option value="', $fetchHCData['Coach_ID'], '" ';

        if ($current === $fetchHCData['Coach_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchHCData['First_Name'], " ", $fetchHCData['Last_Name'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Depth Chart Select List
function displayDepthSelect($current, $Season_ID) {

    echo '<select id="DepthSelect" data-season="', $Season_ID, '" class="form-control" name="DepthSelect">';


    echo '<option value="spread" ';
    if ($current === 'spread') {

        echo 'Selected="Selected"';
    }
    echo '>Spread</option>';

    echo '<option value="iform" ';
    if ($current === 'iform') {

        echo 'Selected="Selected"';
    }
    echo '>IForm</option>';

    echo '<option value="starters" ';
    if ($current === 'starters') {

        echo 'Selected="Selected"';
    }
    echo '>starters</option>';

    echo '<option value="none" ';
    if ($current === 'none') {

        echo 'Selected="Selected"';
    }
    echo '>None</option>';

    echo '</select>';
}

//Build Home/Away Select List
function displayHorAselect($current, $Game_ID) {

    echo '<select id="', $Game_ID, '" class="form-control gameHA" name="HoASelect">';

    echo '<option ';
    if ($current === '') {

        echo 'Selected="Selected"';
    }
    echo '></option>';
    echo '<option value="H" ';
    if ($current === 'H') {

        echo 'Selected="Selected"';
    }
    echo '>Home</option>';

    echo '<option value="A" ';
    if ($current === 'A') {

        echo 'Selected="Selected"';
    }
    echo '>Away</option>';

    echo '<option value="N" ';
    if ($current === 'N') {

        echo 'Selected="Selected"';
    }
    echo '>Neutral Site</option>';

    echo '<option value="B" ';
    if ($current === 'B') {

        echo 'Selected="Selected"';
    }
    echo '>Bye</option>';


    echo '</select>';
}

//Build Location Select List
function displayLocSelect($current, $Game_ID) {

    echo '<select id="', $Game_ID, '" class="selectpicker gameLoc" data-live-search="true" name="LocSelect">';

    $getLocData = db_query("SELECT * FROM `locations`");
    echo '<option></option>';
    while ($fetchLocData = $getLocData->fetch_assoc()) {

        echo '<option value="', $fetchLocData['Loc_ID'], '" ';

        if ($current === $fetchLocData['Loc_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchLocData['Stadium'] . " - " . $fetchLocData['State'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Opponents Select List
function displayOppSelect($current, $Game_ID) {

    echo '<select id="', $Game_ID, '" class="selectpicker gameOpp" data-live-search="true" name="OppSelect">';

    $getOppData = db_query("SELECT * FROM `opponents` ORDER BY School ASC");
    echo '<option></option>';
    while ($fetchOppData = $getOppData->fetch_assoc()) {

        echo '<option value="', $fetchOppData['Team_ID'], '" ';

        if ($current === $fetchOppData['Team_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchOppData['School'];
        echo '</option>';
    }

    echo '</select>';
}

//Build recruiting class select List
function displayRecruitClassSelect($current) {

    echo '<select id="', $current, '" class="selectpicker recruitClass" data-live-search="true" name="recruitClass">';

    $getRecruitData = db_query("SELECT DISTINCT Class FROM `recruits` ORDER BY Class ASC");
    echo '<option></option>';
    while ($fetchRecruitData = $getRecruitData->fetch_assoc()) {

        echo '<option value="', $fetchRecruitData['Class'], '" ';

        if ($current === $fetchRecruitData['Class']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchRecruitData['Class'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Game Type Select List
function displayGMTypeSelect($current, $Game_ID) {

    echo '<select id="', $Game_ID, '" class="selectpicker gameType" data-live-search="true" name="GMTypeSelect">';

    $getGMTypeData = db_query("SELECT * FROM `game_types`");
    while ($fetchGMTypeData = $getGMTypeData->fetch_assoc()) {

        echo '<option value="', $fetchGMTypeData['Type_ID'], '" ';

        if ($current === $fetchGMTypeData['Type_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchGMTypeData['Name'];
        echo '</option>';
    }

    echo '</select>';
}

//Build a checkbox indicating if a game was conference or not
function displayConfGMCheckbox($current, $Game_ID) {

    echo '<input id="', $Game_ID, '" type="checkbox" class="form-control confGM"';

    if ($current === 'Y') {
        echo 'checked="checked"';
    }

    echo 'style="width: 50px">';
}

//Build a checkbox indicating if a game was divisional or not
function displayDivGMCheckbox($current, $Game_ID) {

    echo '<input id="', $Game_ID, '" type="checkbox" class="form-control divGM"';

    if ($current === 'Y') {
        echo 'checked="checked"';
    }

    echo 'style="width: 50px">';
}

//Build a dropdown of player classes to choose from
function displayPlayerClassSelect($current, $player_row) {

    echo '<select id="', $player_row, '" class="form-control playerClass" name="ClassSelect" style="width: 100px">';

    echo '<option value=" " ';
    if ($current === '') {

        echo 'Selected="Selected"';
    }
    echo '></option>';
    echo '<option value="FR" ';
    if ($current === 'FR') {

        echo 'Selected="Selected"';
    }
    echo '>FR</option>';

    echo '<option value="FR (RS)" ';
    if ($current === 'FR (RS)') {

        echo 'Selected="Selected"';
    }
    echo '>FR (RS)</option>';

    echo '<option value="SO" ';
    if ($current === 'SO') {

        echo 'Selected="Selected"';
    }
    echo '>SO</option>';

    echo '<option value="SO (RS)" ';
    if ($current === 'SO (RS)') {

        echo 'Selected="Selected"';
    }
    echo '>SO (RS)</option>';

    echo '<option value="JR" ';
    if ($current === 'JR') {

        echo 'Selected="Selected"';
    }
    echo '>JR</option>';

    echo '<option value="JR (RS)" ';
    if ($current === 'JR (RS)') {

        echo 'Selected="Selected"';
    }
    echo '>JR (RS)</option>';

    echo '<option value="SR" ';
    if ($current === 'SR') {

        echo 'Selected="Selected"';
    }
    echo '>SR</option>';

    echo '<option value="SR (RS)" ';
    if ($current === 'SR (RS)') {

        echo 'Selected="Selected"';
    }
    echo '>SR (RS)</option>';

    echo '<option value="GR" ';
    if ($current === 'GR') {

        echo 'Selected="Selected"';
    }
    echo '>GR</option>';


    echo '</select>';
}

//Build a dropdown of players in a given season to choose from
function displayExistingPlayersSelect($Season_ID, $ID) {

    $getExistingPlayers = db_query("SELECT * FROM `players` WHERE Season='{$Season_ID}'");

    echo '<select class="selectpicker" data-live-search="true" id="existingPlayer', $ID, '">';

    echo '<option><option>';

    while ($fetchExistingPlayers = $getExistingPlayers->fetch_assoc()) {

        echo '<option value="' . $fetchExistingPlayers['Player_Row'] . '">' . $fetchExistingPlayers['Position'] . ' - ' . $fetchExistingPlayers['First_Name'] . " " . $fetchExistingPlayers['Last_Name'] . '</option>';
    }

    echo '</select>';
}

//Build a dropdown of positions based on given position group 
function displayPosGroupSelect($positionGroup) {

    //OL,DL,LB positions
    if ($positionGroup === 'OL') {

        echo '<select id="secondaryPosSelect" class="form-control">';
        echo '<option value="OL">OL</option>';
        echo '<option value="LT">LT</option>';
        echo '<option value="LG">LG</option>';
        echo '<option value="C">C</option>';
        echo '<option value="RG">RG</option>';
        echo '<option value="RT">RT</option>';
        echo '</select>';
    } elseif ($positionGroup === 'DL') {

        echo '<select id="secondaryPosSelect" class="form-control">';
        echo '<option value="DL">DL</option>';
        echo '<option value="DE">DE</option>';
        echo '<option value="DT">DT</option>';
        echo '</select>';
    } elseif ($positionGroup === 'LB') {

        echo '<select id="secondaryPosSelect" class="form-control">';
        echo '<option value="LB">LB</option>';
        echo '<option value="MLB">MLB</option>';
        echo '<option value="OLB">OLB</option>';
        echo '</select>';
    } else {
        echo '<select id="secondaryPosSelect" hidden><option>N-A</option></select>';
    }
}

//Build a set of decade dropdowns with existing years to choose from
function buildDecadeDropdowns($Class) {

    $getDecades = db_query("SELECT * FROM `decades` ORDER BY DecadeName DESC");
    while ($fetchDecades = $getDecades->fetch_assoc()) {

        echo '<div class="btn-group">';
        echo '<button id="decade2010s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        echo $fetchDecades['DecadeName'];
        echo '</button>';
        echo '<div class="dropdown-menu">';
        echo displayDecadeDropdownOptions($fetchDecades['Decade_Row'], $Class);
        echo '</div>';
        echo '</div>';
        echo '&nbsp;';
    }
}

//Build the years of a decade for decade dropdowns set
function displayDecadeDropdownOptions($ID, $Class) {

    $get_seasonData = db_query("SELECT * FROM `seasons` ORDER BY Year DESC");
    while ($fetch_seasonData = $get_seasonData->fetch_assoc()) {
        if ($fetch_seasonData['Decade_ID'] === $ID) {
            echo '<a id="', $fetch_seasonData['Year'], '" class="', $Class, ' dropdown-item" href="#">', $fetch_seasonData['Year'], '</a>';
        }
    }
}

//Build a set of decade buttons based on existing decades
function buildDecadeButtons($Class) {

    $getDecades = db_query("SELECT * FROM `decades` ORDER BY DecadeName ASC");
    while ($fetchDecades = $getDecades->fetch_assoc()) {

        echo '<button class="btn btn-secondary ', $Class, '" data-decade="', $fetchDecades['DecadeName'], '">', $fetchDecades['DecadeName'], '</button>&nbsp;';
    }
}

//Build a dropdown of all player positions
function displayAllPosSelect($PorS, $current, $player_row) {

    echo '<select id="', $player_row, '" class="form-control playerPOS', $PorS, '" style="width: 75px">';

    $positionArray = returnPositionArray();
    array_push($positionArray, 'DB');

    foreach ($positionArray as $pos) {


        echo '<option value="', $pos, '"';
        if ($current === $pos) {
            echo 'selected';
        } echo '>', $pos, '</option>';
    }

    echo '</select>';
}

//Build a checkbox indicating if a game went to overtime
function displayOTCheckbox($current, $Game_ID) {

    echo '<input id="', $Game_ID, '" type="checkbox" class="form-control OTGM"';

    if ($current === 'Y') {
        echo 'checked="checked"';
    }

    echo 'style="width: 50px">';
}

//Build a dropdown of conferences for filtering
function displayConfFilterSelect() {

    $selectUniqueConf = db_query("SELECT DISTINCT Conf from `seasons`");

    echo '<select id="confFilter" class="form-control">';
    echo '<option selected=selected>Filter Conference...</option>';
    echo '<option value="0">Show All Conferences</option>';

    while ($fetchUniqueConf = $selectUniqueConf->fetch_assoc()) {


        echo '<option value="' . $fetchUniqueConf['Conf'] . '">' . conferenceLookup($fetchUniqueConf['Conf']) . '</option>';
    }

    echo '</select>';
}

//Build a dropdown of divisions for filtering
function displayDivFilterSelect() {

    $selectUniqueDiv = db_query("SELECT DISTINCT Division from `seasons`");

    echo '<select id="divFilter" class="form-control">';
    echo '<option selected=selected>Filter Division...</option>';
    echo '<option value="0">Show All Divisions</option>';

    while ($fetchUniqueDiv = $selectUniqueDiv->fetch_assoc()) {


        echo '<option value="' . $fetchUniqueDiv['Division'] . '">' . divisionLookup($fetchUniqueDiv['Division']) . '</option>';
    }

    echo '</select>';
}

//Build a dropdown of conference championships for filtering
function displayConfChampFilterSelect() {

    $selectUniqueConfChamp = db_query("SELECT DISTINCT Conf_Champ from `seasons`");

    echo '<select id="confchampFilter" class="form-control">';
    echo '<option selected=selected>Filter Conf Champ...</option>';
    echo '<option value="0">Show All Values</option>';

    while ($fetchUniqueConfChamp = $selectUniqueConfChamp->fetch_assoc()) {


        echo '<option value="' . $fetchUniqueConfChamp['Conf_Champ'] . '">' . $fetchUniqueConfChamp['Conf_Champ'] . '</option>';
    }

    echo '</select>';
}

//Build a dropdown of national championship for filtering
function displayNationalChampFilterSelect() {

    $selectUniqueNationalChamp = db_query("SELECT DISTINCT NationalChamp from `seasons`");

    echo '<select id="natchampFilter" class="form-control">';
    echo '<option selected=selected>Filter National Champ...</option>';
    echo '<option value="0">Show All Values</option>';

    while ($fetchUniqueNationalChamp = $selectUniqueNationalChamp->fetch_assoc()) {


        echo '<option value="' . $fetchUniqueNationalChamp['NationalChamp'] . '">' . $fetchUniqueNationalChamp['NationalChamp'] . '</option>';
    }

    echo '</select>';
}

//Build a dropdown of player positions for filtering
function displayPlayerPositionFilterSelect() {

    $selectUniquePlayerPos = db_query("SELECT DISTINCT Position from `players`");

    echo '<select id="playerPosFilter" class="form-control">';
    echo '<option selected=selected>Filter Player Position...</option>';
    echo '<option value="0">Show All Positions</option>';

    while ($fetchUniquePlayerPos = $selectUniquePlayerPos->fetch_assoc()) {


        echo '<option value="' . $fetchUniquePlayerPos['Position'] . '">' . $fetchUniquePlayerPos['Position'] . '</option>';
    }

    echo '</select>';
}

//Build a dropdown of player classess for filtering
function displayPlayerClassFilterSelect() {

    $selectUniquePlayerClass = db_query("SELECT DISTINCT Class from `players`");

    echo '<select id="playerClassFilter" class="form-control">';
    echo '<option selected=selected>Filter Player Class...</option>';
    echo '<option value="0">Show All Classes</option>';

    while ($fetchUniquePlayerClass = $selectUniquePlayerClass->fetch_assoc()) {


        echo '<option value="' . $fetchUniquePlayerClass['Class'] . '">' . $fetchUniquePlayerClass['Class'] . '</option>';
    }

    echo '</select>';
}

//Build Players With Photos Select List
function displayPlayerPhotoSelect($Player_Master_ID) {

    $taggedPlayers = [];
    $getTaggedPlayers = db_query("SELECT * FROM `photos`");

    while ($fetchTaggedPlayers = $getTaggedPlayers->fetch_assoc()) {

        $tags = $fetchTaggedPlayers['Player_Tags'];
        $eachTag = explode(',', $tags);

        foreach ($eachTag as $tag) {
            array_push($taggedPlayers, $tag);
        }
        $taggedPlayers = array_unique($taggedPlayers);
    }


    echo '<select id="playerPhotoSelect" class="selectpicker" data-live-search="true" name="playerPhotoSelect">';

    foreach ($taggedPlayers as $tag) {

        echo '<option value="', $tag, '" ';

        if ($Player_Master_ID === $tag) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo getPlayerFieldByMasterID('First_Name', $tag) . " " . getPlayerFieldByMasterID('Last_Name', $tag);
        echo '</option>';
    }

    echo '</select>';
}

//Build Games With Photos Select List
function displayGamePhotoSelect($Game_ID) {

    $taggedGames = [];
    $getTaggedGames = db_query("SELECT * FROM `photos`");

    while ($fetchTaggedGames = $getTaggedGames->fetch_assoc()) {

        $tags = $fetchTaggedGames['Game_Tags'];
        $eachTag = explode(',', $tags);

        foreach ($eachTag as $tag) {
            array_push($taggedGames, $tag);
        }
        $taggedGames = array_unique($taggedGames);
    }


    echo '<select id="gamePhotoSelect" class="selectpicker" data-live-search="true" name="gamePhotoSelect">';

    foreach ($taggedGames as $tag) {

        echo '<option value="', $tag, '" ';

        if ($Game_ID === $tag) {

            echo 'Selected="Selected"';
        }

        $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$tag}'");
        $fetchGameData = $getGameData->fetch_assoc();

        echo '>';
        echo $fetchGameData['Date'] . " - (" . HomeAwayLookup($fetchGameData ['H_A']) . ") Vs " . opponentLookup($fetchGameData['Vs']);
        echo '</option>';
    }

    echo '</select>';
}

//Build Misc Tags With Photos Select List
function displayMiscPhotoSelect($Misc_ID_Photo) {

    $taggedMiscs = [];
    $getTaggedMiscs = db_query("SELECT * FROM `photos`");

    while ($fetchTaggedMiscs = $getTaggedMiscs->fetch_assoc()) {

        $tags = $fetchTaggedMiscs['Misc_Tags'];
        $eachTag = explode(',', $tags);

        foreach ($eachTag as $tag) {
            array_push($taggedMiscs, $tag);
        }
        $taggedMiscs = array_unique($taggedMiscs);
    }


    echo '<select id="miscPhotoSelect" class="selectpicker" data-live-search="true" name="miscPhotoSelect">';

    foreach ($taggedMiscs as $tag) {

        echo '<option value="', $tag, '" ';

        if ($Misc_ID_Photo === $tag) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo returnMiscTagNameByIDphoto($tag);
        echo '</option>';
    }

    echo '</select>';
}

//Build Games With Videos Select List
function displayGameVideoSelect() {

    $taggedGames = [];
    $getTaggedGames = db_query("SELECT * FROM `videos`");

    while ($fetchTaggedGames = $getTaggedGames->fetch_assoc()) {

        $tags = $fetchTaggedGames['Game_Tags'];
        $eachTag = explode(',', $tags);

        foreach ($eachTag as $tag) {
            array_push($taggedGames, $tag);
        }
        $taggedGames = array_unique($taggedGames);
    }


    echo '<select id="gameVideoSelect" class="selectpicker" data-live-search="true" name="gameVideoSelect" style="width: 300px">';
    echo '<option value=""></option>';
    foreach ($taggedGames as $tag) {

        echo '<option value="', $tag, '" ';

        $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$tag}'");
        $fetchGameData = $getGameData->fetch_assoc();

        echo '>';
        echo $fetchGameData['Date'] . " - (" . HomeAwayLookup($fetchGameData ['H_A']) . ") Vs " . opponentLookup($fetchGameData['Vs']);
        echo '</option>';
    }

    echo '</select>';
}

//Build videos with Misc category select list
function displayVideoMiscSelect() {

    $selectVidMiscTag = db_query("SELECT * from `ref_misc_video_tags`");

    echo '<select id="miscVideoSelect" class="selectpicker" data-live-search="true">';
    
    echo '<option value=""></option>';
    while ($fetchVidMiscTag = $selectVidMiscTag->fetch_assoc()) {


        echo '<option value="' . $fetchVidMiscTag['Tag_ID'] . '">' . $fetchVidMiscTag['Tag_Name'] . '</option>';
    }

    echo '</select>';
}

//Build player season status select
function playerStatusSelect($current, $player_row) {

    echo '<select id="', $player_row, '" class="form-control playerStatusSelect" style="width: 175px">';

    echo '<option value=""';
    if ($current === "") {
        echo 'selected';
    } echo '></option>';

    echo '<option value="On Team"';
    if ($current === "On Team") {
        echo 'selected';
    } echo '>On Team</option>';

    echo '<option value="Recruit"';
    if ($current === "Recruit") {
        echo 'selected';
    } echo '>Recruit</option>';

    echo '<option value="Transfer"';
    if ($current === "Transfer") {
        echo 'selected';
    } echo '>Transfer</option>';

    echo '<option value="Walk On"';
    if ($current === "Walk On") {
        echo 'selected';
    } echo '>Walk On</option>';

    echo '<option value="JUCO"';
    if ($current === "JUCO") {
        echo 'selected';
    } echo '>JUCO</option>';

    echo '<option value="Dismissed"';
    if ($current === "Dismissed") {
        echo 'selected';
    } echo '>Dismissed</option>';

    echo '<option value="Injured"';
    if ($current === "Injured") {
        echo 'selected';
    } echo '>Injured</option>';

    echo '</select>';
}

//Build player offeson status select
function playerOffseasonSelect($current, $player_row) {

    echo '<select id="', $player_row, '" class="form-control playerOffseasonSelect" style="width: 175px">';

    echo '<option value=""';
    if ($current === "") {
        echo 'selected';
    } echo '></option>';

    echo '<option value="Stayed"';
    if ($current === "Stayed") {
        echo 'selected';
    } echo '>Stayed</option>';

    echo '<option value="Transferred"';
    if ($current === "Transferred") {
        echo 'selected';
    } echo '>Transferred</option>';

    echo '<option value="Redshirt"';
    if ($current === "Redshirt") {
        echo 'selected';
    } echo '>Redshirt</option>';

    echo '<option value="Graduated"';
    if ($current === "Graduated") {
        echo 'selected';
    } echo '>Graduated</option>';

    echo '<option value="Left For Draft"';
    if ($current === "Left For Draft") {
        echo 'selected';
    } echo '>Left For Draft</option>';

    echo '<option value="Not On Team"';
    if ($current === "Not On Team") {
        echo 'selected';
    } echo '>Not On Team</option>';
    
    echo '<option value="Granted Extra Eligibility"';
    if ($current === "Granted Extra Eligibility") {
        echo 'selected';
    } echo '>Granted Extra Eligibility</option>';
    
    echo '<option value="Medical Red-Shirt"';
    if ($current === "Medical Red-Shirt") {
        echo 'selected';
    } echo '>Medical Red-Shirt</option>';
    echo '</select>';
}

//Build a dropdown of player season status for filtering
function displayPlayerStatusFilterSelect() {

    $selectUniquePlayerStatus = db_query("SELECT DISTINCT Team_Status from `players`");

    echo '<select id="playerStatusFilter" class="form-control">';
    echo '<option selected=selected>Filter Season Status...</option>';
    echo '<option value="0">Show All Statuses</option>';

    while ($fetchUniquePlayerStatus = $selectUniquePlayerStatus->fetch_assoc()) {


        echo '<option value="' . $fetchUniquePlayerStatus['Team_Status'] . '">' . $fetchUniquePlayerStatus['Team_Status'] . '</option>';
    }

    echo '</select>';
}

//Build a dropdown of player offseason status for filtering
function displayPlayerOffseasonFilterSelect() {

    $selectUniquePlayerOffseason = db_query("SELECT DISTINCT Post_Season_Status from `players`");

    echo '<select id="playerOffseasonFilter" class="form-control">';
    echo '<option selected=selected>Filter Season Offseason Status...</option>';
    echo '<option value="0">Show All Statuses</option>';

    while ($fetchUniquePlayerOffseason = $selectUniquePlayerOffseason->fetch_assoc()) {


        echo '<option value="' . $fetchUniquePlayerOffseason['Post_Season_Status'] . '">' . $fetchUniquePlayerOffseason['Post_Season_Status'] . '</option>';
    }

    echo '</select>';
}

//Build year selector grouped by decade
function buildYearSelector() {

    $getDecades = db_query("SELECT * FROM `decades` ORDER BY Decade_Row DESC");
    while ($fetchDecades = $getDecades->fetch_assoc()) {

        echo '<span class="badge badge-dark">' . $fetchDecades['DecadeName'] . '</span>&nbsp;';

        $getSeasons = db_query("SELECT * FROM `seasons` WHERE Decade_ID='{$fetchDecades['Decade_Row']}' ORDER BY Year ASC");
        $num_years = mysqli_num_rows($getSeasons);
        $i = 0;
        while ($fetchSeasons = $getSeasons->fetch_assoc()) {
            if (++$i === $num_years) {
                echo '<a href="#" class="boxYear" data-seasonID="',$fetchSeasons['Season_ID'],'">' . $fetchSeasons['Year'] . '</a>';
            } else {
                echo '<a href="#" class="boxYear" data-seasonID="',$fetchSeasons['Season_ID'],'">' . $fetchSeasons['Year'] . '</a>&nbsp;&middot;&nbsp;';
            }
        }
        echo '<br>';
    }
}
