<h2>Inici de sessió</h2>
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo array_shift($errors) ?>
    </div>

<?php endif; ?>
<form class="mb-4" method="post" action="login-process.php">

    <label for="username" class="form-label"">Usuari</label>
    <input id="username" class="form-control mb-2" name="username">

    <label for="password" class="form-label">Contrasenya</label>
    <input id="password" class="form-control mb-2" name="password">


    <button class="btn btn-primary">Iniciar sessió</button>
</form>

