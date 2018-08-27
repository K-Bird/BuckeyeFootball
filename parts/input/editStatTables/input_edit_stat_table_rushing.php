<form id="editRushingStat" class="editStatForm">
    <table class="table">
        <thead>
            <tr>
                <td>
                    Attempts
                </td>
                <td>
                    Yards
                </td>
                <td>
                    TDs
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input class="form-control" type="text" name="rushAtt" placeholder="<?php echo $fetchPlayerGameStats['Att']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="rushYards" placeholder="<?php echo $fetchPlayerGameStats['Yards']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="rushTDs" placeholder="<?php echo $fetchPlayerGameStats['TDs']; ?>">
                </td>
            </tr>
            <tr style="text-align: center">
                <td colspan="3"><button class="btn btn-success" type="submit">Update Stats</button></td>
        <input type="hidden" name="GM_ID" value="<?php echo $GameID ?>">
        <input type="hidden" name="Player_ID" value="<?php echo $PlayerID ?>">
        <input type="hidden" name="statCategory" value="<?php echo $Category ?>">
        </tr>
        </tbody>
    </table>
</form>