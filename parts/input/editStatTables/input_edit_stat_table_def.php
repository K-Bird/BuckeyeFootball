<form id="editDefStat" class="editStatForm">
    <table class="table">
        <thead>
            <tr>
                <td>
                    Tackles
                </td>
                <td>
                    For Loss
                </td>
                <td>
                    Sacks
                </td>
                <td>
                    INTs
                </td>
                <td>
                    INT TDs
                </td>
                <td>
                    Passes Defended
                </td>
                <td>
                    QB Hurries
                </td>
                <td>
                    Fumble Recoveries
                </td>
                <td>
                    Fumble TDs
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input class="form-control" type="text" name="defTak" placeholder="<?php echo $fetchPlayerGameStats['Tackles']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="defLoss" placeholder="<?php echo $fetchPlayerGameStats['ForLoss']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="defSack" placeholder="<?php echo $fetchPlayerGameStats['Sacks']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="defINTs" placeholder="<?php echo $fetchPlayerGameStats['INTs']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="defINTTDs" placeholder="<?php echo $fetchPlayerGameStats['INT_TDs']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="defPassDef" placeholder="<?php echo $fetchPlayerGameStats['PassDef']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="defQBHurries" placeholder="<?php echo $fetchPlayerGameStats['QBHurries']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="defFumRec" placeholder="<?php echo $fetchPlayerGameStats['FumbleRec']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="defFumTDs" placeholder="<?php echo $fetchPlayerGameStats['FumbleTDs']; ?>">
                </td>
            </tr>
            <tr style="text-align: center">
                <td colspan="9"><button class="btn btn-success" type="submit">Update Stats</button></td>
        <input type="hidden" name="GM_ID" value="<?php echo $GameID ?>">
        <input type="hidden" name="Player_ID" value="<?php echo $PlayerID ?>">
        <input type="hidden" name="statCategory" value="<?php echo $Category ?>">
        </tr>
        </tbody>
    </table>
</form>