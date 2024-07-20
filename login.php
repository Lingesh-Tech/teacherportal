<?php 
    require_once('loggedin_session.php');
    include('header.php');
?>
<title>Login - Teacher Portal</title>
<body>
    <div class="container">
        <h2>Teacher Portal Login</h2>
        <form action="form_submits/login.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control " name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control " name="password" placeholder="Password" required>
            </div>
            <div class="form-btn text-center">
                <button type="submit" class="btn btn-primary" name="submit">Log in</button>
                <p class="pt-2"> No account? <a class="pl-1" href="registration.php">Sign up</a></p>
            </div>
        </form>
    </div>
</body>

</html>