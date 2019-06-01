<?php
require_once './vendor/autoload.php';
require_once './generated-conf/config.php';
if(isset($_GET['chapterID'])){
    $chapterID=$_GET['chapterID'];
    $chapter = ChapterQuery::create()->findOneByChapterid($chapterID);
    if($chapter==null){
        header('Location: index.php');
        die();
    }
}else{
    header('Location: index.php');
    die();
}
?>

<?php require './Header.php'; ?>
<body>
<?php require './Navbar.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="col-6 col-md-auto">
        <!-- /.row -->
        <h1 class="text-center"><?=$chapter->getChaptername()?></h1>
        <p><?= file_get_contents('./chapters/'.$chapterID.'.txt') ?></p>

    </div>
    <!-- /.col-lg-9 -->

</div>
<!-- /.row -->

</div>
<!-- /.container -->
<?php require './Footer.php'; ?>
</body>

</html>

