<article class="flex bg-gray-100 rounded-xl border border-gray-200 p-6 space-x-6">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/60" width="60px" height="60px" class="rounded-xl">
    </div>
    <div class="w-full">
        <header class="mb-4">
            <h3 class="font-bold"><?php echo $author['name']; ?></h3>
            <h3 class="text-xs">
                Posted
                <time><?php echo date("F j, Y ", strtotime($comment["created_at"])); ?></time>
            </h3>

        </header>
        <p>
            <?php echo ($comment["body"]); ?>
        </p>
        <?php
        if($_SESSION){
            if ($_SESSION['user']['role'] == 'admin') {
                include 'deleteComment.php';
            }
        }

        ?>
    </div>


</article>
