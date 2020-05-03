<?php
include("includes/header.php");
include("includes/navbar.php");

$user = new User;

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $error = [
            'username'=>'',
            'password'=>'',
        ];

        if($username == '') {
            $error['username'] = 'Username cannot be empty';
        }

        if($user->username_exists($username)) {
            $error['username'] = 'Username already exists, pick another one ';
        }

        if($password == '') {
            $error['password'] = 'password cannot be empty';
        }

        foreach ($error as $key => $value) {
            if(empty($value)) {
                unset($error[$key]);
            }
        }

        if(empty($error)) {
            $user->register_user($username, $password);
            $user_found = User::verify_user($username, $password);
            if($user_found) {
                $session->login($user_found);
                header("Location: index.php");
            } 
        }
    } 
?>

<div class="row justify-content-center">
    <div class="col-md-3 col-md-offset-3">
        <h1 class="text-center m-5">Register</h1>
        <form role="form" action="register.php" method="post" id="login-form" autocomplete="off">               
            <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input type="text" name="username" id="username" class="form-control" 
                placeholder="Enter Desired Username"
                autocomplete="on">
                <h4 class="bg-warning"><?php echo isset($error['username']) ? $error['username'] : '' ?></p></h4>
            </div>
                <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                <h4 class="bg-warning"><?php echo isset($error['password']) ? $error['password'] : '' ?></p></h4>
            </div>
            <input type="submit" name="register" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
        </form>
    </div> 
</div> 
