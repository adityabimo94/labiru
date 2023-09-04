

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="<?= base_url("admin/todo/edit/{$data['id']}") ?>" method="post">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <input type="input" name="title" value="<?= $data['title'] ?>">
    <br>

    <label for="body">Text</label>
    <textarea name="description" cols="45" rows="4"><?= data['description'] ?></textarea>
    <br>

    <input type="submit" name="submit" value="Update news item">
</form>