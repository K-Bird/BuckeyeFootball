<?php

//Build Decades Select List
function displayDecadeSelect($currentDecade, $SeasonID) {

    echo '<select id="DecadeSelect" data-season="', $SeasonID, '" class="form-control" name="decadesSelect">';

    $getDecadeData = db_query("SELECT * FROM `decades`");
    while ($fetchDecadeData = $getDecadeData->fetch_assoc()) {

        echo '<option value="', $fetchDecadeData['Decade_Row'], '" ';

        if ($currentDecade === $fetchDecadeData['Decade_Row']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchDecadeData['DecadeName'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Conferences Select List
function displayConfSelect($currentConf, $SeasonID) {

    echo '<select id="ConfSelect" data-season="', $SeasonID, '" class="form-control" name="confSelect">';

    $getConfData = db_query("SELECT * FROM `conferences`");
    while ($fetchConfData = $getConfData->fetch_assoc()) {

        echo '<option value="', $fetchConfData['Conf_ID'], '" ';

        if ($currentConf === $fetchConfData['Conf_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchConfData['Conf_Name'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Division Select List
function displayDivSelect($currentDiv, $SeasonID) {

    echo '<select id="DivSelect" data-season="', $SeasonID, '" class="form-control" name="divSelect">';

    $getDivData = db_query("SELECT * FROM `b10_divisions`");
    while ($fetchDivData = $getDivData->fetch_assoc()) {

        echo '<option value="', $fetchDivData['Div_ID'], '" ';

        if ($currentDiv === $fetchDivData['Div_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchDivData['Div_Name'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Conf Champ Select List
function displayConfChampSelect($currentConfChamp, $SeasonID) {

    echo '<select id="ConfChampSelect" data-season="', $SeasonID, '" class="form-control" name="ConChampSelect">';


    echo '<option value="Champions" ';
    if ($currentConfChamp === 'Champions') {

        echo 'Selected="Selected"';
    }
    echo '>Champions</option>';

    echo '<option value="Shared" ';
    if ($currentConfChamp === 'Shared') {

        echo 'Selected="Selected"';
    }
    echo '>Shared</option>';

    echo '<option value="No" ';
    if ($currentConfChamp === 'No') {

        echo 'Selected="Selected"';
    }
    echo '>No</option>';

    echo '<option value="N/A" ';
    if ($currentConfChamp === 'N/A') {

        echo 'Selected="Selected"';
    }
    echo '>N/A</option>';

    echo '</select>';
}

//Build National Champ Select List
function displayNatChampSelect($currentNatChamp, $SeasonID) {

    echo '<select id="NatChampSelect" data-season="', $SeasonID, '" class="form-control" name="NatChampSelect">';


    echo '<option value="Yes" ';
    if ($currentNatChamp === 'Yes') {

        echo 'Selected="Selected"';
    }
    echo '>Yes</option>';

    echo '<option value="No" ';
    if ($currentNatChamp === 'No') {

        echo 'Selected="Selected"';
    }
    echo '>No</option>';

    echo '</select>';
}

//Build Head Coach Select List
function displayHCSelect($currentHC, $SeasonID) {

    echo '<select id="HCSelect" data-season="', $SeasonID, '" class="form-control" name="HCSelect">';

    $getHCData = db_query("SELECT * FROM `coaches` WHERE Type='HC'");
    while ($fetchHCData = $getHCData->fetch_assoc()) {

        echo '<option value="', $fetchHCData['Coach_ID'], '" ';

        if ($currentHC === $fetchHCData['Coach_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchHCData['First_Name'], " ", $fetchHCData['Last_Name'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Depth Chart Select List
function displayDepthSelect($currentDepth, $SeasonID) {

    echo '<select id="DepthSelect" data-season="', $SeasonID, '" class="form-control" name="DepthSelect">';


    echo '<option value="spread" ';
    if ($currentDepth === 'spread') {

        echo 'Selected="Selected"';
    }
    echo '>Spread</option>';

    echo '<option value="iform" ';
    if ($currentDepth === 'iform') {

        echo 'Selected="Selected"';
    }
    echo '>IForm</option>';

    echo '<option value="starters" ';
    if ($currentDepth === 'starters') {

        echo 'Selected="Selected"';
    }
    echo '>starters</option>';

    echo '<option value="none" ';
    if ($currentDepth === 'none') {

        echo 'Selected="Selected"';
    }
    echo '>None</option>';

    echo '</select>';
}

//Build Home/Away Select List
function displayHorAselect($currentHoA, $GM_ID) {

    echo '<select id="', $GM_ID, '" class="form-control gameHA" name="HoASelect">';

    echo '<option ';
    if ($currentHoA === '') {

        echo 'Selected="Selected"';
    }
    echo '></option>';
    echo '<option value="H" ';
    if ($currentHoA === 'H') {

        echo 'Selected="Selected"';
    }
    echo '>Home</option>';

    echo '<option value="A" ';
    if ($currentHoA === 'A') {

        echo 'Selected="Selected"';
    }
    echo '>Away</option>';

    echo '<option value="N" ';
    if ($currentHoA === 'N') {

        echo 'Selected="Selected"';
    }
    echo '>Neutral Site</option>';

    echo '<option value="B" ';
    if ($currentHoA === 'B') {

        echo 'Selected="Selected"';
    }
    echo '>Bye</option>';


    echo '</select>';
}

//Build Location Select List
function displayLocSelect($currentLoc, $GM_ID) {

    echo '<select id="', $GM_ID, '" class="selectpicker gameLoc" data-live-search="true" name="LocSelect">';

    $getLocData = db_query("SELECT * FROM `locations`");
    echo '<option></option>';
    while ($fetchLocData = $getLocData->fetch_assoc()) {

        echo '<option value="', $fetchLocData['Loc_ID'], '" ';

        if ($currentLoc === $fetchLocData['Loc_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchLocData['Stadium'] . " - " . $fetchLocData['State'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Opponents Select List
function displayOppSelect($currentOpp, $GM_ID) {

    echo '<select id="', $GM_ID, '" class="selectpicker gameOpp" data-live-search="true" name="OppSelect">';

    $getOppData = db_query("SELECT * FROM `opponents` ORDER BY School ASC");
    echo '<option></option>';
    while ($fetchOppData = $getOppData->fetch_assoc()) {

        echo '<option value="', $fetchOppData['Team_ID'], '" ';

        if ($currentOpp === $fetchOppData['Team_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchOppData['School'];
        echo '</option>';
    }

    echo '</select>';
}

//Build Game Type Select List
function displayGMTypeSelect($currentGMType, $GM_ID) {

    echo '<select id="', $GM_ID, '" class="selectpicker gameType" data-live-search="true" name="GMTypeSelect">';

    $getGMTypeData = db_query("SELECT * FROM `game_types`");
    while ($fetchGMTypeData = $getGMTypeData->fetch_assoc()) {

        echo '<option value="', $fetchGMTypeData['Type_ID'], '" ';

        if ($currentGMType === $fetchGMTypeData['Type_ID']) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo $fetchGMTypeData['Name'];
        echo '</option>';
    }

    echo '</select>';
}

function displayConfGMCheckbox($currentConfGM, $GM_ID) {

    echo '<input id="', $GM_ID, '" type="checkbox" class="form-control confGM"';

    if ($currentConfGM === 'Y') {
        echo 'checked="checked"';
    }

    echo 'style="width: 50px">';
}

function displayDivGMCheckbox($currentDivGM, $GM_ID) {

    echo '<input id="', $GM_ID, '" type="checkbox" class="form-control divGM"';

    if ($currentDivGM === 'Y') {
        echo 'checked="checked"';
    }

    echo 'style="width: 50px">';
}

function displayClassSelect($currentClass, $Player_Row) {

    echo '<select id="', $Player_Row, '" class="form-control playerClass" name="ClassSelect" style="width: 100px">';


    echo '<option value=" " ';
    if ($currentClass === '') {

        echo 'Selected="Selected"';
    }
    echo '></option>';
    echo '<option value="FR" ';
    if ($currentClass === 'FR') {

        echo 'Selected="Selected"';
    }
    echo '>FR</option>';

    echo '<option value="FR (RS)" ';
    if ($currentClass === 'FR (RS)') {

        echo 'Selected="Selected"';
    }
    echo '>FR (RS)</option>';

    echo '<option value="SO" ';
    if ($currentClass === 'SO') {

        echo 'Selected="Selected"';
    }
    echo '>SO</option>';

    echo '<option value="SO (RS)" ';
    if ($currentClass === 'SO (RS)') {

        echo 'Selected="Selected"';
    }
    echo '>SO (RS)</option>';

    echo '<option value="JR" ';
    if ($currentClass === 'JR') {

        echo 'Selected="Selected"';
    }
    echo '>JR</option>';

    echo '<option value="JR (RS)" ';
    if ($currentClass === 'JR (RS)') {

        echo 'Selected="Selected"';
    }
    echo '>JR (RS)</option>';

    echo '<option value="SR" ';
    if ($currentClass === 'SR') {

        echo 'Selected="Selected"';
    }
    echo '>SR</option>';

    echo '<option value="SR (RS)" ';
    if ($currentClass === 'SR (RS)') {

        echo 'Selected="Selected"';
    }
    echo '>SR (RS)</option>';

    echo '<option value="GR" ';
    if ($currentClass === 'GR') {

        echo 'Selected="Selected"';
    }
    echo '>GR</option>';


    echo '</select>';
}

function displayExistingPlayersSelect($season, $id) {

    $getExistingPlayers = db_query("SELECT * FROM `players` WHERE Season='{$season}'");

    echo '<select class="selectpicker" data-live-search="true" id="existingPlayer', $id, '">';

    while ($fetchExistingPlayers = $getExistingPlayers->fetch_assoc()) {

        echo '<option value="' . $fetchExistingPlayers['Player_Row'] . '">' . $fetchExistingPlayers['Position'] . ' - ' . $fetchExistingPlayers['First_Name'] . " " . $fetchExistingPlayers['Last_Name'] . '</option>';
    }

    echo '</select>';
}

function displayPosGroupSelect($InputPosGroup) {

    //OL,DL,LB positions
    if ($InputPosGroup === 'OL') {

        echo '<select id="secondaryPosSelect" class="form-control">';
        echo '<option value="OL">OL</option>';
        echo '<option value="LT">LT</option>';
        echo '<option value="LG">LG</option>';
        echo '<option value="C">C</option>';
        echo '<option value="RG">RG</option>';
        echo '<option value="RT">RT</option>';
        echo '</select>';
    } elseif ($InputPosGroup === 'DL') {

        echo '<select id="secondaryPosSelect" class="form-control">';
        echo '<option value="DL">DL</option>';
        echo '<option value="DE">DE</option>';
        echo '<option value="DT">DT</option>';
        echo '</select>';
    } elseif ($InputPosGroup === 'LB') {

        echo '<select id="secondaryPosSelect" class="form-control">';
        echo '<option value="LB">LB</option>';
        echo '<option value="MLB">MLB</option>';
        echo '<option value="OLB">OLB</option>';
        echo '</select>';
    } else {
        echo '<select id="secondaryPosSelect" hidden><option>N-A</option></select>';
    }
}

function displayDecadeDropdownOptions($DecadeID, $Class) {


    $get_seasonData = db_query("SELECT * FROM `seasons` ORDER BY Year DESC");
    while ($fetch_seasonData = $get_seasonData->fetch_assoc()) {
        if ($fetch_seasonData['Decade_ID'] === $DecadeID) {
            echo '<a id="', $fetch_seasonData['Year'], '" class="', $Class, ' dropdown-item" href="#">', $fetch_seasonData['Year'], '</a>';
        }
    }
}

function displayAllPosSelect($PorS, $currentPOS, $player_row) {

    echo '<select id="', $player_row, '" class="form-control playerPOS', $PorS, '" style="width: 75px">';

    $positionArray = returnPositionArray();

    foreach ($positionArray as $pos) {


        echo '<option value="', $pos, '"';
        if ($currentPOS === $pos) {
            echo 'selected';
        } echo '>', $pos, '</option>';
    }

    echo '</select>';
}

function returnPositionArray() {

    $posArray = array('QB', 'FB', 'H-B', 'RB', 'WR', 'TE', 'OL', 'LT', 'LG', 'C', 'RG', 'RT', 'DL', 'DE', 'DT', 'LB', 'OLB', 'MLB', 'CB', 'S', 'K', 'P', 'KR', 'PR', 'LS', 'H');
    return $posArray;
}

function getInputPlayerAddStat() {

    $getInputAddStat = db_query("SELECT * from `controls` WHERE Control='Input_Stats_Player'");
    $fetchInputAddStat = $getInputAddStat->fetch_assoc();
    $row = $fetchInputAddStat['Value'];
    return $row;
}

function displayOTCheckbox($currentOT, $GM_ID) {

    echo '<input id="', $GM_ID, '" type="checkbox" class="form-control OTGM"';

    if ($currentOT === 'Y') {
        echo 'checked="checked"';
    }

    echo 'style="width: 50px">';
}

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
function displayPlayerPhotoSelect($currentPlayer) {

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

        if ($currentPlayer === $tag) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo getPlayerFieldByMasterID('First_Name', $tag). " " . getPlayerFieldByMasterID('Last_Name', $tag);
        echo '</option>';
    }

    echo '</select>';
}

//Build Games With Photos Select List
function displayGamePhotoSelect($currentGame) {

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


    echo '<select id="gamePhotoSelect" class="selectpicker" data-live-search="true" name="playerPhotoSelect">';

    foreach ($taggedGames as $tag) {

        echo '<option value="', $tag, '" ';

        if ($currentGame === $tag) {

            echo 'Selected="Selected"';
        }
        
        $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$tag}'");
        $fetchGameData = $getGameData->fetch_assoc();

        echo '>';
        echo  $fetchGameData['Date'] . " - (" . HomeAwayLookup($fetchGameData ['H_A']) . ") Vs " . opponentLookup($fetchGameData['Vs']);
        echo '</option>';
    }

    echo '</select>';
}

//Build Misc Tags With Photos Select List
function displayMiscPhotoSelect($currentMisc) {

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

        if ($currentMisc === $tag) {

            echo 'Selected="Selected"';
        }

        echo '>';
        echo returnMiscTagNameByID($tag);
        echo '</option>';
    }

    echo '</select>';
}

//Build Games With Videos Select List
function displayGameVideoSelect($currentGame) {

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


    echo '<select id="gameVideoSelect" class="selectpicker" data-live-search="true" name="playerVideoSelect" style="width: 300px">';

    foreach ($taggedGames as $tag) {

        echo '<option value="', $tag, '" ';

        if ($currentGame === $tag) {

            echo 'Selected="Selected"';
        }
        
        $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$tag}'");
        $fetchGameData = $getGameData->fetch_assoc();

        echo '>';
        echo  $fetchGameData['Date'] . " - (" . HomeAwayLookup($fetchGameData ['H_A']) . ") Vs " . opponentLookup($fetchGameData['Vs']);
        echo '</option>';
    }

    echo '</select>';
}

function displayVideoMiscSelect() {

    $selectVidMiscTag = db_query("SELECT * from `ref_misc_video_tags`");

    echo '<select id="miscVideoSelect" class="selectpicker" data-live-search="true">';

    while ($fetchVidMiscTag = $selectVidMiscTag->fetch_assoc()) {


        echo '<option value="' . $fetchVidMiscTag['Tag_ID'] . '">' . $fetchVidMiscTag['Tag_Name'] . '</option>';
    }

    echo '</select>';
}