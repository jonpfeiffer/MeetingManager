<form role="form" id="meetingform" action="http://jon.com/MVC/index.php/newmeeting" method="POST">
    <div class="container">
        <button type="button" class="btn btn-large col-xs-6 pull-left">Cancel</button>
        <button type="button" class="btn btn-large btn-default col-xs-6 done">Done</button>
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
            <span class="input-group-btn"><button type="button" class="btn btn-default empty"><span class="glyphicon glyphicon-minus"></span></button></span>
            <input type="email" id="attendee" class="form-control" name="add-attendee" placeholder="someone@example.com" maxlength="100">
            <span class="input-group-btn less"><button type="button" class="btn btn-default more"><span class="glyphicon glyphicon-plus"></span></button></span>
        </div>
    </div>
    <input type="hidden" name="count" id="count" value="0">
<div class="well hidden participants">
    
</div>
</form>