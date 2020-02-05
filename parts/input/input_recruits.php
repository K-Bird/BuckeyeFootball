<div class="container-fluid">
    <br><br>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Class Offensive Counts
                </div>
                <div class="card-body">
                    <nobr>
                        <h5>
                            <span class="badge badge-secondary" >QBs: <?php echo returnPositionClassCount('QB', $Class_View) ?></span>
                            <span class="badge badge-secondary" >RBs: <?php echo returnPositionClassCount('RB', $Class_View) ?></span>
                            <?php
                            $depthType = returnSeasonDepth($Season_ID);

                            if ($depthType === 'spread') {
                                echo' <span class="badge badge-secondary" >H-Bs:';
                                echo returnPositionClassCount('H-B', $Class_View);
                                echo '</span>';
                            }
                            if ($depthType === 'iform') {
                                echo' <span class="badge badge-secondary" >FBs:';
                                echo returnPositionClassCount('FB', $Class_View);
                                echo '</span>';
                            }
                            ?>
                            <span class="badge badge-secondary" >WRs: <?php echo returnPositionClassCount('WR', $Class_View) ?></span>
                            <span class="badge badge-secondary" >TEs: <?php echo returnPositionClassCount('TE', $Class_View) ?></span>
                            <span class="badge badge-secondary" >OL: <?php echo returnPositionClassCount('OL', $Class_View) ?></span>
                        </h5>
                    </nobr>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    Class Defensive Counts
                </div>
                <div class="card-body">
                    <nobr>
                        <h5>
                            <span class="badge badge-secondary" >DL: <?php echo returnPositionClassCount('DL', $Class_View) ?></span>
                            <span class="badge badge-secondary" >LBs: <?php echo returnPositionClassCount('LB', $Class_View) ?></span>
                            <span class="badge badge-secondary" >CBs: <?php echo returnPositionClassCount('CB', $Class_View) ?></span>
                            <span class="badge badge-secondary" >SAFs: <?php echo returnPositionClassCount('S', $Class_View) ?></span>
                        </h5>
                    </nobr>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Class Special Teams Counts
                </div>
                <div class="card-body">
                    <nobr>
                        <h5>
                            <span class="badge badge-secondary" >K: <?php echo returnPositionClassCount('K', $Class_View) ?></span>
                            <span class="badge badge-secondary" >P: <?php echo returnPositionClassCount('P', $Class_View) ?></span>
                            <span class="badge badge-secondary" >LS: <?php echo returnPositionClassCount('LS', $Class_View) ?></span>
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
                    $getRosterCount = db_query("Select Count(*) as playerCount From `recruits` WHERE Class='{$Class_View}' ");
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
            <?php include ('parts/input/input_recruits_section.php'); ?>
        </div>
    </div>
</div>
<?php
//Returns the count of a recruiting class position group for a given season
function returnPositionClassCount($posGroup, $class) {

    if ($posGroup === 'OL') {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `recruits` WHERE (Position='{$posGroup}' OR Position='LT' OR Position='LG' OR Position='C' OR Position='RG' OR Position='RT') AND Class='{$class}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    } elseif ($posGroup === 'DL') {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `recruits` WHERE (Position='{$posGroup}' OR Position='DE' OR Position='DT') AND Class='{$class}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    } elseif ($posGroup === 'LB') {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `recruits` WHERE (Position='{$posGroup}' OR Position='OLB' OR Position='MLB') AND Class='{$class}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    } elseif ($posGroup === 'KR' || $posGroup === 'PR' || $posGroup === 'H') {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `recruits` WHERE (Position='{$posGroup}' OR Position_2='{$posGroup}') AND Class='{$class}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    } else {
        $getPositionCount = db_query("SELECT Count(*) as posCount FROM `recruits` WHERE Position='{$posGroup}' AND Class='{$class}'");
        $fetchPositionCount = $getPositionCount->fetch_assoc();
        $PositionCount = $fetchPositionCount['posCount'];
    }

    return $PositionCount;
}
