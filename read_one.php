<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>

<body>
    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Read Product</h1>
        </div>

        <?php
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //include database connection
        include 'database.php';

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT id, name, enrollment, branch, email FROM student WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['name'];
            $enrollment = $row['enrollment'];
            $branch = $row['branch'];
            $email = $row['email'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <!--we have our html table here where the record will be displayed-->
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