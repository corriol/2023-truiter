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
        <div class="position-fixed col-2 d-flex flex-column justify-content-between h-75">
            <?php require "partials/sidebar.php" ?>
        </div>
        <div class="offset-2 col-6 border-start border-end border-1 p-4">
            <h2>Latest tweets</h2>

            <?php foreach ($tweets as $tweet) : ?>

                <p><?= $tweet->getAuthor()->getName() ?> (@<?= $tweet->getAuthor()->getUsername() ?>) - Creation
                    date: <?= $tweet->getCreatedAt()->format("Y-m-d") ?></p>
                <blockquote><p><?= $tweet->getText() ?></p></blockquote>
                <p>Like counter: <?= $tweet->getLikeCount() ?></p>
                <?php if (count($tweet->getAttachments()) > 0) :  ?>
                    <ul>
                        <?php foreach ($tweet->getAttachments() as $attachment) :  ?>
                            <li><?= $attachment->getAltText(); ?></li>
                        <?php endforeach;  ?>
                    </ul>
                <?php endif; ?>
                <hr/>
            <?php endforeach; ?>
        </div>
        <div class="col-4"></div>
    </div>
</main>
</body>
</html>