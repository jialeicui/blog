<div>
    <?php foreach ($projects as $one):?>
        <a href="<?php echo site_url('projects/detail/'.$one->id);?>"><?php echo $one->name; ?></a>
    <?php endforeach;?>
</div>