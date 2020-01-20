<div class="col-lg-3">
    <span class="badge badge-dark">Change Input View:</span><br>
    <div id="player_view_group" class="btn-group" role="group">
        <button id="input_seasons_btn" type="button" class="btn btn-secondary <?php
        if ($Input_View === 'Seasons') {
            echo 'bg-dark';
        }
        ?>"  >Seasons</button>
        
        <button id="input_recruits_btn" type="button" class="btn btn-secondary <?php
        if ($Input_View === 'Recruits') {
            echo 'bg-dark';
        }
        ?>"  >Recruits</button>

        <button id="input_players_btn"type="button" class="btn btn-secondary <?php
        if ($Input_View === 'Players') {
            echo 'bg-dark';
        }
        ?>" >Players</button>

        <button id="input_stats_btn"type="button" class="btn btn-secondary <?php
        if ($Input_View === 'Stats') {
            echo 'bg-dark';
        }
        ?>" >Stats</button>
        <button id="input_lists_btn"type="button" class="btn btn-secondary <?php
        if ($Input_View === 'Lists') {
            echo 'bg-dark';
        }
        ?>" >Lists</button>
        <button id="input_media_btn"type="button" class="btn btn-secondary <?php
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
            include ('parts/input/input_control_decades.php');
        }
    
    ?>
</div>
<br><br>    