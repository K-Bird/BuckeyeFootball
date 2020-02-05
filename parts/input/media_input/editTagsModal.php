<?php
include ("../../../libs/db/common_db_functions.php");

$refreshType = $_GET['type'];

if ($refreshType === 'player') {
    $player_photo_ID = $_GET['playerID'];
}
if ($refreshType === 'game') {
    $game_photo_ID = $_GET['gameID'];
}
if ($refreshType === 'misc') {
    $misc_photo_ID = $_GET['miscID'];
}
?>
<div class="modal fade" id="editTagsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Tags</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                if ($refreshType === 'player') {
                    buildEditTagsBody($player_photo_ID, 'player');
                }
                if ($refreshType === 'game') {
                    buildEditTagsBody($game_photo_ID, 'game');
                }
                if ($refreshType === 'misc') {
                    buildEditTagsBody($misc_photo_ID, 'misc');
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
//recieve a tag category and display all the tags associated with images that ID is tagged in
function buildEditTagsBody($ID, $category) {


    $taggedPhotos = taggedPhotoIDs($ID, $category);

    echo '<ul class="list-group">';

    $i = 1;

    foreach ($taggedPhotos as $photoID) {

        $getPhotoDetails = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photoID}'");
        $fetchPhotoDetails = $getPhotoDetails->fetch_assoc();


        echo '<li class="list-group-item">';
        echo '<img class="playerPhoto" src="/buckeyefootball/libs/images/uploaded/' . $fetchPhotoDetails['Photo_Name'] . '.' . $fetchPhotoDetails['Extension'] . '" height=150 width=150>';

        if ($category === 'player') {
            echo '<div id="playerPhotoTags' . $i . '">';
            echo returnTags($photoID, 'player');
            echo '<br>Tag Player(s) In This Photo:&nbsp;&nbsp;
              <input category="text" class="form-control playerTagSearchDisplayed" id="editAddPlayerTagSearch', $i . '" data-num="', $i . '" data-photoID="' . $photoID . '" placeholder="Search for Player By Name"/>
              <div id="playerTagExistingResults' . $i . '" class="editAddPlayerTagResults" data-num="' . $i . '"></div>';
            echo '</li>';
        }
        if ($category === 'game') {
            echo '<div id="gamePhotoTags' . $i . '">';
            echo returnTags($photoID, 'game');
            echo '<br>Tag Game(s) In This Photo:&nbsp;&nbsp;
              <input id="gamesSearchExistingYear' . $i . '" category="text" class="form-control gameSearchFieldExisting" data-num="', $i . '" data-photoID="' . $photoID . '" placeholder="Search for Game By Year"/>
              <input id="gamesSearchExistingOpp' . $i . '" category="text" class="form-control gameSearchFieldExisting" data-num="', $i . '" data-photoID="' . $photoID . '" placeholder="Search for Game By Opponent"/>
              <input id="gamesSearchExistingLoc' . $i . '" category="text" class="form-control gameSearchFieldExisting" data-num="', $i . '" data-photoID="' . $photoID . '" placeholder="Search for Game By Location"/>
            <div id="gameTagExistingResults' . $i . '" class="editAddGameTagResults" data-num="' . $i . '"></div>';
            echo '</li>';
        }
        if ($category === 'misc') {
            echo '<div id="miscPhotoTags' . $i . '">';
            echo returnTags($photoID, 'misc');
            echo '<br>Misc Tag(s) In This Photo:&nbsp;&nbsp;
              <input category="text" class="form-control miscTagSearchDisplayed" id="editAddMiscTagSearch', $i . '" data-num="', $i . '" data-photoID="' . $photoID . '" placeholder="Search for Misc By Date"/>
              <div id="miscTagExistingResults' . $i . '" class="editAddMiscTagResults" data-num="' . $i . '"></div>';
            echo '</li>';
        }

        $i++;
    }
    echo '</ul>';
}

//display tags for a given photo
function returnTags($photo_id, $category) {

    $getPhotoTags = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photo_id}'");
    $fetchPhototag = $getPhotoTags->fetch_assoc();

    if ($category === 'player') {
        $playerTags = $fetchPhototag['Player_Tags'];

        $eachTag = explode(',', $playerTags);

        foreach ($eachTag as $tag) {
            echo '<span class="badge badge-pill badge-secondary">';

            echo getPlayerFieldByMasterID('First_Name', $tag) . " " . getPlayerFieldByMasterID('Last_Name', $tag);

            echo '&nbsp;<span aria-hidden="true" data-photo="', $photo_id, '" id="ptag', $tag, '" class="playerTagRemove">&times;</span>';
            echo '</span>';
        }
    }
    if ($category === 'game') {
        $gameTags = $fetchPhototag['Game_Tags'];

        $eachTag = explode(',', $gameTags);

        foreach ($eachTag as $tag) {
            echo '<span class="badge badge-pill badge-secondary">';

            $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$tag}'");
            $fetchGameData = $getGameData->fetch_assoc();

            echo $fetchGameData['Date'] . " - (" . HomeAwayLookup($fetchGameData ['H_A']) . ") Vs " . opponentLookup($fetchGameData['Vs']);

            echo '&nbsp;<span aria-hidden="true" data-photo="', $photo_id, '" id="gtag', $tag, '" class="gameTagRemove">&times;</span>';
            echo '</span>';
        }
    }

    if ($category === 'misc') {
        $miscTags = $fetchPhototag['Misc_Tags'];

        $eachTag = explode(',', $miscTags);

        foreach ($eachTag as $tag) {
            echo '<span class="badge badge-pill badge-secondary">';

            echo returnMiscTagNameByIDphoto($tag);

            echo '&nbsp;<span aria-hidden="true" data-photo="', $photo_id, '" id="gtag', $tag, '" class="miscTagRemove">&times;</span>';
            echo '</span>';
        }
    }
}