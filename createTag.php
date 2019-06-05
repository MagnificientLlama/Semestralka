<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';
?>
<?php
require './Header.php';
require './Navbar.php';
require './manager_required.php';

$errors = [];
if (!empty($_POST)) {

    if (empty($_POST['name'])) {
        array_push($errors, 'Please enter name of the Tag.');
    }else{
        $checkTag=TagQuery::create()->findOneByTagname($_POST['name']);
        if($checkTag!=NULL){
            array_push($errors, 'This Tag already exists');
        }
    }
    if (empty($_POST['description'])) {
        array_push($errors, 'Please enter Description of the Tag');
    }

    $name = $_POST['name'];
    $description = $_POST['description'];

    if(empty($errors)){
        $tag = new Tag();
        $tag->setTagname($name);
        $tag->setTagdescription($description);
        $tag->save();
        header('Location: Tags.php');
        die();
    }

}

?>

    <main class="container">
        <div clas="row justify-content-center">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <h2 class="my-4"> Add a Tag to library</h2>
                <?php if (!empty($errors)):
                    foreach ($errors as $error): ?>
                        <div class="alert alert-warning" role="alert"><?= $error ?></div>
                    <?php
                    endforeach;
                endif; ?>
                <form method="POST" action="createTag.php">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name"
                               value="<?php echo isset($name) ? (htmlspecialchars( $name)) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="description" cols="40"
                                  rows="5"><?php echo isset($description) ? (htmlspecialchars( $description)) : ''; ?></textarea>
                    </div>
                    <button class="btn btn-primary float-center mb-2" type="submit">Edit</button>
                </form>
            </div>
        </div>

    </main>

<?php
require './Footer.php'
?>