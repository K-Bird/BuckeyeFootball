<form id="editRetStat" class="editStatForm">
    <table class="table">
        <thead>
            <tr>
                <td>
                    Kick Returns
                </td>
                <td>
                    Kick Return Yards
                </td>
                <td>
                    Kick Return TDs
                </td>
                <td>
                    Punt Returns
                </td>
                <td>
                    Punt Return Yards
                </td>
                <td>
                    Punt Return TDs
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input class="form-control" type="text" name="retKRRet" placeholder="<?php echo $fetchPlayerGameStats['KR_Ret']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="retKRYards" placeholder="<?php echo $fetchPlayerGameStats['KR_Yards']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="retKRRetTDs" placeholder="<?php echo $fetchPlayerGameStats['KR_TDs']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="retPRRet" placeholder="<?php echo $fetchPlayerGameStats['PR_Ret']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="retPRRetYards" placeholder="<?php echo $fetchPlayerGameStats['PR_Yards']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="retPRRetTDs" placeholder="<?php echo $fetchPlayerGameStats['PR_TDs']; ?>">
                </td>
            </tr>
            <tr style="text-align: center">
                <td colspan="6"><button class="btn btn-success" type="submit">Update Stats</button></td>
        <input type="hidden" name="GM_ID" value="<?php echo $GameID ?>">
        <input type="hidden" name="Player_ID" value="<?php echo $PlayerID ?>">
        <input type="hidden" name="statCategory" value="<?php echo $Category ?>">
        </tr>
        </tbody>
    </table>
</form>