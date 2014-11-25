<div>
    <?php foreach ($tags as $iter) {?>
        <a href="<?php echo site_url('tags/show/'.$iter->name);?>"><?php echo $iter->name;?></a>
    <?php }?>

    <!-- <input type="text" class="form-control article_title" placeholder="标题" name="title"> -->
</div>