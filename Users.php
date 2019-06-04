<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';
?>
<?php require './Header.php'; ?>
<body>
<?php require './Navbar.php'; ?>
<?php

require './admin_required.php';
if (isset($_GET['offset'])) {

    $offset = (int)$_GET['offset'];

} else {

    $offset = 0;
}
if(isset($_GET['userID'])&&isset($_GET['setPrivilegy'])){
    $setUserPrivilegy = UserQuery::create()->findOneByUserid($_GET['userID']);
    $setUserPrivilegy->setPrivilegy($_GET['setPrivilegy']);
    $setUserPrivilegy->save();
}
if (isset($_GET['deleteBook'])) {
    $delete = BookQuery::create()->findOneByBookid($_GET['deleteBook']);
    $delete->delete();
}


    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
        $wildFilter = '%' . $filter . '%';
        $users = UserQuery::create()
            ->filterByUsername($wildFilter, \Propel\Runtime\ActiveQuery\Criteria::LIKE)
            ->offset($offset * 10)->limit(10)->orderByUserid()->find();
        $rowCount = $users->count();
        $pageCount = (int)($rowCount / 10) + 1;
    } else {
        $rowCount = UserQuery::create()->count();
        $pageCount = (int)($rowCount / 10) + 1;
        $users = UserQuery::create()->offset($offset * 10)->limit(10)->orderByUserid()->find();
    }
?>

<!-- Page Content -->
<div class="container">
    <div class="row my-2">
        <row class="my-2">
            <form action="#" method="get">
                <input type="text" name="filter" placeholder="Filter your list">
                <input type="submit" name="submit" value="Search">
            </form>
        </row>
        <table class="table table-sm table-books">
            <thead>
            <tr>
                <th>Users</th>
                <th class="colon-btn">Set User</th>
                <th class="colon-btn">Set Manager</th>
                <th class="colon-btn">Set Admin</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <a ><?=htmlspecialchars( $user->getUsername()); ?></a>
                    </td>
                    <td>
                        <a type="button" href="<?= $home ?>Users.php?userID=<?= $user->getUserid() ?>&setPrivilegy=1" class="btn">User</a>

                    <td>
                        <a type="button" href="<?= $home ?>Users.php?userID=<?= $user->getUserid() ?>&setPrivilegy=2" class="btn">Manager</a>
                    </td>
                    <td>
                        <a type="button" href="<?= $home ?>Users.php?userID=<?= $user->getUserid() ?>&setPrivilegy=3" class="btn">Admin</a>
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

<?php
require './Footer.php'
?>
</body>

</html>

