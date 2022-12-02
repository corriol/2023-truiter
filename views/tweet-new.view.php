<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Tuiter: una grollera còpia de Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>

<main class="border-top mt-4 border-4 border-primary container">
    <div class="row">
        <div class="col-2 border d-flex flex-column justify-content-between">
            <?php require "partials/sidebar.php" ?>
        </div>
        <div class="col-7 border p-4">
            <h2>Nou truit</h2>

            <?php if (!empty($errors)) :?>
                <?php foreach ($errors as $error) :?>
                    <div class="alert alert-warning" role="alert">
                        <?= $error ?>
                    </div>
                <?php endforeach;?>
            <?php endif;?>

            <form class="mb-4" action="tweet-new-process.php" method="post" enctype="multipart/form-data" ?>
                <textarea class="form-control mb-2" name="text"
                          placeholder="Què passa, <?= $user["username"] ?>?"></textarea>
                <input type="file" class="form-control mb-2" name="file">
                <button class="btn btn-primary">Tweet</button>
            </form>
        </div>
        <div class="col-3 border"></div>
    </div>
</main>
</body>
</html>