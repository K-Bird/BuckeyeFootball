<?php
$getInputPosGroupControl = db_query("SELECT * FROM `Controls` WHERE Control='Input_Player_PosGroup'");
$fetchInputPosGroupControl = $getInputPosGroupControl->fetch_assoc();
$InputPosGroup = $fetchInputPosGroupControl['Value'];
?>
<div class="card" style="text-align: center">
    <div class="card-header">
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <button type="button" class="btn btn-secondary" disabled>Manage:</button>
            </div>
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <button id="QB" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'QB') {
                    echo "active";
                }
                ?>">QBs</button>
                <button id="RB" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'RB') {
                    echo "active";
                }
                ?>">RBs</button>

                <?php
                $depthType = returnSeasonDepth($Season_ID);

                if ($depthType === 'spread') {

                    echo '<button id="H-B" type="button" class="btn btn-secondary chgPosGroup';
                    if ($InputPosGroup === 'H-B') {
                        echo "active";
                    }
                    echo '">H-Bs</button>';
                }
                if ($depthType === 'iform') {

                    echo '<button id="FB" type="button" class="btn btn-secondary chgPosGroup';
                    if ($InputPosGroup === 'FB') {
                        echo "active";
                    }
                    echo '">FB</button>';
                }
                ?>
                <button id="WR" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'WR') {
                    echo "active";
                }
                ?>">WRs</button>
                <button id="TE" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'TE') {
                    echo "active";
                }
                ?>">TEs</button>
                <button id="OL" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'OL') {
                    echo "active";
                }
                ?>">OL</button>
            </div>
            <div class="btn-group mr-2" role="group" aria-label="Second group">
                <button id="DL" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'DL') {
                    echo "active";
                }
                ?>">DL</button>
                <button id="LB" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'LB') {
                    echo "active";
                }
                ?>">LBs</button>
                <button id="CB" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'CB') {
                    echo "active";
                }
                ?>">CBs</button>
                <button id="S" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'S') {
                    echo "active";
                }
                ?>">Ss</button>
            </div>
            <div class="btn-group" role="group" aria-label="Third group">
                <button id="K" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'K') {
                    echo "active";
                }
                ?>">Ks</button>
                <button id="P" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'P') {
                    echo "active";
                }
                ?>">Ps</button>
                <button id="KR" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'KR') {
                    echo "active";
                }
                ?>">KRs</button>
                <button id="PR" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'PR') {
                    echo "active";
                }
                ?>">PRs</button>
                <button id="LS" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'LS') {
                    echo "active";
                }
                ?>">LSs</button>
                <button id="H" type="button" class="btn btn-secondary chgPosGroup <?php
                if ($InputPosGroup === 'H') {
                    echo "active";
                }
                ?>">Hs</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="playerInputTable" class="table">
            <thead>
                <tr>
                    <th>Responsibility</th>
                    <th>Primary Position</th>
                    <th>Secondary Position</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Number</th>
                    <th>Depth</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Class</th>
                    <th>Hometown</th>
                    <th>Season Status</th>
                    <th>Offseason Status</th>
                    <th></th>
                </tr>
            </thead>

            <?php
            $get_PlayerData = db_query(returnPosGroupSelectStatement($InputPosGroup, $Season_ID));

            while ($fetch_PlayerData = $get_PlayerData->fetch_assoc()) {

                $DepthPOS = '';

                if ($fetch_PlayerData['Depth'] === '0') {
                    
                } else {
                    $DepthPOS = $fetch_PlayerData['Depth'];
                }

                $POS_PorS = returnPos_PorS($InputPosGroup, $fetch_PlayerData['Position']);

                echo '<tr>';
                echo '<td>', $POS_PorS, '</td>';
                echo '<td>', displayAllPosSelect("Primary", $fetch_PlayerData['Position'],$fetch_PlayerData['Player_Row']), '</td>';

                if ($fetch_PlayerData['Position_2'] === '0' || $fetch_PlayerData['Position_2'] === '') {
                    echo '<td>-</td>';
                } else {

                    echo '<td style="display: flex">', displayAllPosSelect("Secondary", $fetch_PlayerData['Position_2'],$fetch_PlayerData['Player_Row']), '<button class="btn btn-danger removePlayer" data-playerRow="', $fetch_PlayerData['Player_Row'], '" data-PorS="Secondary"><span class="oi oi-minus removePlayer" data-playerRow="', $fetch_PlayerData['Player_Row'], '" data-PorS="Secondary"></span></button></td>';
                }
                echo '<td><input id="', $fetch_PlayerData['Player_Master_ID'], '" type="text" class="form-control playerFirstName" placeholder="', $fetch_PlayerData['First_Name'], '"></td>';
                echo '<td><input id="', $fetch_PlayerData['Player_Master_ID'], '" type="text" class="form-control playerLastName" placeholder="', $fetch_PlayerData['Last_Name'], '"></td>';
                echo '<td><input id="', $fetch_PlayerData['Player_Row'], '" type="text" class="form-control playerNum" placeholder="', $fetch_PlayerData['Number'], '" style="width: 50px"></td>';

                if ($POS_PorS === 'Primary') {
                    echo '<td><input id="', $fetch_PlayerData['Player_Row'], '" type="text" class="form-control playerDepth" data-PorS="', $POS_PorS, '" placeholder="', $fetch_PlayerData['Depth'], '" style="width: 50px"></td>';
                }
                if ($POS_PorS === 'Secondary') {
                    echo '<td><input id="', $fetch_PlayerData['Player_Row'], '" type="text" class="form-control playerDepth" data-PorS="', $POS_PorS, '" placeholder="', $fetch_PlayerData['Depth_2'], '" style="width: 50px"></td>';
                }

                echo '<td><input id="', $fetch_PlayerData['Player_Row'], '" type="text" class="form-control playerHt" placeholder="', $fetch_PlayerData['Height'], '" style="width: 60px"></td>';
                echo '<td><input id="', $fetch_PlayerData['Player_Row'], '" type="text" class="form-control playerWt" placeholder="', $fetch_PlayerData['Weight'], '" style="width: 75px"></td>';
                echo '<td>', displayPlayerClassSelect($fetch_PlayerData['Class'], $fetch_PlayerData['Player_Row']), '</td>';
                echo '<td><input id="', $fetch_PlayerData['Player_Master_ID'], '" type="text" class="form-control playerHometown" placeholder="', $fetch_PlayerData['Hometown'], '"></td>';
                echo  '<td>',playerStatusSelect($fetch_PlayerData['Team_Status'], $fetch_PlayerData['Player_Row']),'</td>';
                echo  '<td>',playerOffseasonSelect($fetch_PlayerData['Post_Season_Status'], $fetch_PlayerData['Player_Row']),'</td>';
                echo '<td><button class="btn btn-danger removePlayer" data-playerRow="', $fetch_PlayerData['Player_Row'], '" data-PorS="Primary"><span class="oi oi-minus removePlayer" data-playerRow="', $fetch_PlayerData['Player_Row'], '" data-PorS="Primary"></span></button></td>';
                echo '</tr>';
            }
            ?>

        </table>
        <?php
        if ($InputPosGroup === 'OL') {
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="', $InputPosGroup, '">Add ', $InputPosGroup, '</button>&nbsp;';
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="LT">Add LT</button>&nbsp;';
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="LG">Add LG</button>&nbsp;';
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="C">Add C</button>&nbsp;';
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="RG">Add RG</button>&nbsp;';
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="RT">Add RT</button>&nbsp;';
        } elseif ($InputPosGroup === 'DL') {
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="', $InputPosGroup, '">Add ', $InputPosGroup, '</button>&nbsp;';
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="DE">Add DE</button>&nbsp;';
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="DT">Add DT</button>&nbsp;';
        } elseif ($InputPosGroup === 'LB') {
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="', $InputPosGroup, '">Add ', $InputPosGroup, '</button>&nbsp;';
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="MLB">Add MLB</button>&nbsp;';
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="OLB">Add OLB</button>&nbsp;';
        } else {
            echo '<button class="btn btn-success addPlayer" data-season="', $Season_ID, '" data-pos="', $InputPosGroup, '">Add ', $InputPosGroup, '</button>';
        }
        ?>
        <button id="addSecondaryBtn" class="btn btn-success" data-toggle="modal" data-target="#addSecondaryModal">Add Secondary Position - <?php echo $InputPosGroup; ?></button>
    </div>
