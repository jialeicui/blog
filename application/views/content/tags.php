<div>
    <?php foreach ($tags as $iter) {?>
        <div class="btn-group">
          <button type="button" class="btn btn-tags dropdown-toggle" data-toggle="dropdown"><?php echo $iter->name;?>
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javascript:if(confirm('确实要删除<?php echo $iter->name;?>标签么')){window.location='<?php echo site_url('tags/remove/'.$iter->name);?>'}">
              <span class="glyphicon glyphicon-remove"></span> 删除</a></li>
            <li><a href="<?php echo site_url('tags/show/'.$iter->name);?>">
              <span class="glyphicon glyphicon-filter"></span> 显示文章</a>
            </li>
          </ul>
        </div>
    <?php }?>

    <!-- <input type="text" class="form-control article_title" placeholder="标题" name="title"> -->
</div>
