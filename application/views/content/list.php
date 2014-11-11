<div>
    <?php foreach ($articles as $one):?>
        <div class="btn-group btn-group-justified article-list">
            <div class="btn-group">
                <a class="btn btn-default btn-artile" type="button" href="<?php echo site_url('article/'.$one->id);?>"><?php echo $one->title; ?></a>
            </div>
            <?php if (isset($loggedin) && $loggedin) { ?>
                <div class="btn-group">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-remove text-danger"></span></button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-eye-close text-danger"></span></button>
                </div>
                <div class="btn-group">
                    <a class="btn btn-default" type="button" href="<?php echo site_url('edit/'.$one->id);?>"><span class="glyphicon glyphicon-edit text-success"></span></a>
                </div>
            <?php } ?>
        </div>
    <?php endforeach;?>
</div>
