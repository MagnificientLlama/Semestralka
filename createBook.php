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
        array_push($errors, 'Please enter name of the book.');
    }
    if (empty($_POST['description'])) {
        array_push($errors, 'Please enter Description of the book');
    }
    if (empty($_POST['bookImage'])) {
        array_push($errors, 'Please enter Book cover image');
    }
    if (empty($_POST['ISBN'])) {
        array_push($errors, 'Please enter ISBN');
    }
    if (empty($_POST['date'])) {
        array_push($errors, 'Please enter date of release of book.');
    }
    if (empty($_POST['author'])) {
        array_push($errors, 'Please enter Author of the book');
    } else {
        $checkAuthor = AuthorQuery::create()->findOneByAuthname($_POST['author']);
        if ($checkAuthor == NULL) {
            array_push($errors, 'There is no such Author in the database.');
        }
        $checkBookName = BookQuery::create()->findOneByBookname($_POST['name']);
        if ($checkBookName != NULL) {
            array_push($errors, 'This Book is already in databse');
        }
        $checkISBN = BookQuery::create()->findOneByISBN($_POST['ISBN']);
        if ($checkISBN != NULL) {
            array_push($errors, 'This ISBN is already in use');
        }

    }

    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['bookImage'];
    $ISBN = $_POST['ISBN'];
    $date = $_POST['date'];
    $author = $_POST['author'];

    if(empty($errors)){
    $book = new Book();
    $book->setBookname($name);
    $book->setBookdescription($description);
    $book->setBookimage($image);
    $book->setIsbn($ISBN);
    $book->setYearofrelease($date);
    $book->setAuthorAuthid1($checkAuthor->getAuthid());
    $book->save();
        header('Location: Library.php');
        die();
    }


}
?>

    <main class="container">
        <div clas="row justify-content-center">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <h2 class="my-4"> Add a book to library</h2>
                <?php if (!empty($errors)):
                    foreach ($errors as $error): ?>
                        <div class="alert alert-warning" role="alert"><?= $error ?></div>
                    <?php
                    endforeach;
                endif; ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name"
                               value="<?php echo isset($name) ? ($name) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="description" cols="40"
                                  rows="5"><?php echo isset($description) ? ($description) : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Book Image:</label>
                        <input type="url" class="form-control" name="bookImage"
                               value="<?php echo isset($image) ? ($image) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>ISBN:</label>
                        <input type="text" class="form-control" name="ISBN"
                               value="<?php echo isset($ISBN) ? ($ISBN) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Release:</label>
                        <input type="date" class="form-control" name="date"
                               value="<?php echo isset($date) ? ($date) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Name of Author:</label>
                        <input type="text" class="form-control" name="author"
                               value="<?php echo isset($author) ? ($author) : ''; ?>">
                    </div>
                    <button class="btn btn-primary float-center mb-2" type="submit">Add</button>
                </form>
            </div>
        </div>

    </main>

<?php
require './Footer.php'
?>