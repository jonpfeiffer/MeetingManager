
<button onclick="location.href ='index.php/newmeeting'" class="btn-primary btn-large meeting-create center-block">New Meeting</button>
<h3 class="text-center">Your Upcoming Meetings</h3>
<hr>
<div class="lower-container container text-center">
    <?php foreach($currMeetings as $key) { ?>
        <a href="http://jon.com/MVC/index.php/meeting?meeting_id=<?php echo $key->getId()?>" title="<?php echo $key->getTitle()?>"class="btn btn-default btn-success meeting-button" id="<?php echo $key->getId()?>"><?php echo $key->getPrettyDate()?></a>
    <?php    } ?>
    
</div>
<footer><button class="btn btn-default btn-lg btn-block">Past Meetings</button></footer>