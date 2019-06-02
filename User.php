<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';?>

<?php require './Header.php'; ?>
<body>
<?php require './Navbar.php'; ?>
<?php
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
    $user = UserQuery::create()->findOneByUserid($userID);
    $userAvatar=$user->getUseravatar();
    $placeholder='https://www.bsn.eu/wp-content/uploads/2016/12/user-icon-image-placeholder-300-grey.jpg';
} else {
    //header('Location: index.php');
    //die();
}
if (isset($_GET['readingList'])) {
    $readingList = ReadinglistQuery::create()->filterByUserUserid1($userID)
        ->orderByRlid()->findOneByRlname($_GET['readingList']);
} else {
    $readingList = ReadinglistQuery::create()->filterByUserUserid1($userID)->orderByRlid()->findOne();
}
if($readingList!=NULL) {
    $rowCount = BookinreadinglistQuery::create()->filterByReadinglistRlid($readingList->getRlid())->count();
    if (isset($_GET['offset'])) {

        $offset = (int)$_GET['offset'];

    } else {

        $offset = 0;
    }
    if (isset($_GET['removeBook'])) {
        $removeFromRead = BookinreadinglistQuery::create()->findOneByBookBookid($_GET['removeBook']);
        if ($removeFromRead != NULL) {
            $removeFromRead->delete();
        }
    }

    $pageCount = (int)($rowCount / 10) + 1;
    $books = BookQuery::create()->useBookinreadinglistQuery()->filterByReadinglistRlid($readingList->getRlid())->endUse()
        ->offset($offset * 10)->limit(10)->orderByBookid()->find();
}else{
    $books=[];
}

?>



<!-- Page Content -->
<div class="container">

    <div class="row my-4">
        <div class="col-4">
            <img class="mx-3" width="256" height="256" src="<?php if($userAvatar!=NULL){ echo $user;}else{echo $placeholder;} ?>">
            <h4 class="text-center"><?= $user->getUsername() ?></h4>
            <p class="text-center"><?= $user->getEmail() ?></p>
        </div>
        <div class="col-8">
            <table class="table table-sm table-chapters">
                <thead>
                <tr>
                    <th class="text-center"><?php if($readingList!=NULL){echo $readingList->getRlname();}else{echo 'No Reading list created';}?></th>
                    <th class="text-center">Changes</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td>
                            <a href="<?= $home . "Book.php?bookID=" . $book->getBookid() ?>"><?= $book->getBookname(); ?>
                        </td>
                        <td>
                            <a type="button" href="<?= $home ?>?removeBook=<?= $book->getBookid() ?>" class="btn">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row center">
                <div class="btn-toolbar center my-2" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <?php if($readingList!=NULL):?>
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $pageCount; $i++) { ?>
                                <a type="button" class="btn <?= $offset + 1 == $i ? "active" : "" ?>"
                                   href="<?= $home ?>User.php?userID=<?= $userID ?>&offset=<?= $i - 1 ?>"><?= $i ?></a>

                            <?php } ?>
                        </div>
                        <?php endif;?>
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

