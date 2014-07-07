<div class="container-fluid outside">
    <button class="btn btn-default btn-block btn-lg return">Done</button>
    <div class="list-group">
        <?php foreach ($meetings as $meeting) { ?>
        <a href="http://jon.com/MVC/index.php/meeting?meeting_id=<?php echo $meeting->getId()?>" class="list-group-item"><?php echo $meeting->getPrettyDate() . " " . $meeting->getTitle()?>
            <span class="pull-right"><?php echo $meeting->duration . "mins"?></span>
        </a>
        <?php } ?>
    </div>
</div>
