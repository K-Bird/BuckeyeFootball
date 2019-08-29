<div class="col-lg-3">
    <span class="badge badge-dark">Change Input View:</span><br>
    <div id="player_view_group" class="btn-group" role="group">
        <button id="input_seasons_btn" type="button" class="btn btn-secondary <?php
        if ($Input_View === 'Seasons') {
            echo 'bg-dark';
        }
        ?>"  >Seasons</button>

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
    <span class="badge badge-dark">Select Season to Edit - Currently Editing: <?php echo $Input_Season; ?></span>
    <br>
    <div class="btn-group">
        <button id="decade2010s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            2010s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade2010s">
            <?php
            displayDecadeDropdownOptions('14', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade2000s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            2000s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade2010s">
            <?php
            displayDecadeDropdownOptions('13', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1990s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1990s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1990s">
            <?php
            displayDecadeDropdownOptions('12', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1980ss" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1980s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1980s">
            <?php
            displayDecadeDropdownOptions('11', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1970s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1970s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1970s">
            <?php
            displayDecadeDropdownOptions('10', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1960s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1960s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1960s">
            <?php
            displayDecadeDropdownOptions('9', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1950s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1950s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1950s">
            <?php
            displayDecadeDropdownOptions('8', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1940s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1940s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1940s">
            <?php
            displayDecadeDropdownOptions('7', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1930s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1930s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1930s">
            <?php
            displayDecadeDropdownOptions('6', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1920s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1920s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1920s">
            <?php
            displayDecadeDropdownOptions('5', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1910s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1910s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1910s">
            <?php
            displayDecadeDropdownOptions('4', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1900s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1900s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1900s">
            <?php
            displayDecadeDropdownOptions('3', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button id="decade1890s" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            1890s
        </button>
        <div class="dropdown-menu" aria-labelledby="decade1890s">
            <?php
            displayDecadeDropdownOptions('2', 'inputSeason');
            ?>
        </div>
    </div>
    <div class="btn-group">
        <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#addSeasonModal">Add Season</button>
    </div>
</div>
<br><br>    