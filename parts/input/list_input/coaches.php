<br>
<div class="row">
    <div class="col-lg-12">
        <h3>Manage Coaches</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table>
            <form id="addCoachForm">
                <tr>
                    <td>
                        <input name="addCoachFName" class="form-control" placeholder="Enter First Name" style="width: 400px">
                    </td>
                    <td>
                        <input name="addCoachLName" class="form-control" placeholder="Enter Last Name" style="width: 200px">
                    </td>
                    <td>
                        <select id="addCoachType" name="addCoachType" class="form-control" style="width: 150px">
                            <option value="HC">HC</option>
                        </select>
                    </td>
                    <td style="text-align: center">
                        <button id="addCoachBtn" class="btn btn-success" type="submit"><span class="oi oi-plus"></span></button>
                    </td>
                </tr>
            </form>
            <?php
            $getCoachData = db_query("SELECT * FROM `coaches` ORDER BY Coach_ID DESC");

            while ($fetchCoachData = $getCoachData->fetch_assoc()) {

                echo '<tr>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchCoachData['Coach_ID'] . '" data-idcol="Coach_ID" data-table="coaches" data-datacol="First_Name" placeholder="' . $fetchCoachData['First_Name'] . '" style="width: 400px"></td>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchCoachData['Coach_ID'] . '" data-idcol="Coach_ID" data-table="coaches" data-datacol="Last_Name" placeholder="' . $fetchCoachData['Last_Name'] . '" style="width: 200px"></td>';
                echo '<td><input class="form-control editListItem" data-id="' . $fetchCoachData['Coach_ID'] . '" data-idcol="Coach_ID" data-table="coaches" data-datacol="Type" placeholder="' . $fetchCoachData['Type'] . '" style="width: 150px"></td>';
                echo '<td><button class="btn btn-danger removeCoach" data-id="' . $fetchCoachData['Coach_ID'] . '"><span class="oi oi-minus removeCoach" data-id="' . $fetchCoachData['Coach_ID'] . '"></span></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>
<br><br><br><br>