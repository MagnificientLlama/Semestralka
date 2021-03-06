<?php
session_start();
if (isset($_SESSION['username'])) {
    $navbarName = $_SESSION['username'];
}
$home = ''
?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Zeman's Books</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php if (isset($_SESSION['userPrivilegy'])): ?>
                    <?php if ($_SESSION['userPrivilegy'] >= 3): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Users.php">Users</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['userPrivilegy'] >= 2): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Management.php">Management</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (!isset($navbarName)): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($navbarName)): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="User.php"><?= $navbarName ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>