<br>
<div class="row">
    <div class="col-lg-12">
        <h3>Manage Opponents</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table>
            <form id="addOppForm">
                <tr>
                    <td>
                        <input name="addOppSchool" class="form-control" placeholder="Enter New School" style="width: 400px">
                    </td>
                    <td>
                        <input name="addOppNickname" class="form-control" placeholder="Enter New Nickname" style="width: 200px">
                    </td>
                    <td>
                        <input name="addOppState" class="form-control" placeholder="Enter New State" style="width: 150px">
                    </td>
                    <td style="text-align: center">
                        <button id="addbOppStadium" class="btn btn-success" type="submit"><span class="oi oi-plus"></span></button>
                    </td>
                </tr>
            </form>
            <?php
            $getOppData = db_query("SELECT * FROM `opponents` ORDER BY School ASC");

            while ($fetchOppData = $getOppData->fetch_assoc()) {

                echo '<tr>';
                echo '<td><input class="form-control editListItem" data-id="' . $fetchOppData['Team_ID'] . '" data-idcol="Team_ID" data-table="opponents" data-datacol="School" placeholder="' . $fetchOppData['School'] . '" style="width: 400px"></td>';
                echo '<td><input class="form-control editListItem" data-id="' . $fetchOppData['Team_ID'] . '" data-idcol="Team_ID" data-table="opponents" data-datacol="Nickname" placeholder="' . $fetchOppData['Nickname'] . '" style="width: 200px"></td>';
                echo '<td><input class="form-control editListItem" data-id="' . $fetchOppData['Team_ID'] . '" data-idcol="Team_ID" data-table="opponents" data-datacol="" placeholder="' . $fetchOppData['State'] . '" style="width: 150px"></td>';
                echo '<td><button class="btn btn-danger removeOpp" data-id="' . $fetchOppData['Team_ID'] . '"><span class="oi oi-minus removeOpp" data-id="' . $fetchOppData['Team_ID'] . '"></span></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>
<br><br><br><br>