<!-- Modal -->
<div class="modal fade" id="addSeasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Season</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <select id="addSeasonSelect" class="custom-select custom-select-sm form-control">
                        <?php
                        $yearList = range(1890, date("Y"));
                        $seasonYears = array();

                        $getSeasonYears = db_query("Select * from `seasons`");
                        while ($fetchSeasonYears = $getSeasonYears->fetch_assoc()) {
                            array_push($seasonYears, $fetchSeasonYears['Year']);
                        }

                        $openYears = array_diff($yearList, $seasonYears);
                        arsort($openYears);

                        foreach ($openYears as $year) {
                            echo '<option value="', $year, '">', $year, '</option>';
                        }
                        ?>
                    </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button id="addSeasonBtn" type="button" class="btn btn-success">Add Year</button>
            </div>
        </div>
    </div>
</div>