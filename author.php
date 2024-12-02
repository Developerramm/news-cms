<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php
                    include "config.php";
                    $user_id = $_GET['id'];
                    $sql = "SELECT username FROM user WHERE user_id = {$user_id}";
                    $result = mysqli_query($conn, $sql) or die("Query failed");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<h2 class='page-heading text-capitalize'>{$row['username']}</h2>";
                        }
                    }


                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $limit = 3;
                    $offset = ($page - 1) * $limit;

                    $sql1 = "SELECT post.title, post.description,post.post_img,post.post_date,user.username, category.category_name,post.post_id,category.category_id FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id
                            WHERE user.user_id = {$user_id}    
                            ORDER BY post_id DESC LIMIT {$offset},{$limit}";

                    $result1 = mysqli_query($conn, $sql1) or die("Query failed");

                    if (mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?= $row1['post_id']; ?>">
                                            <img src="./admin/upload/<?= $row1['post_img']; ?>" alt="" />
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?= $row1['post_id']; ?>'>
                                                    <?= $row1['title']; ?>
                                                </a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?= $row1['category_id']; ?>'><?= $row1['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <?= $row1['username']; ?>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?= $row1['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row1['description'], 0, 125); ?>...
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?= $row1['post_id']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }

                    $sql2 = "SELECT * FROM post WHERE author = {$user_id}";
                    $result2 = mysqli_query($conn, $sql2) or die("Query Failed");

                    if (mysqli_num_rows($result2) > 3) {
                        $total_records = mysqli_num_rows($result2);
                        $total_page = ceil($total_records / $limit);

                        echo "<ul class='pagination'>";

                        if ($page > 1) {
                            echo '<li><a href="author.php?id=' . ($user_id) . '&page=' . ($page - 1) . '">Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }

                            echo "<li class = '{$active}'><a href='author.php?id='. ($user_id) .'&page={$i}'> {$i} </a></li>";
                        }

                        if ($total_page > $page) {
                            echo '<li><a href="author.php?id=' . ($user_id) . '&page=' . ($page + 1) . '">Next</a></li>';
                        }
                        echo "</ul>";
                    }

                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>