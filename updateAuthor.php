<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';
?>
<?php
require './Header.php';
require './Navbar.php';
require './manager_required.php';

$errors = [];
if(!isset($_GET['authID'])){
    header('Location: Authors.php');
    die();
}
if (!empty($_POST)) {

    if (empty($_POST['name'])) {
        array_push($errors, 'Please enter name of the author.');
    }

    if (empty($_POST['date'])) {
        array_push($errors, 'Please enter date of birth of the author.');
    }

    $name = $_POST['name'];
    $image = $_POST['authorImage'];
    $date = $_POST['date'];

    if(empty($errors)){
        $AuthorUpdate = AuthorQuery::create()->findOneByAuthid($_GET['authID']);
        $AuthorUpdate->setAuthname($name);
        $AuthorUpdate->setAuthavatar($image);;
        $AuthorUpdate->setDateofbirth($date);
        $AuthorUpdate->save();
        header('Location: Authors.php');
        die();
    }

}else{
    $AuthorUpdate = AuthorQuery::create()->findOneByAuthid($_GET['authID']);
    $name = $AuthorUpdate->getAuthname();
    $image = $AuthorUpdate->getAuthavatar();
    $date = $AuthorUpdate->getDateofbirth();
}

?>

    <main class="container">
        <div clas="row justify-content-center">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <h2 class="my-4"> Update an author</h2>
                <?php if (!empty($errors)):
                    foreach ($errors as $error): ?>
                        <div class="alert alert-warning" role="alert"><?= $error ?></div>
                    <?php
                    endforeach;
                endif; ?>
                <form method="POST" action="updateAuthor.php?authID=<?php echo $_GET['authID'] ?>">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name"
                               value="<?php echo isset($name) ? (htmlspecialchars( $name)) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Author Avatar:</label>
                        <input type="url" class="form-control" name="authorImage"
                               value="<?php echo isset($image) ? (htmlspecialchars( $image)) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth:</label>
                        <input type="date" class="form-control" name="date"
                               value="<?php echo isset($_POST['date'])? htmlspecialchars( $date) : (htmlspecialchars( $date->format('Y-m-d'))); ?>">
                    </div>
                    <button class="btn btn-primary float-center mb-2" type="submit">Edit</button>
                </form>
            </div>
        </div>

    </main>

<?php
require './Footer.php'
?>