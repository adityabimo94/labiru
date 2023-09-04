<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (! empty($todos) && is_array($todos)): ?>

<?php foreach ($todos as $r): ?>

    <h3><?= esc($r['title']) ?></h3>

    <div class="main">
        <?= esc($r['description']) ?>
    </div>
    <p><a href="<?= site_url("admin/todos/delete/{$r['id']}") ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a></p>

<?php endforeach ?>

<?php else: ?>

<h3>No News</h3>

<p>Unable to find any news for you.</p>

<?php endif ?>