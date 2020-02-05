<ul class="nav nav-pills nav-justified" id="mediaTopNav" role="tablist">
    <li class="nav-item">
        <a id="photo-tab-mainnav" class="nav-link" data-toggle="tab" href="#mediaPhotoTab" role="tab">Photos</a>
    </li>
    <li class="nav-item">
        <a id="video-tab-mainnav" class="nav-link" data-toggle="tab" href="#mediaVideoTab" role="tab">Videos</a>
    </li>
    <li class="nav-item">
        <a id="social-tab-mainnav" class="nav-link" data-toggle="tab" href="#mediaSocialTab" role="tab">Social Media</a>
    </li>
    <li class="nav-item">
        <a id="web-tab-mainnav" class="nav-link" data-toggle="tab" href="#mediaWebTab" role="tab">Web</a>
    </li>
</ul>
<div class="tab-content" id="mediaTopNavContent">
    <div class="tab-pane" id="mediaPhotoTab" role="tabpanel"><?php  include('mediaPhotoTab.php');  ?></div>
    <div class="tab-pane" id="mediaVideoTab" role="tabpanel"><?php include('mediaVideoTab.php');  ?></div>
    <div class="tab-pane" id="mediaSocialTab" role="tabpanel"><?php include('mediaSocialTab.php'); ?></div>
    <div class="tab-pane" id="mediaWebTab" role="tabpanel"><?php include('mediaWebTab.php'); ?></div>

</div>