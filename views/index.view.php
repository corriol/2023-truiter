<h2>Latest tweets</h2>

<?php foreach ($tweets as $tweet) : ?>

    <p><?= $tweet->getAuthor()->getName() ?> (@<?= $tweet->getAuthor()->getUsername() ?>) - Creation
        date: <?= $tweet->getCreatedAt()->format("Y-m-d") ?></p>
    <blockquote><p><?= $tweet->getText() ?></p></blockquote>
    <p>Like counter: <?= $tweet->getLikeCount() ?></p>
    <?php if (count($tweet->getAttachments()) > 0) : ?>
        <ul>
            <?php foreach ($tweet->getAttachments() as $attachment) : ?>
                <li><?= $attachment->getAltText(); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <hr/>
<?php endforeach; ?>
