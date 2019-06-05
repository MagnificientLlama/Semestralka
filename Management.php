<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';
?>
<?php require './Header.php'; ?>
<body>
<?php require './Navbar.php'; ?>
<?php

require './manager_required.php';
if (isset($_GET['offset'])) {

    $offset = (int)$_GET['offset'];

} else {

    $offset = 0;
}
if(isset($_GET['deleteBook'])){
    $delete = BookQuery::create()->findOneByBookid($_GET['deleteBook']);
    $delete->delete();
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

        <div class="row center my-2 input-group">
            <a type="button" class="btn " href="Library.php">Manage Books</a>
            <a type="button" class="btn " href="Authors.php">Manage Authors</a>
            <a type="button" class="btn " href="Tags.php">Manage Tags</a>
        </div>
    </div>
    <!-- /.col-lg-9 -->

</div>
<!-- /.row -->
<!-- /.container -->

<?php
require './Footer.php'
?>
</body>

</html>

