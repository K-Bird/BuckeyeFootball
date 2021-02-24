<br><br>
<div class="row">
    <div class="col-lg-1">

    </div>
    <div class="col-lg-1">

    </div>
    <div class="col-lg-1">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Passing</h6>
                <select class="form-control dataSelect">
                    <option></option>
                    <option value="passComp">Completions</option>
                    <option value="passAtt">Attempts</option>
                    <option value="passPerc">Completion Percentage</option>
                    <option value="passYards">Yards</option>
                    <option value="passTDs">TDs</option>
                    <option value="passINTs">INTs</option>
                </select> 
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Rushing</h6>
                <select class="form-control dataSelect">
                    <option></option>
                    <option value="rushAtt">Attempts</option>
                    <option value="rushYards">Yards</option>
                    <option value="rushTDs">TDs</option>
                    <option value="rushYPC">Yards Per Attempt</option>
                </select> 
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Recieving</h6>
                <select class="form-control dataSelect">
                    <option></option>
                    <option value="recRec">Receptions</option>
                    <option value="recYards">Yards</option>
                    <option value="recTDs">TDs</option>
                    <option value="recYPC">Yards Per Catch</option>
                </select> 
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Defense</h6>
                <select class="form-control dataSelect">
                    <option></option>
                    <option value="defTackles">Tackles</option>
                    <option value="defForLoss">For Loss</option>
                    <option value="defSacks">Sacks</option>
                    <option value="defINTs">INTs</option>
                    <option value="defINT_TDs">INT TDs</option>
                    <option value="defPassDef">Passes Defended</option>
                    <option value="defQBHurries">QB Hurries</option>
                    <option value="defFumbleRec">Fumble Recoveries</option>
                    <option value="defFumbleTDs">Fumble TDs</option>
                </select> 
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Returns</h6>
                <select class="form-control dataSelect">
                    <option></option>
                    <option value="KR_Att">Kick Return Attempts</option>
                    <option value="KR_Yards">Kick Return Yards</option>
                    <option value="KR_AVG">Kick Return Average</option>
                    <option value="KR_TDs">Kick Return TDs</option>
                    <option value="PR_Att">Punt Return Attempts</option>
                    <option value="PR_Yards">Punt Return Yards</option>
                    <option value="PR_AVG">Punt Return Average</option>
                    <option value="PR_TDs">Punt Return TDs</option>
                </select> 
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Kicking</h6>
                <select class="form-control dataSelect">
                    <option></option>
                    <option value="kickFGM">Field Goals Made</option>
                    <option value="kickFGA">Field Goals Attempts</option>
                    <option value="kickFGP">Field Goal Percentage</option>
                    <option value="kickLong">Longest Field Goal</option>
                </select> 
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Punting</h6>
                <select class="form-control dataSelect">
                    <option></option>
                    <option value="puntAtt">Punt Attempts</option>
                    <option value="puntYards">Punt Yards</option>
                    <option value="puntAVG">Punt Average</option>
                    <option value="puntLong">Longest Punt</option>
                </select> 
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Misc</h6>
                <select class="form-control dataSelect">
                    <option></option>
                    <option value="rushYardsQB">Rush Yards By QB</option>
                    <option value="rushTDsQB">Rush TDs By QB</option>
                </select> 
            </div>
        </div>
    </div>
    <div class="col-lg-1">

    </div>
    <div class="col-lg-1">

    </div>
</div>
<div class="row">
    <div class="col-lg-2">

    </div>
    <div class="col-lg-8">
        <br>
        <span class="badge badge-dark">Select Timeframe to View</span><br><br>
        <div id="DataYearSlider"></div>
        <?php 
        echo buildDecadeButtons('dataDecadeSlider'); 
        
        $currentYear = date("Y");
        $disableCurrentYearDecadeBtn  = '';
        
        if (seasonYearExists($currentYear) === 'FALSE') {
            $disableCurrentYearDecadeBtn = ' disabled ';
        }
        
        ?>
        
        <button class="btn btn-secondary dataDecadeSlider" data-decade="currYear" <?php echo $disableCurrentYearDecadeBtn; ?>>Current Season</button>
    </div>
    <div class="col-lg-2">

    </div>
</div>
