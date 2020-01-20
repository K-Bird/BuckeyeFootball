<?php
include ("../../libs/db/common_db_functions.php");

$Master_ID = $_POST['Master_ID'];
?>
<div class="row" style="text-align: center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <?php echo " Height: " . getPlayerFieldByMasterID('Height', $Master_ID) . " | Weight: " . getPlayerFieldByMasterID('Weight', $Master_ID) . " | Hometown: " . getPlayerFieldByMasterID('Hometown', $Master_ID); ?>
                <br><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Year</th><th>Season Status</th><th>Position</th><th>Class</th><th>Offseason Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getPlayerData = db_query("SELECT * From `Players` WHERE Player_Master_ID ={$Master_ID} ORDER BY Season DESC");

                        while ($fetch_PlayerData = $getPlayerData->fetch_assoc()) {

                            $DepthPOS = '';

                            if ($fetch_PlayerData['Depth'] === '0') {
                                
                            } else {
                                $DepthPOS = $fetch_PlayerData['Depth'];
                            }


                            echo '<tr>';
                            echo '<td>';
                            echo getSeason_Year($fetch_PlayerData['Season']);
                            echo '</td>';
                            echo '<td>';
                            echo $fetch_PlayerData['Team_Status'];
                            echo '</td>';
                            echo '<td>';
                            if (checkForStarter($fetch_PlayerData['Position'], $fetch_PlayerData['Depth']) === true) {
                                echo $fetch_PlayerData['Position'] . '*';
                            } else {
                                echo $fetch_PlayerData['Position'] . $DepthPOS;
                            }
                            echo '</td>';
                            echo '<td>';
                            echo $fetch_PlayerData['Class'];
                            echo '</td>';
                            echo '<td>';
                            echo $fetch_PlayerData['Post_Season_Status'];
                            echo '</td>';
                            echo '</tr>';
                        }
                        
                        $recruitNum = mysqli_num_rows(db_query("SELECT * FROM `recruits` WHERE Player_ID = '{$Master_ID}'"));
                        if ($recruitNum > 0) {
                            $getRecruitDetails = db_query("SELECT * FROM `recruits` WHERE Player_ID = '{$Master_ID}'");
                            $fetchRecruitDetails = $getRecruitDetails->fetch_assoc();
                            echo '<tr>';
                            echo '<td colspan="2">';
                            echo '<h5><span class="badge badge-secondary">' . $fetchRecruitDetails['Class'] . ' Recruiting Class </span></h5></td>' .
                                 '<td><h5><span class="badge badge-secondary">'. $fetchRecruitDetails['Stars'] . " Star Recruit - " . $fetchRecruitDetails['Score'] . '</div></h5></td>' .
                                 '<td colspan="2"><h5><span class="badge badge-secondary"> National Rank: ' .
                                 $fetchRecruitDetails['Nat_RK']. " | Position Rank: " .
                                 $fetchRecruitDetails['Pos_RK']. " | State Rank: " . 
                                 $fetchRecruitDetails['State_RK'] . "</div></h5></td>";
                            echo '</td>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>