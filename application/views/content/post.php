<form class="form-signin" action="<?php echo site_url('post/submit');?>" accept-charset="utf-8" method="post">
    <div class="row">
        <div class="col-lg-8">
        <input type="text" class="form-control" placeholder="Title" name="title" <?php if (isset($article_title)) {
            echo 'value="'.$article_title.'"';
        }?>>
    </div>
    <div class="col-lg-4">
        <input type="text" class="form-control" placeholder="Tag" name="tags" <?php if (isset($tags)) {
            echo 'value="'.$tags.'"';
        }?>>
    </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <textarea class="source article_content" name="content" rows="27">
<?php if (isset($article_content)) {echo $article_content;}?></textarea>
            <?php if (isset($article_id)) {echo '<input type="hidden" name="id" value="'.$article_id.'">';}?>
            <button type="submit" class="btn btn-info pull-right">保存</button>
        </div>
        <section class="col-xs-6">
            <div class="preview"></div>
        </section>
    </div>
</form>

