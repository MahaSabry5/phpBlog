<?php
include('../resources/navbar.php');
include('../resources/header.php');
include ('includes/register_login.php');
?>
<section class="px-6 py-8">
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl ">
        <h1 class="text-center text-xl font-bold ">Register</h1>
        <form method="POST" action="register.php" class="mt-10">

            <div class="mb-6 ">
                <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                    Name
                </label>
                <input class="border border-gray-400 p-2 w-full rounded"
                       type="text"
                       name="name"
                       id="name"
                       value="<?php echo $name; ?>"
                >

            </div>
            <div class="mb-6 ">
                <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                    Username
                </label>
                <input class="border border-gray-400 p-2 w-full rounded"
                       type="text"
                       name="username"
                       id="username"
                       value="<?php echo $username; ?>"
                >

            </div>
            <div class="mb-6 ">
                <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                    Email
                </label>
                <input class="border border-gray-400 p-2 w-full rounded"
                       type="email"
                       name="email"
                       id="email"
                       value="<?php echo $email; ?>"
                >

            </div>

            <div class="mb-6 ">
                <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                    Password
                </label>
                <input class="border border-gray-400 p-2 w-full rounded"
                       type="password"
                       name="password"
                       id="password"
                >

            </div>
            <div class="mb-6 ">
                <button type="submit" name="reg_user" class="bg-blue-400 text-white py-2 px-4 rounded hover:bg-blue-500">
                    Sign Up
                </button>
            </div>
            <div class="text-red-500 text-xs mt-1">
                <?php include 'includes/errors.php'?>
            </div>

        </form>

    </main>
</section>

<?php include('../resources/footer.php') ?>
