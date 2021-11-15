<?php
include 'storeUser.php';
?>
<h1 class="text-center text-xl font-bold ">Edit User</h1>
<form method="POST" action="editUser.php" class="mt-10">
    <div class="mb-6 ">
        <input class="border border-gray-400 p-2 w-full rounded "
               type="hidden"
               name="id"
               id="id"
               value="<?php echo $user_id; ?>"
        >
    </div>
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
        <button type="submit" name="edit" class="bg-blue-400 text-white py-2 px-4 rounded hover:bg-blue-500">
            Edit
        </button>
    </div>
    <div class="text-red-500 text-xs mt-1">
        <?php include __DIR__. '/../../../../app/includes/errors.php' ?>
    </div>

</form>