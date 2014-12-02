<div>
  <div class="project_main">
    <div class="project_main_inner">
      <form action="<?php echo site_url('projects/submit');?>" method="post">
        <input type="text" class="form-control" placeholder="url" name="url">
        <p>描述</p>
        <textarea class="project_blabla" name="blabla" rows="5"></textarea>
        <button type="submit" class="btn btn-primary pull-right">发布</button>
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
      </form>
    </div>
  </div>
  <?php include 'sidebar.php'; ?>
</div>