<section class="px-6 py-8">
    <?php session_start();?>
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="index.php">
                <img src="images/logo.svg" alt="Laracasts Logo" width="165" height="16">
            </a>
        </div>
        <?php if (isset($_SESSION['user'])) { ?>
            <div class="logged_in_info">
                <span class="text-l text-blue-500 font-bold uppercase mr-10">Welcome, <?php echo $_SESSION['user']['name'] ?></span>
                |
                <span><a href="./../app/logout.php" class="uppercase font-semibold text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-10 rounded-2xl">logout</a></span>
            </div>
        <?php }else{ ?>
            <div class="mt-8 md:mt-0 item-center flex">
                <a href="./../app/register.php" class="uppercase font-semibold text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-10 rounded-2xl">Register</a>
                <a href="./../app/login.php" class="uppercase ml-5 font-semibold text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-10 rounded-2xl">Login</a>
            </div>
        <?php } ?>
    </nav>
</section>

