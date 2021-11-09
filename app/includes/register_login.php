<?php
require_once 'DBconnect.php';
$conn = new connection();
$conn=$conn->DBconnect();
$name = "";
$username = "";
$email    = "";
$errors = array();
//register new user
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $name = esc($_POST['name']);
    $username = esc($_POST['username']);
    $email = esc($_POST['email']);
    $password = esc($_POST['password']);

// form validation: ensure that the form is correctly filled
    if (empty($name)) {  array_push($errors, "Name is required"); }
    if (empty($username)) {  array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    $user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";
    $result = $conn->query($user_check_query) ;

    $user = $result->fetch_assoc();

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }
    if (count($errors) == 0) {
        $password = md5($password);//encrypt the password before saving in the database
        $query = "INSERT INTO users (username,name, email, password,email_verified_at, created_at, updated_at) 
					  VALUES('$username','$name', '$email', '$password',now(), now(), now())";
        $conn->query($query) ;

        // get id of created user
        $reg_user_id = $conn->insert_id;

        // put logged in user into session array
        $_SESSION['user'] = getUserById($reg_user_id);
//        print_r($_SESSION);die();
        if ($_SESSION['user']['role'] == "admin") {
            $_SESSION['message'] = "You are now logged in";
            // redirect to admin area
            header('location: admin/dashboard.php');
            exit(0);
        } else {
            $_SESSION['message'] = "You are now logged in";
            // redirect to public area
            header('location: index.php');
            exit(0);
        }
    }
}
if (isset($_POST['login_btn'])) {
    $email= esc($_POST['email']);
    $password = esc($_POST['password']);

    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if (empty($errors)) {
        $password = md5($password); // encrypt password
        $sql = "SELECT * FROM users WHERE email='$email' and password='$password' LIMIT 1";

        $result = $conn->query($sql) ;

        if (mysqli_num_rows($result) > 0) {
            // get id of created user
            $reg_user_id = $result->fetch_assoc()['id'];

            // put logged in user into session array
            $_SESSION['user'] = getUserById($reg_user_id);

            // if user is admin, redirect to admin area
            if ($_SESSION['user']['role'] == "admin") {
                $_SESSION['message'] = "You are now logged in";
                // redirect to admin area
                header('location: ./admin/dashboard.php');
                exit(0);
            } else {
                $_SESSION['message'] = "You are now logged in";
                // redirect to public area
                header('location: index.php');
                exit(0);
            }
        } else {
            array_push($errors, 'Wrong credentials');
        }
    }
}
function esc(String $value)
{
    // bring the global db connect object into function
    global $conn;

    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($conn, $value);

    return $val;
}
function getUserById($id)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE id=$id LIMIT 1";
    $result = $conn->query($sql) ;
    $user = $result->fetch_assoc();
    return $user;
}
