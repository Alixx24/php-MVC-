<?php $this->include("panel.layouts.header"); ?>

    <link rel="stylesheet" href="<?php $this->asset('css/style-panel.css'); ?>" media="all" type="text/css">




<section class="mb-2 d-flex justify-content-between align-items-center">
    <h2 class="h4">Categories</h2>
    <a href="<?php $this->url('/category/create'); ?>" class="btn btn-sm btn-success">Create</a>
</section>

<section class="table-responsive">
    <table class="table table-striped table-">
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>description</th>
                <th>setting</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo $category['name']; ?></td>
                    <td><?php echo $category['description']; ?></td>
                    <td>
                        <a href="<?php $this->url('/category/edit/' . $category['id']); ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="<?php $this->url('/category/destroy/' . $category['id']); ?>" class="btn btn-danger btn-sm delete-link">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>





<script>
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

    document.querySelectorAll('.delete-link').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const href = link.getAttribute('href');

            showConfirm('آیا از حذف این دسته‌بندی مطمئن هستید؟', () => {
                window.location.href = href;
            });
        });
    });
</script>


<?php $this->include("panel.layouts.footer"); ?>