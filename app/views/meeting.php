<div class="container-fluid outside">
<button class="btn btn-default btn-block btn-lg mtg-start">Start Meeting</button>
<div class="row"><div class="timer"></div></div>
<?php foreach ($participants as $participant) { ?>
<div class="around">
    <div class="row">
        <div class="one col-xs-3">
            <img class="img-responsive" src="http://gravatar.com/avatar/<?php echo $participant->getGravatar() ?>?r=pg&d=retro&s=75">
        </div>
        <div class="two col-xs-6 well <?php echo $participant->getId()?>">
            <p class="text-center"><?php echo $participant->getFirstName() . $participant->getLastName() ?></p>
            <p class="small text-center"><?php echo $participant->getEmail() ?></p>
            <p class="text-center small">Tap to assign a task.</p>
        </div>
        <div class="three col-xs-3" data-timer"3600">
            <div class="time"></div>
        </div>
    </div>
    <div class="hidden due-date">
        <form id="<?php echo $participant->getId()?>" action="add_task.php">
            <div class="form-group">
                <input type="text" placeholder="Submit revised financials." name="task" class="form-control">
                <div class='input-group date' data-date-format="YYYY-MM-DD" id='datetimepicker2'>
                    <input type="text"  name="date_due" placeholder="Due Date" value="" class="form-control">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <button type="button" class="form-control btn btn-block btn-sm">Assign Deliverable</button>
            </div>
        </form>
    </div>
</div>
<?php } ?>

<footer><button class="btn btn-default btn-lg btn-block mtg-end disabled">End Meeting</button></footer>
</div>