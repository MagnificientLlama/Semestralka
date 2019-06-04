<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';

require './Header.php';
require './Navbar.php';
$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if (!$name) {
        array_push($errors, 'Please enter your username.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Please enter your email.');
    }
    if (!$password) {
        array_push($errors, 'Please enter your password');
    } else if (!$password == $confirmPassword) {
        array_push($errors, 'Your passwords do not match.');
    }
    if (empty($errors)) {
        $check = UserQuery::create()->select('username')->findOneByUsername($name);
        $check2 = UserQuery::create()->select('email')->findOneByEmail($email);
        if (!empty($check)) {
            array_push($errors, 'This user already exists');
        } else if (!empty($check2)) {
            array_push($errors, 'This email is already in use');
        } else {
            $hashedPswd = password_hash($password, PASSWORD_DEFAULT);
            $user = new User();
            $user->setUsername($name);
            $user->setEmail($email);
            $user->setPassword($hashedPswd);
            $user->save();
            $user->reload();
            $readingList = new Readinglist();
            $readingList->setRlname('ReadingList');
            $readingList->setUserUserid1($user->getUserid());
            $readingList->save();

            header('Location: login.php');
            die();
        }
    }


}


?>

    <main class="container">
        <div clas="row justify-content-center">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <form class="form-registration" method="POST">
                    <h2 class="my-4"> Create new User</h2>
                    <?php if (!empty($errors)):
                        foreach ($errors as $error): ?>
                            <div class="alert alert-warning" role="alert"><?= $error ?></div>
                        <?php
                        endforeach;
                    endif; ?>
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" class="form-control" name="name"
                               value="<?php echo isset($name) ? (htmlspecialchars( $name)) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email"
                               value="<?php echo isset($email) ? (htmlspecialchars( $email)) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm password:</label>
                        <input type="password" class="form-control" name="confirmPassword">
                    </div>
                    <a class="btn btn-primary float-left" href="<?php echo $_SERVER['PHP_SELF'] ?>">Cancel</a>
                    <button class="btn btn-primary float-right " type="submit">Submit</button>
                </form>
                <div class="clearfix my-4">
                </div>
            </div>
        </div>

    </main>

<?php
require './Footer.php'
?>