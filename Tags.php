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
if (isset($_GET['deleteTag'])) {
    $delete = TagQuery::create()->findOneByTagname($_GET['deleteTag']);
    if ($delete != NULL) {
        $delete->delete();
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
        $tagList = TagQuery::create()->useBookQuery()
            ->filterByBookname($wildFilter, \Propel\Runtime\ActiveQuery\Criteria::LIKE)->endUse()
            ->offset($offset * 10)->limit(10)->orderByAuthid()->find();
        $rowCount = $tagList->count();
        $pageCount = (int)($rowCount / 10) + 1;
    } elseif ($search == 2) {
        $wildFilter = '%' . $filter . '%';
        $authorID = AuthorQuery::create()
            ->filterByAuthname($wildFilter, \Propel\Runtime\ActiveQuery\Criteria::LIKE)
            ->orderByAuthid()->select('authID')->find();
        $bookByAuthor = BookQuery::create()->filterByAuthorAuthid1($authorID->getData())->select('bookID')
            ->find();
        $tagList = TagQuery::create()->useBooktaggedQuery()->filterByBookBookid($bookByAuthor->getData())->find();
        $rowCount = $tagList->count();
        $pageCount = (int)($rowCount / 10) + 1;
    } elseif ($search == 3) {
        $wildFilter = '%' . $filter . '%';

        $tagList = TagQuery::create()->filterByTagname($wildFilter, \Propel\Runtime\ActiveQuery\Criteria::LIKE)
            ->offset($offset * 10)->limit(10)->find();
        $rowCount = $tagList->count();
        $pageCount = (int)($rowCount / 10) + 1;
    } else {
        $rowCount = TagQuery::create()->count();
        $pageCount = (int)($rowCount / 10) + 1;
        $tagList = TagQuery::create()->offset($offset * 10)->limit(10)->find();
    }

} else {
    $rowCount = TagQuery::create()->count();
    $pageCount = (int)($rowCount / 10) + 1;
    $tagList = TagQuery::create()->offset($offset * 10)->limit(10)->find();
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
        <div class="row center my-2 input-group">
            <a type="button" class="btn center" href="createTag.php">Add new Tag</a>
        </div>
        <table class="table table-sm table-books">
            <thead>
            <tr>
                <th>Tag</th>
                <th class="colon-btn">Edit Tag</th>
                <th class="colon-btn">Delete Tag</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tagList as $tag): ?>
                <tr>
                    <td>
                        <a><?= htmlspecialchars($tag->getTagname()); ?></a>
                    </td>
                    <td>
                        <a type="button" href="<?= $home ?>updateTag.php?tagName=<?= $tag->getTagname() ?>" class="btn">Edit</a>
                    </td>
                    <td>
                        <a type="button" href="Tags.php?deleteTag=<?= $tag->getTagname() ?>" class="btn">Delete</a>
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
                           href="?offset=<?= $i - 1 ?><?php if (isset($filter)) {
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

<?php
require './Footer.php'
?>
</body>

</html>

