<br>
<div class="row">
    <div class="col-lg-12">
        <h3>Manage Decades</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="listInputTable">
            <form id="addDecadeForm">
                <tr>
                    <td>
                        <input name="addDecadeName" class="form-control" placeholder="Enter New Decade">
                    </td>
                    <td>
                        <input name="addDecadeStart" class="form-control" placeholder="Enter Decade Start">
                    </td>
                    <td>
                        <input name="addDecadeEnd" class="form-control" placeholder="Enter Decade End">
                    </td>
                    <td style="text-align: left">
                        <button id="addDecade" class="btn btn-success" type="submit"><span class="oi oi-plus"></span></button>
                    </td>
                </tr>
            </form>
            <?php
            $getdecadeData = db_query("SELECT * FROM `decades` ORDER BY Decade_Row DESC");

            while ($fetchdecadeData = $getdecadeData->fetch_assoc()) {

                echo '<tr>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchdecadeData['Decade_Row'] . '" data-idcol="Decade_Row" data-table="decades" data-datacol="DecadeName" placeholder="' . $fetchdecadeData['DecadeName'] . '""></td>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchdecadeData['Decade_Row'] . '" data-idcol="Decade_Row" data-table="decades" data-datacol="DecadeStart" placeholder="' . $fetchdecadeData['DecadeStart'] . '"></td>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchdecadeData['Decade_Row'] . '" data-idcol="Decade_Row" data-table="decades" data-datacol="DecadeEnd" placeholder="' . $fetchdecadeData['DecadeEnd'] . '"></td>';
                echo '<td><button class="btn btn-danger removeDecade" data-id="' . $fetchdecadeData['Decade_Row'] . '"><span class="oi oi-minus removeDecade" data-id="' . $fetchdecadeData['Decade_Row'] . '"></span></button></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>