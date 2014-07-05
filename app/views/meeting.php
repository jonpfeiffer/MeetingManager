<div class="container-fluid outside">
<button class="btn btn-default btn-block btn-lg mtg-start">Start Meeting</button>
<?php foreach ($participants as $participant) { ?>
<div class="around row">
    <div class="one col-xs-3">
        <img class="img-responsive" src="http://gravatar.com/avatar/<?php echo $participant->getGravatar() ?>?r=pg&d=retro&s=75">
    </div>
    <div class="two col-xs-6 well">
        <p class="text-center"><?php echo $participant->getFirstName() . $participant->getLastName() ?></p>
        <p class="small text-center"><?php echo $participant->getEmail() ?></p>
        <p class="text-center small">Tap to edit</p>
    </div>
    <div class="three col-xs-3">
        <div class="time"></div>
    </div>
</div>
<div class="row hidden">
    <div class="form-group">
        <div class='input-group date' data-date-format="YYYY-MM-DD HH:MM" id='datetimepicker2'>
            <input id="date" type="hidden"  name="sched" value="<?php echo $sched?>" class="form-control">
            <input type="text"  name="task" placeholder="Complete Financial Reports" value="<?php echo $sched?>" class="form-control">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
</div>
<?php } ?>

<footer><button class="btn btn-default btn-lg btn-block mtg-end">End Meeting</button></footer>
</div>