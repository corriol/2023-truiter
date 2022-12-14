<h2>Nou truit</h2>

<?php if (!empty($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-warning" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<form class="mb-4" action="/tweet/new" method="post" enctype="multipart/form-data">
                <textarea class="form-control mb-2" name="text"
                          placeholder="Què passa, <?= $user->getUsername() ?>?"></textarea>
    <input type="file" class="form-control mb-2" name="file">
    <button type="submit" class="btn btn-primary">Tweet</button>
</form>
