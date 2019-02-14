<br>
<div class="row">
    <div class="col-lg-12">
        <h3>Manage Opponents</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="listInputTable">
            <form id="addOppForm">
                <tr>
                    <td>
                        <input name="addOppSchool" class="form-control" placeholder="Enter New School">
                    </td>
                    <td>
                        <input name="addOppNickname" class="form-control" placeholder="Enter New Nickname">
                    </td>
                    <td>
                        <input name="addOppState" class="form-control" placeholder="Enter New State">
                    </td>
                    <td style="text-align: left">
                        <button id="addbOppStadium" class="btn btn-success" type="submit"><span class="oi oi-plus"></span></button>
                    </td>
                </tr>
            </form>
            <?php
            $getOppData = db_query("SELECT * FROM `opponents` ORDER BY School ASC");

            while ($fetchOppData = $getOppData->fetch_assoc()) {

                echo '<tr>';
                echo '<td><input class="form-control editListItem" data-id="' . $fetchOppData['Team_ID'] . '" data-idcol="Team_ID" data-table="opponents" data-datacol="School" placeholder="' . $fetchOppData['School'] . '"></td>';
                echo '<td><input class="form-control editListItem" data-id="' . $fetchOppData['Team_ID'] . '" data-idcol="Team_ID" data-table="opponents" data-datacol="Nickname" placeholder="' . $fetchOppData['Nickname'] . '"></td>';
                echo '<td><input class="form-control editListItem" data-id="' . $fetchOppData['Team_ID'] . '" data-idcol="Team_ID" data-table="opponents" data-datacol="" placeholder="' . $fetchOppData['State'] . '"></td>';
                echo '<td><button class="btn btn-danger removeOpp" data-id="' . $fetchOppData['Team_ID'] . '"><span class="oi oi-minus removeOpp" data-id="' . $fetchOppData['Team_ID'] . '"></span></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>
<br><br><br><br>