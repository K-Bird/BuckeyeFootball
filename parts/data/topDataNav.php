<ul class="nav nav-pills nav-justified" id="dataTopNav" role="tablist">
    <li class="nav-item">
        <a id="program-tab-mainnav" class="nav-link" data-toggle="tab" href="#dataProgramTab" role="tab">Program</a>
    </li>
    <li class="nav-item">
        <a id="leaders-tab-mainnav" class="nav-link" data-toggle="tab" href="#dataLeadersTab" role="tab">Statistical Leaders</a>
    </li>
    <li class="nav-item">
        <a id="explore-tab-mainnav" class="nav-link" data-toggle="tab" href="#dataExploreTab" role="tab">Explore</a>
    </li>
</ul>
<div class="tab-content" id="dataTopNavContent">
    <div class="tab-pane" id="dataProgramTab" role="tabpanel"><?php include('dataProgramTab.php'); ?></div>
    <div class="tab-pane" id="dataLeadersTab" role="tabpanel"><?php include('dataLeadersTab.php'); ?></div>
    <div class="tab-pane" id="dataExploreTab" role="tabpanel"><?php include('dataExploreTab.php'); ?></div>
</div>