<div>
    <?php foreach ($articles as $one):?>
        <a href="<?php echo site_url('article/'.$one->id);?>"><?php echo $one->title; ?></a><br/>
    <?php endforeach;?>
</div>
