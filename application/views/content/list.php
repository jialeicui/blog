<div class="list-group">
    <?php foreach ($articles as $one):?>
        <a href="<?php echo site_url('article/'.$one->id);?>" class="list-group-item"><?php echo $one->title; ?></a>
    <?php endforeach;?>
</div>
