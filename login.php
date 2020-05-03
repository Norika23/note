<?php
include("includes/header.php");
include("includes/navbar.php");

if($session->is_signed_in()) {
    header("Location: index.php");
}

$the_message = "";

if(isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user_found = User::verify_user($username, $password);

    if($user_found) {
        $session->login($user_found);
        header("Location: index.php");
    } else {
        $the_message = "Your password or username are incorrect";
    }

} else {

    $username = "";
    $password = "";

}

?>

<div class="row justify-content-center">
    <div class="col-md-3 col-md-offset-3">
        <h1 class="text-center m-5">Login</h1>
        <h4 class="bg-warning"><?php echo $the_message; ?></h4>
        <form id="login-id" action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">   
            </div>
            <div class="form-group float-right">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>

    </div>
    <div class="form-group float-right">
            <a href="register.php"><input type="submit" name="Registration" value="Registration" class="btn btn-info"></a>
        </div>
</div>