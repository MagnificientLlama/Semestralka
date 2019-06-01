<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';

if (isset($_GET['offset'])) {

    $offset = (int)$_GET['offset'];

} else {

    $offset = 0;
}
$rowCount = BookQuery::create()->count();
$pageCount = (int)($rowCount/10)+1;
$books = BookQuery::create()->offset($offset*10)->limit(10)->orderByBookid()->find();
?>

<!-- Page Content -->
<div class="container">
    <div class="row my-2">
        <table class="table table-sm table-books">
            <thead>
            <tr>
                <th >Book</th>
                <th >Author</th>
                <th class="colon-btn">Reading List</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book):?>
            <tr>
                <td><a href="<?=$home."Book.php?bookID=".$book->getBookid()?>"><?=$book->getBookname();?></a></td>
                <td><?=$book->getAuthor()->getAuthname();?></td>
                <td ><button class="btn btn-primary">Add</button></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="row center">
        <div class="btn-toolbar center my-2" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <div class="pagination">
                    <?php for ($i = 1; $i <= $pageCount; $i++) { ?>
                        <a type="button" class="btn <?= $offset + 1 == $i ? "active" : "" ?>"
                           href="<?=$home?>?offset=<?= $i - 1 ?>"><?= $i ?></a>

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

