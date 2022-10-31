<nav class="navbar navbar-light flex-column align-items-start">
    <a class="ms-3 navbar-brand" href="#">
        <img src="assets/eggcracked_2.svg" alt="" width="50" height="50">
    </a>

    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-heart-fill"></i>
                Inici</a></li>
        <li class="nav-item"><a class="nav-link" href="explore.php"><i class="bi bi-hash"></i>Explorar</a>
        </li>
    </ul>
</nav>
<nav>
    <ul class="nav flex-column">
        <?php if (!empty($_SESSION["user"])) : ?>
            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="bi bi-person-fill"></i>
                    <?=$_SESSION["user"]["username"]?> </a></li>
        <?php else : ?>
            <li class="nav-item"><a class="nav-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i> Iniciar
                    sessió</a></li>
        <?php endif; ?>
    </ul>
</nav>
