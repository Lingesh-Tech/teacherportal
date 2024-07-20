<?php
    require_once('loggedin_session.php');
    include('header.php');
?>
<title>Register</title>
<body>
    <div class="container">
        <h2>Registration</h2>
        <?php
            if (isset($_SESSION['success'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
                unset($_SESSION['success']); 
            }

            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $error) {
                    echo "<div class='alert alert-danger'>" . $error . "</div>";
                }
                unset($_SESSION['errors']);
            }
        ?>
        <form action="form_submits/registration.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control " name="first_name" placeholder="First Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " name="last_name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control " name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control " name="repeat_password" placeholder="Confirm Password">
            </div>
            <div class="form-btn text-center">
                <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                <a style="padding-left:10px;" href="login.php">Existing user?</a>
            </div>
        </form>
    </div>
</body>
</html>