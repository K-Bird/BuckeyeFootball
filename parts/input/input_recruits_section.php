<?php
$getRecruitLinks = db_query("SELECT * FROM `recruits` WHERE Class='{$Class_View}'");
$import = 'false';
while ($fetchClassLink = $getRecruitLinks->fetch_assoc()) {
    $checkLink = $fetchClassLink['Player_ID'];

    if ($checkLink != '0') {
        $import = 'true';
    }
}

if ($import === 'false') {
    echo '<button id="importClass" data-class="' . $Class_View . '" class="btn btn-primary">Import ' . $Class_View . ' Class</button>';
}
if ($import === 'true') {
    echo '<h4><span class="badge badge-secondary">Class Imported</span></h4>';
}
?>
<br><br>
<table id="recruitTable" class="table tablesorter">
    <thead>
        <tr>
            <th>National Rank</th>
            <th>State Rank</th>
            <th>Position Rank</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th>Height</th>
            <th>Weight</th>
            <th>Hometown</th>
            <th>Stars</th>
            <th>Score</th>
            <th>Player Link</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="list">
<?php
$get_RecruitData = db_query("SELECT * FROM `recruits` where `Class`='{$Class_View}' ORDER BY CAST(Nat_RK as UNSIGNED) ASC");

while ($fetch_RecruitData = $get_RecruitData->fetch_assoc()) {

    echo '<tr>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="Nat_RK" placeholder="', $fetch_RecruitData['Nat_RK'], '" style="width: 60px"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="State_RK" placeholder="', $fetch_RecruitData['State_RK'], '" style="width: 60px"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="Pos_RK" placeholder="', $fetch_RecruitData['Pos_RK'], '" style="width: 60px"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="First_Name" placeholder="', $fetch_RecruitData['First_Name'], '"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="Last_Name" placeholder="', $fetch_RecruitData['Last_Name'], '"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="Position" placeholder="', $fetch_RecruitData['Position'], '"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="Height" placeholder="', $fetch_RecruitData['Height'], '" style="width: 60px"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="Weight" placeholder="', $fetch_RecruitData['Weight'], '" style="width: 60px"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="Hometown" placeholder="', $fetch_RecruitData['Hometown'], '"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="Stars" placeholder="', $fetch_RecruitData['Stars'], '" style="width: 60px"></td>';
    echo '<td><input id="', $fetch_RecruitData['Recruit_ID'], '" type="text" class="form-control changeRecruit" data-field="Score" placeholder="', number_format($fetch_RecruitData['Score'], 4), '"></td>';

    echo '<td>';

    if ($fetch_RecruitData['Player_ID'] === '0') {
        echo '<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#recruitLinkModal" data-recid="',$fetch_RecruitData['Recruit_ID'],'">Link to Player</button>';
    } else {
        echo '<form action="playerDetails.php" method="POST">';
        echo '<button class="btn btn-secondary btn-sm" type="submit">View Player</button>';
        echo '<input type="hidden" name="Player_Master_ID" value="', $fetch_RecruitData['Player_ID'], '"/>';
        echo '</form>';
    }
    echo '</td>';
    echo '<td><button id="', $fetch_RecruitData['Recruit_ID'], '" class="btn btn-danger removeRecruit">Remove Recruit</button></td>';
    echo '</tr>';
}
?>
    </tbody>
</table>
<br>
<button id="addRecruitBtn" class="btn btn-success" data-class="<?php echo $Class_View; ?>">Add Recruit to <?php echo $Class_View; ?> Class</button>
<br>
<br>
<div id="recruitAlerts"></div>

<div id="recruitLinkModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Link Recruit to Player</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input id="linkRecruitSearch" class="form-control" type="text" placeholder="Search By First and Last Name" data-recid="" />
          <div id="linkRecruitSearchResults"></div>
      </div>
    </div>
  </div>
</div>