</div>
<?php
//Returns if a position group is primary or secondary
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
//Return a query that selects players by position group
function returnPosGroupSelectStatement($posGroup, $season) {

    if ($posGroup === 'OL') {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position='LT' OR Position='LG' OR Position='C' OR Position='RG' OR Position='RT' OR Position_2='{$posGroup}' OR Position_2='LT' OR Position_2='LG' OR Position_2='C' OR Position_2='RG' OR Position_2='RT') AND Season='{$season}' ORDER BY FIELD(Position, 'LT', 'LG', 'C', 'RG', 'RT', 'OL'), Last_Name ASC";
    } elseif ($posGroup === 'DL') {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position='DE' OR Position='DT' OR Position_2='DE' OR Position_2='DT') AND Season='{$season}' ORDER BY FIELD(Position, 'DE','DT','DL'), Last_Name ASC";
    } elseif ($posGroup === 'LB') {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position='OLB' OR Position='MLB' OR Position_2='OLB' OR Position_2='MLB') AND Season='{$season}' ORDER BY FIELD(Position, 'MLB', 'OLB', 'LB'), Last_Name ASC";
    } elseif ($posGroup === 'KR' || $posGroup === 'PR' || $posGroup === 'H') {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position_2='{$posGroup}') AND Season='{$season}' ORDER BY Last_Name ASC";
    } else {
        return "SELECT * FROM `players` WHERE (Position='{$posGroup}' OR Position_2='{$posGroup}')  AND Season='{$season}' ORDER BY Last_Name ASC";
    }
}
