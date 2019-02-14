<br>
<div class="row">
    <div class="col-lg-12">
        <h3>Manage Conferences</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="listInputTable">
            <form id="addConfForm">
                <tr>
                    <td>
                        <input name="addConfName" class="form-control" placeholder="Enter Conference Name">
                    </td>
                    <td>
                        <input name="addConfAbbrev" class="form-control" placeholder="Enter Abbreviation">
                    </td>
                    <td style="text-align: left">
                        <button id="addConfBtn" class="btn btn-success" type="submit"><span class="oi oi-plus"></span></button>
                    </td>
                </tr>
            </form>
            <?php
            $getConfData = db_query("SELECT * FROM `conferences` ORDER BY Conf_Name ASC");

            while ($fetchConfData = $getConfData->fetch_assoc()) {

                echo '<tr>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchConfData['Conf_ID'] . '" data-idcol="Conf_ID" data-table="conferences" data-datacol="Conf_Name" placeholder="' . $fetchConfData['Conf_Name'] . '"></td>';
                echo '<td><input class="form-control  editListItem" data-id="' . $fetchConfData['Conf_ID'] . '" data-idcol="Conf_ID" data-table="conferences" data-datacol="Conf_Abbrev" placeholder="' . $fetchConfData['Conf_Abbrev'] . '"></td>';
                echo '<td><button class="btn btn-danger removeConf" data-id="' . $fetchConfData['Conf_ID'] . '"><span class="oi oi-minus removeConf" data-id="' . $fetchConfData['Conf_ID'] . '"></span></button></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>
<br><br><br><br>