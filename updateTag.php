<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';

if (isset($_GET['tagName'])) {
    $tagName = $_GET['tagName'];
    $tag = TagQuery::create()->findOneByTagname($tagName);
    if ($tag == null) {
        header('Location: updateTag.php?tagName=' . $tagName);
        die();
    }
} else {
    header('Location: updateTag.php?tagName=' . $tagName);
    die();
}
$rowCount = BookQuery::create()->useBooktaggedQuery()->filterByTagTagname()->endUse()->count();
if (isset($_GET['offset'])) {

    $offset = (int)$_GET['offset'];

} else {

    $offset = 0;
}
if (isset($_GET['addTag'])) {
    $add = new Booktagged();
    $add->setBookBookid($_GET['addTag']);
    $add->setTagTagname($tagName);
    $add->save();
}

if (isset($_GET['removeBook'])) {
    $delete = BooktaggedQuery::create()->findOneByBookBookid($_GET['removeBook']);
    if ($delete != NULL) {
        $delete->delete();
    }
}

$pageCount = (int)($rowCount / 10) + 1;
$books = BookQuery::create()->useBooktaggedQuery()->filterByTagTagname($tagName)->endUse()
    ->offset($offset * 10)->limit(10)->orderByBookid()->find();

if (isset($_GET['submit'])) {
    if (isset($_GET['filter'])) {
        $searchFilter = $_GET['filter'];
        $searchWildFilter = '%' . $searchFilter . '%';
        $searchBooks = BookQuery::create()
            ->filterByBookname($searchWildFilter, \Propel\Runtime\ActiveQuery\Criteria::LIKE)
            ->limit(5)->orderByBookid()->find();
    } else {
        $searchBooks = BookQuery::create()->limit(5)->find();
    }

} else {

    $searchBooks = BookQuery::create()->limit(5)->find();
}
?>

<?php require './Header.php'; ?>
<body>
<?php require './Navbar.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row my-4">
        <div class="col-4">
            <h4 class="text-center"><?= htmlspecialchars($tag->getTagname()) ?></h4>
            <p class="text-center"><?= htmlspecialchars($tag->getTagdescription()) ?></p>
            <row class="my-2 ">
                <form action="#" method="get" class="ml-4 my-2">
                    <input type="hidden" name="tagName" value="<?= $tagName ?>">
                    <input type="hidden" name="offset" value="<?= $offset ?>">
                    <input type="text" name="filter" placeholder="Search for book">
                    <input type="submit" name="submit" value="Search">
                </form>
            </row>
            <table class="table table-sm table-books">
                <thead>
                <tr>
                    <th>Book</th>
                    <th class="colon-btn text-right">Delete Book</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($searchBooks as $searchBook): ?>
                    <tr>
                        <td>
                            <a><?= htmlspecialchars($searchBook->getBookname()); ?></a>
                        </td>
                        <td>
                            <a type="button" href="updateTag.php?addTag=
                            <?= $searchBook->getBookid() . "&tagName=" . $tagName ?>" class="btn float-right">
                                Add
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-8">
            <table class="table table-sm table-chapters">
                <thead>
                <tr>
                    <th class="text-center">Books</th>
                    <th class="text-center">Remove from Tag</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td>
                            <a href="<?= $home . "Book.php?bookID=" . $book->getBookid() ?>"><?= htmlspecialchars($book->getBookname()); ?></a>
                        </td>
                        <td>
                            <a type="button"
                               href="<?= $home ?>?removeBook=<?= $book->getBookid() . "&tagName=" . $tagName ?>"
                               class="btn">
                                Remove
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row center">
                <div class="btn-toolbar my-2" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $pageCount; $i++) { ?>
                                <a type="button" class="btn <?= $offset + 1 == $i ? "active" : "" ?>"
                                   href="<?= $home ?>Author.php?authID=<?= $tagName ?>&offset=<?= $i - 1 ?>"><?= $i ?></a>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

</div>
<!-- /.row -->

</div>
<!-- /.container -->
<?php require './Footer.php'; ?>
</body>

</html>

