<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>

<body>

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Create Product</h1>
        </div>

        <?php
        if ($_POST) {

            // include database connection
            include 'database.php';

            try {

                // insert query
                $query = "INSERT INTO student SET name=:name, enrollment=:enrollment, branch=:branch, email=:email";

                // prepare query for execution
                $stmt = $con->prepare($query);

                // posted values
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $enrollment = htmlspecialchars(strip_tags($_POST['enrollment']));
                $branch = htmlspecialchars(strip_tags($_POST['branch']));
                $email = htmlspecialchars(strip_tags($_POST['email']));

                // bind the parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':enrollment', $enrollment);
                $stmt->bindParam(':branch', $branch);
                $stmt->bindParam(':email', $email);

                // Execute the query
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                }
            }

            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <!-- html form here where the product information will be entered -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Enrollment</td>
                    <td><input type="number" name='enrollment' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Branch</td>
                    <td><input type='text' name='branch' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type='text' name='email' class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to home</a>
                    </td>
                </tr>
            </table>
        </form>

    </div> <!-- end .container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>