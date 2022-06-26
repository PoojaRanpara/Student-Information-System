<html>

<head>
    <title>Student Managment System</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
        body{
            padding: 0;
            margin: 0;
        }
        
    </style>

</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Student Management</a>
            </div>            
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left" action="search.php">
                    <div class="form-group">
                        <input type="text"  style="width: 300px;" class="form-control" placeholder="Search by enrollment number" name="search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </ul>
        </div>
    </nav>

    <!-- container -->
    <div class="container">

        <?php
        // include database connection
        include 'database.php';

        $action = isset($_GET['action']) ? $_GET['action'] : "";

        // if it was redirected from delete.php
        if ($action == 'deleted') {
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }

        // select all data
        $query = "SELECT id, name, enrollment, branch, email FROM student ORDER BY id ASC";
        $stmt = $con->prepare($query);
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();

        // link to create record form
        echo "<a href='create.php' class='btn btn-primary m-b-1em'>Add a New Student</a>";

        //check if more than 0 record found
        if ($num > 0) {

            echo "<table class='table table-hover table-responsive table-bordered'>"; //start table

            //creating our table heading
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Enrollment Number</th>";
            echo "<th>Branch</th>";
            echo "<th>Email</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                // creating new table row per record
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$enrollment}</td>";
                echo "<td>{$branch}</td>";
                echo "<td>{$email}</td>";
                echo "<td>";

                // read one record 
                echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";

                // we will use this links on next part of this post
                echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }

            // end table
            echo "</table>";
        }

        // if no records found
        else {
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>

    </div> <!-- end .container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type='text/javascript'>
        // confirm record deletion
        function delete_user(id) {

            var answer = confirm('Are you sure?');
            if (answer) {
                window.location = 'delete.php?id=' + id;
            }
        }
    </script>

</body>

</html>