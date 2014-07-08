<div class="fluid-container">
        
    <div class="stats bg-primary">
        <div class="top"><h3 class="duration"><?php echo $meeting->duration . " mins." ?></h3><span class="times pull-right"><?php echo $meeting->getPrettyTime($meeting->getStart()) . "-" . $meeting->getPrettyTime($meeting->getEnd()) ?></span></div>
        <p class="title"><?php echo $meeting->getTitle() ?><p class="location"><?php echo $meeting->getLocation() ?></p></p>
    </div>
    <div class="people">
    <?php foreach ($participants as $participant){?>
        <div class="row">
            <div class="one col-xs-4 detGrav">
                <img class="img-responsive" src="http://gravatar.com/avatar/<?php echo $participant->getGravatar()?>?r=pg&d=retro&s=50">
            </div>
            <div class="col-xs-8 well tasklist">
                <div><p class="email inline"><?php echo $participant->getEmail()?></p><p>Spoke for <?php echo $participant->speaking_duration ?> mins.</p></div>
                <p class="text-center tiny">Assigned Tasks.</p>
                <?php $tasks = TaskManager::getTasks($meeting->getId(), $participant->getId());?>
                <?php foreach ($tasks as $task) { ?>
                <ul class="list-group hidden">
                    <li class="list-group-item"><?php echo $task->getDeliverable()?><span class="badge"><?php echo $task->getPrettyDate() ?></span></li>
                </ul>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>


 