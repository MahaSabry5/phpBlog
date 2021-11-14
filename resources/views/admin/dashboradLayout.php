<?php
require_once '../includes/DBconnect.php';
include('C:\xampp\htdocs\Laravel\phpBlog\resources\navbar.php');
include('C:\xampp\htdocs\Laravel\phpBlog\resources\header.php');
require_once('../Models/Category/Category.php');
require_once('../Models/users/User.php');
require_once('../Models/posts/Post.php');
$conn = (new connection)->DBconnect();

?>
<h1 class="text-lg font-bold pl-2 pb-2 mt-10 border-b ">
    Admin Management
</h1>
<section class="mx-auto lg:grid lg:grid-cols-5 gap-x-10 ">
    <div class="flex pt-6 pl-6 bg-blue-100 max-w-lg  ">
        <aside >
            <ul>
                <li>
                    <a href="dashboard.php" class="<?php if($page === "posts") {echo "text-blue-500";} ?>"> All Posts</a>
                </li>
                <li>
                    <a href="posts/createPost.php" class="<?php if($page === "new") {echo "text-blue-500";} ?>" >New Post</a>
                </li>
                <li>
                    <a href="users/viewUsers.php" class="<?php if($page === "users") {echo "text-blue-500";} ?>">Users</a>
                </li>
                <li>
                    <a href="categories/viewCategories.php" class="<?php if($page === "categories") {echo "text-blue-500";} ?>" >Categories</a>
                </li>
            </ul>

        </aside>
    </div>
    <main class=" mt-10 bg-gray-100 p-6 relative rounded-xl flex-1 col-span-4 " >