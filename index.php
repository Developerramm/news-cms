<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">

                        <?php
                    include 'config.php';

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $limit = 3;
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT post.title, post.description,post.post_img,post.post_date,user.username, category.category_name,post.post_id,category.category_id,user.user_id FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id ORDER BY post_id DESC LIMIT {$offset},{$limit}";
                    $result = mysqli_query($conn, $sql) or die("Query failed");

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?= $row['post_id']; ?>">
                                            <img src="./admin/upload/<?= $row['post_img']; ?>" alt="" />
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?= $row['post_id']; ?>'> <?= $row['title']; ?> </a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?= $row['category_id'] ?>'><?= $row['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?id=<?php echo $row['user_id'] ?>'>
                                                        <?= $row['username']; ?>
                                                    </a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?= $row['post_date'];  ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'],0,120); ?>...
                                            </p>
                                            <a class='read-more pull-right'
                                             href='single.php?id=<?= $row['post_id']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    $sql1 = "SELECT * FROM post";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed");

                    if (mysqli_num_rows($result1) > 0) {
                        $total_records = mysqli_num_rows($result1);
                        $total_page = ceil($total_records / $limit);
    
                        echo "<ul class='pagination'>";
    
                        if ($page > 1) {
                            echo '<li><a href="index.php?page=' . ($page - 1) . '">Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
    
                            echo "<li class = '{$active}'><a href='index.php?page={$i}'> {$i} </a></li>";
                        }
    
                        if ($total_page > $page) {
                            echo '<li><a href="index.php?page=' . ($page + 1) . '">Next</a></li>';
                        }
                        echo "</ul>";
                    }

                    ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>