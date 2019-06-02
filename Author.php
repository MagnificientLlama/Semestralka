<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';

if(isset($_GET['authID'])){
    $authID=$_GET['authID'];
    $author = AuthorQuery::create()->findOneByAuthid($authID);
    if($author==null){
        header('Location: index.php');
        die();
    }
}else{
    header('Location: index.php');
    die();
}
$rowCount = BookQuery::create()->filterByAuthorAuthid1($authID)->count();
if (isset($_GET['offset'])) {

    $offset = (int)$_GET['offset'];

} else {

    $offset = 0;
}

$pageCount = (int)($rowCount/10)+1;
$books = BookQuery::create()->filterByAuthorAuthid1($authID)->offset($offset*10)->limit(10)->orderByBookid()->find();


?>

<?php require './Header.php'; ?>
<body>
<?php require './Navbar.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row my-4">
        <div class="col-4">
            <img class="mx-3" width="256" height="256" src="<?=$author->getAuthavatar()?>">
            <h4 class="text-center"><?=$author->getAuthname()?></h4>
            <h6 class="text-center"><?=$author->getDateofbirth()->format("m.d.Y")?></h6>
        </div>
        <div class="col-8">
            <table class="table table-sm table-chapters">
                <thead>
                <tr>
                    <th class="text-center">Chapters</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><a href="<?=$home."Book.php?bookID=".$book->getBookid()?>"><?=$book->getBookname();?></a></td>
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
                                   href="<?=$home?>Author.php?authID=<?=$authID?>&offset=<?= $i - 1 ?>"><?= $i ?></a>

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

