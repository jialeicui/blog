<?php
    function get_active($in, $exp) {
        if ($in == $exp) {
            return 'active';
        } else {
            return '';
        }
    }
?>

<div class="project_sidebar">
  <div class="list-group project_menu">
    <a href="<?php echo site_url('projects/detail/'.$project_id);?>" class="list-group-item <?php echo get_active($active_menu, 'blabla');?>">流水账</a>
    <a href="<?php echo site_url('projects/links/'.$project_id);?>" class="list-group-item <?php echo get_active($active_menu, 'links');?>">链接</a>
    <a href="<?php echo site_url('projects/roadmap/'.$project_id);?>" class="list-group-item <?php echo get_active($active_menu, 'roadmap');?>">里程碑</a>
    <a href="<?php echo site_url('projects/timeline/'.$project_id);?>" class="list-group-item <?php echo get_active($active_menu, 'timeline');?>">时间轴</a>
    <a href="<?php echo site_url('projects/schedule/'.$project_id);?>" class="list-group-item <?php echo get_active($active_menu, 'schedule');?>">日程表</a>
    <a href="<?php echo site_url('projects/roadmap/'.$project_id);?>" class="list-group-item <?php echo get_active($active_menu, 'roadmap');?>">签到</a>
  </div>
</div>