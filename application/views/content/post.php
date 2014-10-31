<form class="form-signin" action="<?php echo site_url('post/submit');?>" accept-charset="utf-8" method="post">
    <input type="text" class="form-control article_title" placeholder="标题" name="title">
    <div class="row full-height">
    <div class="col-xs-6 full-height">
    <textarea class="source full-height article_content" name="content">
以1G的大页为例

检查是否可以配置1G的大页

```
cat /proc/cpuinfo | grep pdpe1gb
```
如果有任何输出,说明可以配置

编辑`/etc/grub.conf`,在默认启动项的**kernel**行增加下面的代码

```
transparent_hugepage=never hugepagesz=1G hugepages=1 default_hugepagesz=1G
```

重启之后看结果

```
#  grep Huge /proc/meminfo
HugePages_Total:       1
HugePages_Free:        1
HugePages_Rsvd:        0
HugePages_Surp:        0
Hugepagesize:    1048576 kB
#
```
    </textarea>
    </div>
    <section class="col-xs-6 full-height">
        <div class="preview"></div>
    </section>
    </div>
    <!-- <button type="submit" class="btn btn-info pull-right">保存</button> -->
</form>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/8.2/styles/solarized_light.css">
<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/highlight.js/8.2/highlight.min.js"></script>
<script src="style/js/remarkable.js"></script>
<script src="style/js/edit.js"></script>
