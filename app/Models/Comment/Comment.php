<?php

class Comment
{
    public function all($id)
    {
        global $conn;
        $sql = "SELECT * FROM comments WHERE post_id = $id";
        $comments = [];
        // fetch all posts as an associative array called $posts
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $comments[] = $row;
            }
        }
        return $comments;
    }

    public function store($request_values)
    {
        global $conn, $body, $errors;
        // receive all input values from the form
        $user_id = $_SESSION['user']['id'];
        $post_id = $_GET['id'];
        $body = esc($request_values['body']);

// form validation: ensure that the form is correctly filled
        if (empty($body)) {
            array_push($errors, "Body is required");
        }
        if (count($errors) == 0) {
            $query = "INSERT INTO comments (user_id,post_id,body,created_at, updated_at) 
					  VALUES($user_id,$post_id,'$body', now(), now())";
            $conn->query($query);
            // get id of created comment
            $reg_comment_id = $conn->insert_id;
            $_SESSION['comment'] = getPostById($reg_comment_id);
            if ($_SESSION['comment']) {
                $_SESSION['message'] = "Comment created succesfully";
                // redirect to admin area
                header('location: /../../index.php');
                exit(0);
            }
        }
    }

    public function delete($id)
    {
        global $conn;
        $sql = "DELETE FROM comments WHERE id=$id";
        $result = $conn->query($sql);
        if ($result) {
            $_SESSION['message'] = "Comment successfully deleted";
            header("location: /../../index.php");
            exit(0);
        }
    }


}