<?php
    function get_gly($showing)
    {
        if ($showing != 'show') {
            return 'glyphicon-eye-close';
        } else {
            return 'glyphicon-eye-open';
        }
    }
?>
<div>
    <?php foreach ($articles as $one):?>
        <div class="btn-group btn-group-justified article-list">
            <div class="btn-group">
                <a class="btn btn-default btn-artile" type="button" href="<?php echo site_url('article/'.$one->id);?>">
                    <?php echo $one->title; ?>
                </a>
            </div>
            <?php if (isset($loggedin) && $loggedin) { ?>
                <div class="btn-group">
                    <a class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-remove text-danger"></span>
                    </a>
                </div>
                <div class="btn-group">
                    <a class="btn btn-default" type="button" href="<?php echo site_url('status/'.$one->id);?>">
                        <span class="glyphicon text-danger <?php echo get_gly($one->status);?>"></span>
                    </a>
                </div>
                <div class="btn-group">
                    <a class="btn btn-default" type="button" href="<?php echo site_url('edit/'.$one->id);?>">
                        <span class="glyphicon glyphicon-edit text-success"></span>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php endforeach;?>
</div>
