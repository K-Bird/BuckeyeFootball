<form id="editPassingStat" class="editStatForm">
    <table class="table">
        <thead>
            <tr>
                <td>
                    Completions
                </td>
                <td>
                    Attempts
                </td>
                <td>
                    Yards
                </td>
                <td>
                    TDs
                </td>
                <td>
                    INTs
                </td>
                <td>
                    Rate
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input class="form-control" type="text" name="passComp" placeholder="<?php echo $fetchPlayerGameStats['Comp']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="passAtt" placeholder="<?php echo $fetchPlayerGameStats['Att']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="passYards" placeholder="<?php echo $fetchPlayerGameStats['Yards']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="passTDs" placeholder="<?php echo $fetchPlayerGameStats['TDs']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="passINTs" placeholder="<?php echo $fetchPlayerGameStats['INTs']; ?>">
                </td>
                <td>
                    <input class="form-control" type="text" name="passRate" placeholder="<?php echo $fetchPlayerGameStats['Rate']; ?>">
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