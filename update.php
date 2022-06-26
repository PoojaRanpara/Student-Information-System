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
            <h1>Update Product</h1>
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

        <?php
        // check if form was submitted
        if ($_POST) {

            try {
                $query = "UPDATE student SET name=:name,enrollment=:enrollment,branch=:branch,email=:email WHERE id=:id";

                // prepare query for excecution
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
                $stmt->bindParam(':id', $id);

                // Execute the query
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                }
            }

            // show errors
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <!--we have our html form here where new record information can be updated-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Enrollment</td>
                    <td><input type="number" name='enrollment' value="<?php echo htmlspecialchars($enrollment, ENT_QUOTES); ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Branch</td>
                    <td><input type='text' name='branch' value="<?php echo htmlspecialchars($branch, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type='text' name='email' value="<?php echo htmlspecialchars($email, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
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