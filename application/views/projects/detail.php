<div>
  <div class="project_main">
    <div class="project_main_inner">
      <form action="<?php echo site_url('projects/submit');?>" method="post">
        <textarea class="project_blabla" name="blabla" rows="5"></textarea>
        <button type="submit" class="btn btn-primary pull-right">发布</button>
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
      </form>
      <ul>
      <?php foreach ($blabla_list as $iter):?>
        <li>
          <span><?php echo $iter->time;?></span>
          <span><?php echo $iter->content;?></span>
        </li>
      <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <?php include 'sidebar.php'; ?>
</div>