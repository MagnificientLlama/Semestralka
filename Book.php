<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';
require './Header.php'; ?>
<body>
<?php require './Navbar.php'; ?>
<?php
if (isset($_GET['bookID'])) {
    $bookID = $_GET['bookID'];
    $book = BookQuery::create()->findOneByBookid($bookID);
    if ($book == null) {
        header('Location: index.php');
        die();
    }
} else {

    header('Location: index.php');
    die();
}

if (isset($_GET['rating'])) {
    if (isset($_SESSION['userID'])) {
        $rating = $_GET['rating'];
        if ($rating >= 1 && $rating <= 5) {
            $checkRating = UserratingQuery::create()->filterByBookBookid($bookID)->findOneByUserUserid($_SESSION['userID']);
            if($checkRating==NULL){
                $newRating = new Userrating();
                $newRating->setBookBookid($bookID);
                $newRating->setUserUserid($_SESSION['userID']);
                $newRating->setRating($_GET['rating']);
                $newRating->save();
            }else{
                $checkRating->setRating($rating);
                $checkRating->save();
            }
        }
    }
}
$rowCount = ChapterQuery::create()->filterByBookBookid($bookID)->count();
if (isset($_GET['offset'])) {

    $offset = (int)$_GET['offset'];

} else {

    $offset = 0;
}

$pageCount = (int)($rowCount / 10) + 1;
$chapters = ChapterQuery::create()->filterByBookBookid($bookID)->offset($offset * 10)->limit(10)->orderByChapterid()->find();
$listOfRatings= UserratingQuery::create()->filterByBookBookid($bookID)->find();
$averageRating=0;
foreach ($listOfRatings as $singleRating){
    $averageRating=$averageRating+$singleRating->getRating();
}

if($listOfRatings->count()>0){
    $averageRating=$averageRating/$listOfRatings->count();
}


?>


<!-- Page Content -->
<div class="container">

    <div class="row my-4">
        <div class="col-4">
            <img class="mx-3" width="256" height="256" src="<?= $book->getBookimage() ?>">
            <h4 class="text-center"><?= $book->getBookname() ?></h4>
            <h3>Rating: <?=$averageRating?></h3>
            <h6 class="text-center"><?= $book->getYearofrelease()->format("m.d.Y") ?></h6>
            <p class="text-center"><?= $book->getBookdescription() ?></p>
        </div>
        <div class="col-8">
            <div class="row justify-content-between m-2">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                    <div class="row justify-content-between">
                        <div class="input-group">
                            <select class="form-control" name="rating">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <input type="hidden" name="bookID" value="<?= $bookID ?>"/>
                            <input type="hidden" name="offset" value="<?= $offset ?>"/>
                            <input type="submit" name="submit" value="Rate:" class="float-right">
                        </div>

                    </div>
                </form>

            </div>
            <table class="table table-sm table-chapters">
                <thead>
                <tr>
                    <th class="text-center">Chapters</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($chapters as $chapter): ?>
                    <tr>
                        <td>
                            <a href="<?= $home . "chapter.php?chapterID=" . $chapter->getChapterid()
                            ."&bookID=".$bookID."&offset=".$offset ?>"><?= $chapter->getChaptername(); ?>
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
                                   href="<?= $home ?>Book.php?bookID=<?= $bookID ?>&offset=<?= $i - 1 ?>"><?= $i ?></a>

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

