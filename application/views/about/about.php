<div>
    <ul class="about_ul">
        <?php foreach($link as $one): ?>
            <li>
                <a href="<?php echo $one->href; ?>" target="_blank">
                    <img src="<?php echo $one->img; ?>" class="about_img">
                    <?php if($one->name) {?> <span class="about_name"><?php echo $one->name; ?></span><?php }?>
                </a>
            </li>
        <?php endforeach;?> 
    </ul>
</div>
