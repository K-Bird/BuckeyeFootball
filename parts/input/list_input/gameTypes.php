<br>
<div class="row">
    <div class="col-lg-12">
        <h3>Manage Game Types</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table>
            <form id="addGameTypeForm">
                <tr>
                    <td>
                        <input name="addGameTypeName" class="form-control" placeholder="Enter New Game Type Name" style="width: 400px">
                    </td>
                    <td>
                        <input name="addGameType" class="form-control" placeholder="Enter New Game Type" style="width: 200px">
                    </td>
                    <td>
                        <select id="addGameSubType" class="form-control" style="width: 150px">
                            <option value="Y">Y</option>
                            <option value="N">N</option>
                        </select>
                    </td>
                    <td style="text-align: center">
                        <button id="addGameType" class="btn btn-success" type="submit"><span class="oi oi-plus"></span></button>
                    </td>
                </tr>
            </form>
            <?php
            $getGMtypeData = db_query("SELECT * FROM `game_types` ORDER BY Name ASC");

            while ($fetchGMtypeData = $getGMtypeData->fetch_assoc()) {

                echo '<tr>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchGMtypeData['Type_ID'] . '" data-idcol="Type_ID" data-table="game_types" data-datacol="Name" placeholder="' . $fetchGMtypeData['Name'] . '" style="width: 400px"></td>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchGMtypeData['Type_ID'] . '" data-idcol="Type_ID" data-table="game_types" data-datacol="Type" placeholder="' . $fetchGMtypeData['Type'] . '" style="width: 200px"></td>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchGMtypeData['Type_ID'] . '" data-idcol="Type_ID" data-table="game_types" data-datacol="Sub_Type" placeholder="' . $fetchGMtypeData['Sub_Type'] . '" style="width: 150px"></td>';
                echo '<td><button class="btn btn-danger removeGMtype" data-id="' . $fetchGMtypeData['Type_ID'] . '"><span class="oi oi-minus removeGMtype" data-id="' . $fetchGMtypeData['Type_ID'] . '"></span></button></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>
<br><br><br><br>