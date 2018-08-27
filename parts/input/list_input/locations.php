<br>
<div class="row">
    <div class="col-lg-12">
        <h3>Manage Locations</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table>
            <form id="addLocationForm">
                <tr>
                    <td>
                        <input name="addLocStadium" class="form-control" placeholder="Enter New Stadium" style="width: 400px">
                    </td>
                    <td>
                        <input name="addLocCity" class="form-control" placeholder="Enter New City" style="width: 200px">
                    </td>
                    <td>
                        <input name="addLocState" class="form-control" placeholder="Enter New State" style="width: 150px">
                    </td>
                    <td style="text-align: center">
                        <button id="addbLocStadium" class="btn btn-success" type="submit"><span class="oi oi-plus"></span></button>
                    </td>
                </tr>
            </form>
            <?php
            $getLocData = db_query("SELECT * FROM `locations` ORDER BY State ASC");

            while ($fetchLocData = $getLocData->fetch_assoc()) {

                echo '<tr>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchLocData['Loc_ID'] . '" data-idcol="Loc_ID" data-table="locations" data-datacol="Stadium" placeholder="' . $fetchLocData['Stadium'] . '" style="width: 400px"></td>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchLocData['Loc_ID'] . '" data-idcol="Loc_ID" data-table="locations" data-datacol="City" placeholder="' . $fetchLocData['City'] . '" style="width: 200px"></td>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchLocData['Loc_ID'] . '" data-idcol="Loc_ID" data-table="locations" data-datacol="State" placeholder="' . $fetchLocData['State'] . '" style="width: 150px"></td>';
                echo '<td><button class="btn btn-danger removeLoc" data-id="' . $fetchLocData['Loc_ID'] . '"><span class="oi oi-minus removeLoc" data-id="' . $fetchLocData['Loc_ID'] . '"></span></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>
<br><br><br><br>