<br>
<div class="row">
    <div class="col-lg-12">
        <h3>Manage Big Ten Divisions</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="listInputTable">
            <tr>
                <td>
                    <input id="addb10divName" class="form-control" placeholder="Enter New Division">
                </td>
                <td style="text-align: left">
                    <button id="addb10div" class="btn btn-success"><span class="oi oi-plus"></span></button>
                </td>
            </tr>
            <?php
            $getb10divData = db_query("SELECT * FROM `b10_divisions` ORDER BY Div_Order ASC");

            while ($fetchb10divData = $getb10divData->fetch_assoc()) {

                echo '<tr>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchb10divData['Div_ID'] . '" data-idcol="Div_ID" data-table="b10_divisions" data-datacol="Div_Name" placeholder="' . $fetchb10divData['Div_Name'] . '"></td>';
                echo '<td><button class="btn btn-danger removeb10Div" data-id="' . $fetchb10divData['Div_ID'] . '"><span class="oi oi-minus removeb10div" data-id="' . $fetchb10divData['Div_ID'] . '"></span></button></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>