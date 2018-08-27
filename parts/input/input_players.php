<div class="container-fluid">
    <br><br>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Offensive Counts
                </div>
                <div class="card-body">
                    <nobr>
                        <h5>
                            <span class="badge badge-secondary" >QBs: <?php echo returnPositionCount('QB', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >RBs: <?php echo returnPositionCount('RB', $Season_ID) ?></span>
                            <?php
                            $depthType = returnSeasonDepth($Season_ID);

                            if ($depthType === 'spread') {
                                echo' <span class="badge badge-secondary" >H-Bs:';
                                echo returnPositionCount('H-B', $Season_ID);
                                echo '</span>';
                            }
                            if ($depthType === 'iform') {
                                echo' <span class="badge badge-secondary" >FBs:';
                                echo returnPositionCount('FB', $Season_ID);
                                echo '</span>';
                            }
                            ?>
                            <span class="badge badge-secondary" >WRs: <?php echo returnPositionCount('WR', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >TEs: <?php echo returnPositionCount('TE', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >OL: <?php echo returnPositionCount('OL', $Season_ID) ?></span>
                        </h5>
                    </nobr>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    Defensive Counts
                </div>
                <div class="card-body">
                    <nobr>
                        <h5>
                            <span class="badge badge-secondary" >DL: <?php echo returnPositionCount('DL', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >LBs: <?php echo returnPositionCount('LB', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >CBs: <?php echo returnPositionCount('CB', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >SAFs: <?php echo returnPositionCount('S', $Season_ID) ?></span>
                        </h5>
                    </nobr>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Special Teams Counts
                </div>
                <div class="card-body">
                    <nobr>
                        <h5>
                            <span class="badge badge-secondary" >K: <?php echo returnPositionCount('K', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >P: <?php echo returnPositionCount('P', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >KR: <?php echo returnPositionCount('KR', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >PR: <?php echo returnPositionCount('PR', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >LS: <?php echo returnPositionCount('LS', $Season_ID) ?></span>
                            <span class="badge badge-secondary" >H: <?php echo returnPositionCount('H', $Season_ID) ?></span>
                        </h5>
                    </nobr>
                </div>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="card">
                <div class="card-header">
                    Total:
                </div>
                <div class="card-body">
                    <?php
                    $getRosterCount = db_query("Select Count(*) as playerCount From `players` WHERE Season='{$Season_ID}' ");
                    $fetchRosterCount = $getRosterCount->fetch_assoc();
                    $RosterCount = $fetchRosterCount['playerCount'];

                    echo '<h5>' . $RosterCount . '</h5>';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <?php include ('parts/input/input_players_section.php'); ?>
        </div>
    </div>
</div>
<?php include ('parts/input/input_modal_addPlayer.php'); ?>