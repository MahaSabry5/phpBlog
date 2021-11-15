<article
        class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl ">
    <div class="py-6 px-5 ">
        <div>
            <img src="<?= $postCard ?>" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="mt-8 flex flex-col" style="float: right">
            <header>
                <div class="space-x-2">
                    <a href="<?= '/../posts/filteredPosts.php?category='.$category['id']?>"
                       class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                       style="font-size: 10px"> <?php echo($category['name']); ?>
                    </a>
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="<?= '../resources/views/posts/viewpost.php?id='.$post["id"]?>">
                            <?php echo($post["title"]); ?>
                        </a>
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                                Published <time><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></time>
                            </span>
                </div>
            </header>

            <div class="text-sm mt-4 space-y-4">
                <?php echo($post["excerpt"]); ?>
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img src="<?= $laryAvatar ?>" alt="Lary avatar">
                    <div class="ml-3">
                        <h5 class="font-bold">
                            <a href="<?='/../posts/filteredPosts.php?user='.$user["id"]?>"><?php echo($user["name"]); ?> </a>
                        </h5>
                    </div>
                </div>

                <div>
                    <a href="<?='/../posts/viewpost.php?id='.$post["id"]?>"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >
                        Read More
                    </a>
                </div>
            </footer>
        </div>
    </div>
</article>
