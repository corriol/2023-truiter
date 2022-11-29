<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Truiter: una grollera còpia de Twitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>

<main class="border-top mt-4 border-4 border-primary container">
    <div class="row">
        <div class="col-2 border d-flex flex-column justify-content-between">

                <?php require "partials/sidebar.php" ?>

        </div>
        <div class="col-7 border p-4">
            <h2>Tendències</h2>
            <div class="card mb-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">#FreeUkraine</li>
                    <li class="list-group-item">#AnimalesFantasticos</li>
                    <li class="list-group-item">#morbiuslapelicula</li>
                </ul>
            </div>
        </div>
        <div class="col-3 border"></div>
    </div>
</main>
</body>
</html>