<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Update a Record - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>

<body>

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Search Result Here</h1>
        </div>

        <?php
        if (!empty($_REQUEST['search'])) {

            include 'database.php';
            $term = htmlspecialchars(strip_tags($_REQUEST['search']));

            $query = "SELECT * FROM student WHERE enrollment = ?";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $term);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['name'];
            $enrollment = $row['enrollment'];
            $branch = $row['branch'];
            $email = $row['email'];            
        }
        ?>

        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Name</td>
                <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Enrollment</td>
                <td><?php echo htmlspecialchars($enrollment, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Branch</td>
                <td><?php echo htmlspecialchars($branch, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo htmlspecialchars($email, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='index.php' class='btn btn-danger'>Back to home</a>
                </td>
            </tr>
        </table>

    </div> <!-- end .container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>