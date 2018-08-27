<div class="row">  
    <div class="col-lg-1">
        <?php echo playerCompareAddYearsBtn(getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End), "Left"); ?>
    </div>
    <div class="col-lg-10">
        <table id="playerCompareTable" class="table table-sm" style="text-align: center">
            <thead>
                <?php
                echo playerCompareHeader($Player_Compare_Start, $Player_Compare_End);
                ?>
            </thead>
            <tbody>
                <?php
                echo playerCompareBody(getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End));
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-1">
        <?php echo playerCompareAddYearsBtn(getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End), "Right"); ?>
    </div>
</div>
