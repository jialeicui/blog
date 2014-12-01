<?php
    function get_active($in, $exp) {
        if ($in == $exp) {
            return 'active';
        } else {
            return '';
        }
    }
?>

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
    <div class="project_sidebar">
        <div class="list-group project_menu">
          <a href="<?php echo site_url('projects/detail/'.$project_id);?>" class="list-group-item <?php echo get_active($active_menu, 'blabla');?>">流水账</a>
          <a href="<?php echo site_url('projects/timeline/'.$project_id);?>" class="list-group-item <?php echo get_active($active_menu, 'timeline');?>">时间轴</a>
          <a href="<?php echo site_url('projects/roadmap/'.$project_id);?>" class="list-group-item <?php echo get_active($active_menu, 'roadmap');?>">里程碑</a>
        </div>
    </div>
</div>