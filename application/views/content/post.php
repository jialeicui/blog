<form class="form-signin" action="<?php echo site_url('post/submit');?>" accept-charset="utf-8" method="post">
    <input type="text" class="form-control article_title" placeholder="标题" name="title">
    <div class="row">
        <div class="col-xs-6">
            <textarea class="source article_content" name="content" rows="27"></textarea>
            <button type="submit" class="btn btn-info pull-right">保存</button>
        </div>
        <section class="col-xs-6">
            <div class="preview"></div>
        </section>
    </div>
</form>
