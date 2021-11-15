<?php
namespace App\Models\users;

use App\Models\Model;

class User extends Model
{
    public function all(){
        $conn = $this->connection;
        $sql = "SELECT * FROM users";
        $users = [];
        // fetch all posts as an associative array called $posts
        $result = $conn->query($sql) ;
        while($row = $result->fetch_assoc()){
            $users[]=$row;
        }
        return $users;
    }

    public function getUserById($id){
        $conn = $this->connection;
        $sql="SELECT * FROM users WHERE id=$id
			 LIMIT 1";

        // fetch all posts as an associative array called $posts
        if($conn->query($sql)){
            $result = $conn->query($sql)->fetch_assoc();
        }
        else{
            $result = null;
        }
        return $result;
    }
    public function edit($id){
        global $name,$username,$email,$user_id;
        $conn = $this->connection;

        $sql = "SELECT * FROM users WHERE id=$id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        // set form values on the form to be updated
        $name = $user['name'];
        $username = $user['username'];
        $email = $user['email'];
        $user_id =$id;


    }
    public function update($request_values){
        global $name,$username,$email,$user_id,$errors;
        $conn = $this->connection;

        $user_id = $request_values['id'];
        $name = esc($request_values['name']);
        $username = esc($request_values['username']);
        $email = esc($request_values['email']);

// form validation: ensure that the form is correctly filled
        if (empty($name)) {
            array_push($errors, "Name is required");
        }
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }

        if (count($errors) == 0) {
            $query = "UPDATE users SET
                    name='$name',
                    username='$username',
                    email='$email',                    
                    email_verified_at= now(),
                    created_at= now(),
                    updated_at= now()
                    WHERE id = $user_id";
            $res = $conn->query($query);

            if ($res) {
                $_SESSION['message'] = "User updated succesfully";
                header('location: /../resources/views/admin/users/viewUsers.php');
                exit(0);
            } else {
                $_SESSION['message'] = "error in updating";
                header('location: /../resources/views/admin/users/editUser.php');
                exit(0);
            }
        }
    }
    public function delete($id){
        $conn = $this->connection;
        $query = "UPDATE posts SET
                    user_id = 1
                    WHERE user_id = $id";
        $conn->query($query);
        $sql = "DELETE FROM users WHERE id=$id";
        $result= $conn->query($sql);
        if ($result) {
            $_SESSION['message'] = "User successfully deleted";
            header("location: /../resources/views/admin/users/viewUsers.php");
            exit(0);
        }
    }







}