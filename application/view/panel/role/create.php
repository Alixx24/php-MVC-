<?php $this->include("panel.layouts.header"); ?>

<?php

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<form action="<?php $this->url('role/store'); ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <section class="form-group">
        <label for="name">name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="name ...">
    </section>

        <section class="form-group">
        <label for="description">Title</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="description ...">
    </section>
   

    <button type="submit" class="btn btn-primary">Create</button>
</form>

<?php $this->include("panel.layouts.footer"); ?>