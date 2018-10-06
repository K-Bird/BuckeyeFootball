<form id="editPuntingStat" class="editStatForm">
    <table class="table">
        <thead>
            <tr>
                <td>
                    Punt Attempts
                </td>
                <td>
                    Punt Yards
                </td>
                <td>
                    Punt Long
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input class="form-control" type="text" name="puntAtt" placeholder="<?php echo $fetchPlayerGameStats['Att']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="puntYards" placeholder="<?php echo $fetchPlayerGameStats['Yards']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="puntLong" placeholder="<?php echo $fetchPlayerGameStats['LongPunt']; ?>">
                </td>
            </tr>
            <tr style="text-align: center">
                <td colspan="4"><button class="btn btn-success" type="submit">Update Stats</button></td>
        <input type="hidden" name="GM_ID" value="<?php echo $GameID ?>">
        <input type="hidden" name="Player_ID" value="<?php echo $PlayerID ?>">
        <input type="hidden" name="statCategory" value="<?php echo $Category ?>">
        </tr>
        </tbody>
    </table>
</form>