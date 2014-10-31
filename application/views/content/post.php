<form class="form-signin" action="<?php echo site_url('post/submit');?>" accept-charset="utf-8" method="post">
    <input type="text" class="form-control article_title" placeholder="标题" name="title">
    <div class="row">
        <div class="col-xs-6">
            <textarea class="source article_content" name="content" rows="27">
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
            <button type="submit" class="btn btn-info pull-right">保存</button>
        </div>
        <section class="col-xs-6">
            <div class="preview"></div>
        </section>
    </div>
</form>

