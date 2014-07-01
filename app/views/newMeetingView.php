<form role="form" action="index.php/newmeeting" method="POST">
    <div class="container">
        <button class="btn btn-large col-xs-6 pull-left">Cancel</button>
        <button type="submit" class="btn btn-large btn-default col-xs-6">Done</button>
    </div>
    <div class="form-group">
        <label for="meeting-title">What:</label>
        <input id="meeting-title" value="<?php echo $title?>" class="form-control" type="text" name="title" placeholder="Meeting Title" required maxlength="100">
    </div>
    <div class="form-group">    
        <label for="meeting-location">Where:</label>
        <input id="meeting-location" value="<?php echo $location?>" class="form-control" type="text" name="location" placeholder="Meeting Location" required maxlength="100">
    </div>
    <label for="date">When:</label>
    <div class="form-group">
        <div class='input-group date' data-date-format="YYYY-MM-DD HH:MM" id='datetimepicker1'>
            <input id="date" type="text"  name="sched" value="<?php echo $sched?>" class="form-control">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    
    <label for="attendee">Who:</label>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-btn"><button class="btn btn-default empty"><span class="glyphicon glyphicon-minus"></span></button></span>
            <input type="email" id="attendee" class="form-control" name="attendee" placeholder="someone@example.com" required maxlength="100">
            <span class="input-group-btn less"><button class="btn btn-default more"><span class="glyphicon glyphicon-plus"></span></button></span>
        </div>
    </div>
    <input type="hidden" value="<?php $attendees ?>">
</form>
<div class="well hidden">
    <ul class="participants">
        <?php foreach ($attendees as $attendee) { ?>
            
        <li><?php echo $attendee->getEmail() ?> <button id="<?php echo $attendee->getId() ?>" class="btn btn-xs rm-participant">X</button></li>
        <?php } ?>
    </ul>
</div>