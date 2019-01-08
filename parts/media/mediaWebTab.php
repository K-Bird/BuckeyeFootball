<div class="row">
    <div class="col-lg-12">
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
                    echo '<td class="web-sort-title">',$fetchLinks['Title'],'</td>';
                    echo '<td class="web-sort-cat">',$fetchLinks['Category'],'</td>';
                    echo '<td><a href="',$fetchLinks['URL'],'" target="_blank">Link</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>