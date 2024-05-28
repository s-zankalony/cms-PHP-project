<?php include "includes/header.php";

// Check if the user is logged in
if (isset($_SESSION['user_role'])) {
    session_destroy();
    session_start();
}

if (isset($_POST['submit'])) {

    $user_name = mysqli_real_escape_string($connection, $_POST['username']);
    $user_password = mysqli_real_escape_string($connection, $_POST['password']);
    // encrypting the password
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

    $user_firstname = mysqli_real_escape_string($connection, $_POST['first-name']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['last-name']);
    $user_email = mysqli_real_escape_string($connection, $_POST['email']);
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
    } else {
        $user_image = null;
        $user_image_temp = null;
    }

    $user_role = 'user';
    $randSalt = '';

    if (empty($user_name) || empty($user_password) || empty($user_firstname) || empty($user_lastname) || empty($user_email)) {
        echo "Fields cannot be empty";
    } else {
        move_uploaded_file($user_image_temp, "images/$user_image");

        $query = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname, user_email, user_image, user_role, randSalt) ";
        $query .= "VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ssssssss", $user_name, $user_password, $user_firstname, $user_lastname, $user_email, $user_image, $user_role, $randSalt);
        mysqli_stmt_execute($stmt);

        if (!$stmt) {
            die("Query failed: " . mysqli_error($connection));
        }

        mysqli_stmt_close($stmt);

        echo "User Created: " . " " . "<a href='index.php'>Go to Homepage to Login</a>";

        // header("Location: index.php");
    }

}



?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="on"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                    placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="last-name" class="sr-only">First Name</label>
                                <input type="text" name="first-name" id="first-name" class="form-control"
                                    placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="last-name" class="sr-only">Last Name</label>
                                <input type="text" name="last-name" id="last-name" class="form-control"
                                    placeholder="Last Name">
                            </div>

                            <div class="form-group">
                                <label for="user_image" class="sr-only">Image</label>
                                <input type="file" name="user_image" id="user_image" class="form-control">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>