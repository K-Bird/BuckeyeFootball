<ul class="nav nav-pills nav-justified" id="mediaTopNav" role="tablist">
    <li class="nav-item">
        <a id="photo-tab-mainnav" class="nav-link" data-toggle="tab" href="#inputPhotoTab" role="tab">Manage Photos</a>
    </li>
    <li class="nav-item">
        <a id="video-tab-mainnav" class="nav-link" data-toggle="tab" href="#inputVideoTab" role="tab">Manage Videos</a>
    </li>
    <li class="nav-item">
        <a id="social-tab-mainnav" class="nav-link" data-toggle="tab" href="#inputSocialTab" role="tab">Manage Social Media</a>
    </li>
    <li class="nav-item">
        <a id="web-tab-mainnav" class="nav-link" data-toggle="tab" href="#inputWebTab" role="tab">Manage Web</a>
    </li>
</ul>
<div class="tab-content" id="inputTopNavContent">
    <div class="tab-pane" id="inputPhotoTab" role="tabpanel"><?php include('inputPhotoTab.php'); ?></div>
    <div class="tab-pane" id="inputVideoTab" role="tabpanel"><?php include('inputVideoTab.php'); ?></div>
    <div class="tab-pane" id="inputSocialTab" role="tabpanel"><?php include('inputSocialTab.php'); ?></div>
    <div class="tab-pane" id="inputWebTab" role="tabpanel"><?php include('inputWebTab.php'); ?></div>

</div>