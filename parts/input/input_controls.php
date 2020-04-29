<div class="col-lg-3">
    <span class="badge badge-dark">Change Input View:</span><br>
    <div id="player_view_group" class="btn-group" role="group">
        <button id="input_seasons_btn" type="button" data-view="Seasons" class="inputViewBtn btn btn-secondary <?php
        if ($Input_View === 'Seasons') {
            echo 'bg-dark';
        }
        ?>"  >Seasons</button>

        <button id="input_recruits_btn" type="button" data-view="Recruits" class="inputViewBtn btn btn-secondary <?php
        if ($Input_View === 'Recruits') {
            echo 'bg-dark';
        }
        ?>"  >Recruits</button>

        <button id="input_players_btn"type="button" data-view="Players" class="inputViewBtn btn btn-secondary <?php
        if ($Input_View === 'Players') {
            echo 'bg-dark';
        }
        ?>" >Players</button>

        <button id="input_stats_btn"type="button" data-view="Stats" class="inputViewBtn btn btn-secondary <?php
        if ($Input_View === 'Stats') {
            echo 'bg-dark';
        }
        ?>" >Stats</button>
                <button id="input_stats_btn"type="button" data-view="Box" class="inputViewBtn btn btn-secondary <?php
        if ($Input_View === 'Box') {
            echo 'bg-dark';
        }
        ?>" >Box Scores</button>
        <button id="input_box_scores_btn"type="button" data-view="Lists" class="inputViewBtn btn btn-secondary <?php
        if ($Input_View === 'Lists') {
            echo 'bg-dark';
        }
        ?>" >Lists</button>
        <button id="input_media_btn"type="button" data-view="Media" class="inputViewBtn btn btn-secondary <?php
        if ($Input_View === 'Media') {
            echo 'bg-dark';
        }
        ?>" >Media</button>
    </div>
</div>
<div class="col-lg-9">
    <?php
    if ($Input_View === 'Recruits') {
        echo '<h4><span class="badge badge-secondary">Select Recruiting Class to Manage:</span></h4>';
        echo displayRecruitClassSelect($Class_View);
    } else {
        echo '<span class="badge badge-dark">Select Season to Edit - Currently Editing: ', $Input_Season, '</span><br>';
        echo buildDecadeDropdowns('inputSeason');
    }
    ?>
    <div class="btn-group">
        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#addSeasonModal">Add Season</button>
    </div>
</div>
<br><br>    