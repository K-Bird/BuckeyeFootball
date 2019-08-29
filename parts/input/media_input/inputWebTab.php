<div class="row">
    <div class="col-lg-4">

    </div>
    <div class="col-lg-3">
        <br><br>
        <table id="webLinksTable" class="table-sm table-hover text-center tablesorter">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="list">
                <?php
                $getLinks = db_query("SELECT * FROM `web_links`");
                while ($fetchLinks = $getLinks->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td class="web-sort-title">', $fetchLinks['Title'], '</td>';
                    echo '<td class="web-sort-cat">', $fetchLinks['Category'], '</td>';
                    echo '<td><a href="', $fetchLinks['URL'], '" target="_blank">Link</a></td>';
                    echo '<td><button class="btn btn-sm btn-danger removeWebLink" id="', $fetchLinks['Link_ID'], '">Remove</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-2">
        <br><br>
        <form id="addNewSite" class="form-horizontal" action="libs/ajax/addNewSite.php" method="post">
            Add a Website<br><br>
            Site Name <input class="form-control" type="text" name="SiteName" value="" size="50" /><br>
            Site Link <input class="form-control" type="text" name="SiteLink" value="" size="50" /><br>
            Site Category <input class="form-control" type="text" name="SiteCat" value="" size="50" /><br>
            <br>
            <button class="btn btn-success" type="submit">Add Site</button>
        </form>
    </div>
    <div class="col-lg-3">

    </div>
</div>
</div>