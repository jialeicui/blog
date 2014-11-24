<div class="about">
    <ul class="about_ul">
        <?php foreach($link as $one): ?>
            <li>
                <a href="<?php echo $one->href; ?>" target="_blank">
                    <img src="<?php echo $one->img; ?>" class="about_img" title="<?php echo $one->name; ?>">
                </a>
            </li>
        <?php endforeach;?> 
    </ul>
</div>
