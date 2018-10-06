<form id="editKickingStat" class="editStatForm">
    <table class="table">
        <thead>
            <tr>
                <td>
                    Extra Points Made
                </td>
                <td>
                    Extra Point Attempts
                </td>
                <td>
                    Field Goals Made
                </td>
                <td>
                    Field Goal Attempts
                </td>
                <td>
                    Field Goal Long
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input class="form-control" type="text" name="kickXPM" placeholder="<?php echo $fetchPlayerGameStats['XPM']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="kickXPA" placeholder="<?php echo $fetchPlayerGameStats['XPA']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="kickFGM" placeholder="<?php echo $fetchPlayerGameStats['FGM']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="kickFGA" placeholder="<?php echo $fetchPlayerGameStats['FGA']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="kickLong" placeholder="<?php echo $fetchPlayerGameStats['LongKick']; ?>">
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