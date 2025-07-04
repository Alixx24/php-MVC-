<?php $this->include("panel.layouts.header"); ?>


    <link rel="stylesheet" href="<?php $this->asset('css/style-panel.css'); ?>" media="all" type="text/css">


<section class="mb-2 d-flex justify-content-between align-items-center">
    <h2 class="h4">Articles</h2>
    <a href="<?php $this->url('article/create'); ?>" class="btn btn-sm btn-success">Create</a>
</section>

<section class="table-responsive">
<form method="POST" action="<?php $this->url('article/bulkDestroy'); ?>" id="bulkDeleteForm">
    <table class="table">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Body</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td><input type="checkbox" name="ids[]" value="<?php echo $article['id']; ?>" class="selectItem"></td>
                    <td><?php echo $article['id']; ?></td>
                    <td><?php echo $article['title']; ?></td>
                    <td><?php echo $article['cat_id']; ?></td>
                    <td><?php echo substr($article['body'], 0, 40) . " ..."; ?></td>
                    <td>
                        <a href="<?php $this->url('article/edit/' . $article['id']); ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="<?php $this->url('article/destroy/' . $article['id']); ?>" class="btn btn-danger btn-sm delete-link-article">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <button type="submit" class="btn btn-danger" id="bulkDeleteBtn">Delete Selected</button>
</form>

<script>
    // تایید حذف تکی (کد خودت)
    function showConfirm(message, onConfirm, onCancel) {
        const overlay = document.createElement('div');
        overlay.className = 'modal-overlay';

        const box = document.createElement('div');
        box.className = 'modal-box';

        const msg = document.createElement('p');
        msg.textContent = message;

        const btnConfirm = document.createElement('button');
        btnConfirm.textContent = 'بله، حذف کن';
        btnConfirm.className = 'modal-button confirm';

        const btnCancel = document.createElement('button');
        btnCancel.textContent = 'خیر، منصرف شدم';
        btnCancel.className = 'modal-button cancel';

        box.appendChild(msg);
        box.appendChild(btnConfirm);
        box.appendChild(btnCancel);
        overlay.appendChild(box);
        document.body.appendChild(overlay);

        btnConfirm.addEventListener('click', () => {
            document.body.removeChild(overlay);
            onConfirm();
        });

        btnCancel.addEventListener('click', () => {
            document.body.removeChild(overlay);
            if (onCancel) onCancel();
        });
    }

    // حذف تکی با تایید سفارشی
    document.querySelectorAll('.delete-link-article').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const href = link.getAttribute('href');

            showConfirm('آیا از حذف این دسته‌بندی مطمئن هستید؟', () => {
                window.location.href = href;
            });
        });
    });

    // انتخاب همه یا لغو انتخاب همه
    document.getElementById('selectAll').addEventListener('change', function() {
        let checked = this.checked;
        document.querySelectorAll('.selectItem').forEach(chk => {
            chk.checked = checked;
        });
    });

    // حذف گروهی با تایید سفارشی
    document.getElementById('bulkDeleteBtn').addEventListener('click', function(e) {
        e.preventDefault();

        // بررسی اینکه حداقل یک مورد انتخاب شده باشد
        const selected = document.querySelectorAll('.selectItem:checked');
        if (selected.length === 0) {
            alert('لطفاً حداقل یک مورد را انتخاب کنید.');
            return;
        }

        showConfirm('آیا از حذف موارد انتخاب شده مطمئن هستید؟', () => {
            document.getElementById('bulkDeleteForm').submit();
        });
    });
</script>

<?php $this->include("panel.layouts.footer"); ?>