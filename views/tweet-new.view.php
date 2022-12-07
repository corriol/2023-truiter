<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Truiter: una grollera còpia de Twitter</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>

<main class="mt-4 container">
    <div class="row">
        <div style="width: 220px" class="position-fixed col-2 d-flex flex-column justify-content-between h-75">
            <?php require "partials/sidebar.php" ?>
        </div>
        <div class="offset-2 col-6 border-start border-end border-1 p-4">
            <h2>Nou truit</h2>

            <?php if (!empty($errors)) : ?>
                <?php foreach ($errors as $error) : ?>
                    <div class="alert alert-warning" role="alert">
                        <?= $error ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form class="mb-4" action="tweet-new-process.php" method="post" enctype="multipart/form-data">
                <textarea class="form-control mb-2" name="text"
                          placeholder="Què passa, <?= $user->getUsername() ?>?"></textarea>
                <input type="file" class="form-control mb-2" name="file">
                <button type="submit" class="btn btn-primary">Tweet</button>
            </form>

        </div>
        <div class="col-4">
            <div class="input-group w-75 border border-2 border-secondary rounded">
                <button id="search-button" type="button" class="btn">
                    <label for="search-input"><i class="bi bi-search"></i></label>
                </button>
                <input id="search-input" type="search" id="form1" class="border-0 form-control"/>
            </div>
        </div>
    </div>
    </div>
</main>
</body>
</html>

