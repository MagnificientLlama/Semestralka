<?php require './Header.php'; ?>
<body>
<?php require './Navbar.php'; ?>

<!-- Page Content -->
<div class="container">
    <div class="row my-2">
        <table class="table table-sm table-dark">
            <thead>
            <tr>
                <th class="w-40">Book</th>
                <th class="w-40">Author</th>
                <th class="w-20">Reading List</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td><button class="btn btn-primary align-self-end">Add</button></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td><button class="btn btn-primary">Add</button></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td><button class="btn btn-primary m-0">Add</button></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- /.col-lg-9 -->

</div>
<!-- /.row -->

</div>
<!-- /.container -->
<?php require './Footer.php'; ?>
</body>

</html>

