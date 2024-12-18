<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">

                        <?php
                            include "config.php";

                            $post_id = $_GET['id'];

                            $sql = "SELECT post.title, post.description,post.post_img,post.post_date,user.username, category.category_name,post.post_id,category.category_id,user.user_id FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post_id = {$post_id}";

                            $result = mysqli_query($conn, $sql) or die("Query failed");

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                        <div class="post-content single-post">
                            <h3>
                                <?= $row['title']; ?>
                        </h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cid=<?= $row['category_id']; ?>"><?= $row['category_name']; ?></a>
                                    
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?id=<?= $row['user_id']; ?>'><?= $row['username']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?= $row['post_date']; ?>
                                </span>
                            </div>
                            
                            <img class="single-feature-image" src="./admin/upload/<?= $row['post_img']; ?>" alt="" />
                            <p class="description">
                            <?= $row['description']; ?>
                            </p>
                        </div>
                        <?php }} ?>            
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
