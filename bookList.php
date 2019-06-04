<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';

if (isset($_GET['offset'])) {

    $offset = (int)$_GET['offset'];

} else {

    $offset = 0;
}
if (isset($_GET['addBook']) && isset($_SESSION['userID'])) {
    $RLID = ReadinglistQuery::create()->findOneByUserUserid1($_SESSION['userID']);
    $check = BookinreadinglistQuery::create()->findOneByBookBookid($_GET['addBook']);
    if ($check == NULL) {
        $addToRead = new Bookinreadinglist();
        $addToRead->setBookBookid($_GET['addBook']);
        $addToRead->setReadinglistRlid($RLID->getRlid());
        $addToRead->save();
    }
}
if (isset($_GET['submit'])) {
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
    }
    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
    }
    if ($search == 1) {
        $wildFilter = '%' . $filter . '%';
        $books = BookQuery::create()
            ->filterByBookname($wildFilter, \Propel\Runtime\ActiveQuery\Criteria::LIKE)
            ->offset($offset * 10)->limit(10)->orderByBookid()->find();
        $rowCount = $books->count();
        $pageCount = (int)($rowCount / 10) + 1;
    } elseif ($search == 2) {
        $wildFilter = '%' . $filter . '%';
        $authors = AuthorQuery::create()
            ->filterByAuthname($wildFilter, \Propel\Runtime\ActiveQuery\Criteria::LIKE)
            ->orderByAuthid()->select(array('authID'))->find();
        $books = BookQuery::create()->filterByAuthorAuthid1($authors->getData())
            ->offset($offset * 10)->limit(10)->orderByBookid()->find();
        $rowCount = $books->count();
        $pageCount = (int)($rowCount / 10) + 1;
    } elseif ($search == 3) {
        $wildFilter = '%' . $filter . '%';
        $tags = BooktaggedQuery::create()
            ->filterByTagTagname($wildFilter, \Propel\Runtime\ActiveQuery\Criteria::LIKE)
            ->orderByBookBookid()->select(array('book_bookID'))->find();
        $books = BookQuery::create()->filterByAuthorAuthid1($tags->getData())
            ->offset($offset * 10)->limit(10)->orderByBookid()->find();
        $rowCount = $books->count();
        $pageCount = (int)($rowCount / 10) + 1;
    } else {
        $rowCount = BookQuery::create()->count();
        $pageCount = (int)($rowCount / 10) + 1;
        $books = BookQuery::create()->offset($offset * 10)->limit(10)->orderByBookid()->find();
    }

} else {
    $rowCount = BookQuery::create()->count();
    $pageCount = (int)($rowCount / 10) + 1;
    $books = BookQuery::create()->offset($offset * 10)->limit(10)->orderByBookid()->find();
}

?>

<!-- Page Content -->
<div class="container">
    <div class="row my-2">
        <row class="my-2">
            <form action="#" method="get">
                <input type="text" name="filter" placeholder="Filter your list">
                <input type="submit" name="submit" value="Search">
                <input class="ml-2 mr-1" type="radio" name="search" value="1" checked="checked">Book Name
                <input class="ml-2 mr-1" type="radio" name="search" value="2">Author Name
                <input class="ml-2 mr-1" type="radio" name="search" value="3">Tag Name

            </form>
        </row>
        <table class="table table-sm table-books">
            <thead>
            <tr>
                <th>Book</th>
                <th>Author</th>
                <th class="colon-btn">Reading List</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td>
                        <a href="<?= $home . "Book.php?bookID=" . $book->getBookid() ?>"><?=htmlspecialchars( $book->getBookname()); ?></a>
                    </td>
                    <td>
                        <a href="<?= $home . "Author.php?authID=" . $book->getAuthorAuthid1() ?>"><?=htmlspecialchars( $book->getAuthor()->getAuthname()); ?></a>
                    </td>
                    <td>
                        <a type="button" href="<?= $home ?>?addBook=<?=htmlspecialchars( $book->getBookid()) ?>" class="btn">Add</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row center">
        <div class="btn-toolbar my-2" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <div class="pagination">
                    <?php for ($i = 1; $i <= $pageCount; $i++) { ?>
                        <a type="button" class="btn <?= $offset + 1 == $i ? "active" : "" ?>"
                           href="<?= $home ?>?offset=<?= $i - 1 ?><?php if (isset($filter)) {
                               echo '&filter=' . $filter . '&submit=' . $_GET['submit'] . '&search=' . $search . '#';
                           } ?>">
                            <?= $i ?></a>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-lg-9 -->

</div>
<!-- /.row -->
<!-- /.container -->
</body>

</html>

