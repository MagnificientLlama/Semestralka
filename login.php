<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';

require './Header.php';
require './Navbar.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = UserQuery::create()->findOneByUsername($username);

    echo $username;
    echo $password;
    echo $user->getPassword();
    if (password_verify($password, $user->getPassword())) {

        $_SESSION['userID'] = $user->getUserid();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['userPrivilegy'] = $user->getPrivilegy();
        header('Location: index.php');
        die();

    } else {
        echo('Invalid user or password');
    }


}


?>

    <main class="container">
        <div clas="row justify-content-center">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <h2 class="my-4"> Login Page</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="row justify-content-center my-2">
                        <input type="text" name="username">
                    </div>
                    <div class="row justify-content-center my-2">
                        <input type="password" name="password">
                    </div>
                    <button class="btn btn-primary float-center mb-2" type="submit">Log in</button>
                </form>
            </div>
        </div>

        <div class ="btn btn-primary col-md-4 offset-md-4 mb-2">
            <a href="./Facebook/login.php" class="text-light">Log in with FB</a>
        </div>
        <div class ="btn btn-secondary col-md-4 offset-md-4 mb-2">
            <a href="./register.php" class="text-light">Create new account.</a>
        </div>

    </main>

<?php
require './Footer.php'
?>