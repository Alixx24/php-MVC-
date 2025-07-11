<?php $this->include("panel.layouts.header"); ?>

<form action="<?php $this->url('article/update/'.$article['id']); ?>" method="post">
    <section class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?php echo $article['title']; ?>" placeholder="title ...">
    </section>
    <section class="form-group">
        <label for="cat_id">Category</label>
        <select class="form-control" id="cat_id" name="cat_id">
        <?php foreach ($categories as $category) { ?>
            <option value="<?php echo $category['id'] ?>" <?php if($article['cat_id'] == $category['id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
            <?php } ?>
        </select>
    </section>
    
<?php
global $base_url;

foreach ($articleImg as $img) {
    $imgUrl = htmlspecialchars($base_url . $img['filename']);
    $imgId = $img['id'];  
    ?>
    <div class="image-wrapper" style="display:inline-block; position:relative; margin:10px;">
        <img src="<?= $imgUrl ?>" alt="Article Image" style="max-width:100px;">
        <button class="delete-image" data-id="<?= htmlspecialchars($imgId) ?>" 
            style="position:absolute; top:0; right:0; background:#f00; color:#fff; border:none; border-radius:50%; width:20px; height:20px; cursor:pointer;">×</button>
    </div>
    <?php
}
?>


<section class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" id="body" name="body" rows="5"><?php echo htmlspecialchars($article['body']); ?></textarea>
</section>
<button type="submit" class="btn btn-primary">Update</button>
</form>
<script>
    document.querySelectorAll('.delete-image').forEach(button => {
    button.addEventListener('click', function () {
        const imgId = this.getAttribute('data-id');
        if (!imgId) {
            alert('شناسه عکس یافت نشد!');
            return;
        }

        if (confirm('آیا مطمئن هستید که می‌خواهید این عکس را حذف کنید؟')) {
            const xhr = new XMLHttpRequest();
            const relativeUrl = '/article/imageDelete';
            const url = '<?= rtrim($base_url, '/') ?>' + relativeUrl;

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const data = JSON.parse(xhr.responseText);
                        if (data.success) {
                            this.parentElement.remove();
                        } else {
                            alert('حذف موفق نبود! ' + (data.message || ''));
                        }
                    } else {
                        alert('خطا در ارتباط با سرور');
                    }
                }
            };

            xhr.send(JSON.stringify({ id: imgId }));
        }
    });
});

</script>




<?php $this->include("panel.layouts.footer"); ?>