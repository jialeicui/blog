<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="臭豆儿的博客">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title;?></title>
        <base href="<?php echo base_url();?>" />
        <link rel="stylesheet" href="style/css/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/css/main.css">
    </head>
    <body>
        <div class="container col-xs-12 col-sm-6 col-md-8 col-md-offset-2 col-sm-offset-3">
            <div class="head_nav">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class=""><a href="<?php echo site_url('home');?>">Home</a></li>
                    <li role="presentation"><a href="<?php echo site_url('tags');?>">Tags</a></li>
                    <li role="presentation"><a href="<?php echo site_url('projects');?>">Project</a></li>
                    <li role="presentation"><a href="<?php echo site_url('about');?>">About</a></li>
                    <?php if (isset($loggedin) && $loggedin) { ?>
                        <li role="presentation" class="pull-right">
                            <a href="<?php echo site_url('log/logout');?>">
                                <div class="text-danger"><span class="glyphicon glyphicon-off"></span></div>
                            </a>
                        </li>
                        <li role="presentation" class="pull-right">
                            <a href="<?php echo site_url('post');?>">
                                <div class="text-admin"><span class="glyphicon glyphicon-plus"></span></div>
                            </a>
                        </li>
                    <?php }else{ ?>
                        <li role="presentation" class="pull-right">
                            <a href="<?php echo site_url('post');?>">
                                <div class="text-login"><span class="glyphicon glyphicon-log-in"></span></div>
                            </a>
                        </li>
                    <?php }?>
                </ul>
            </div>
            <div class='blog_main'>