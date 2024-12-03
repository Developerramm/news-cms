<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php 
                        include "config.php";
                        if(isset($_GET['search'])){
                            $search_term = $_GET['search'];

                            if($search_term == ""){
                                header("Location:{$hostname}");
                            }
                        }



                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $limit = 3;
                        $offset = ($page - 1) * $limit;

                        $sql = "SELECT * FROM post JOIN user ON post.author = user.user_id JOIN category ON post.category = category.category_id WHERE post.title LIKE '%{$search_term}%' OR user.username LIKE '%{$search_term}%' OR category.category_name LIKE '%{$search_term}%' ORDER BY post_id DESC LIMIT {$offset},{$limit}";
                        $result = mysqli_query($conn,$sql) or die("Query failed");
                    
                    ?>
                  <h2 class="page-heading">Search : <?php echo $search_term; ?> </h2>
                  
                      <?php 
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
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
                                    <h3><a href='single.php?id=<?= $row['post_id']; ?>'>
                                    <?= $row['title']; ?>
                                    </a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?= $row['category_id']; ?>'>
                                                <?= $row['category_name']; ?></a>
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
                                    <p class="description">
                                    <?php echo substr($row['description'],0,125); ?>...
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?= $row['post_id']; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    } 
                    } else{
                        echo "<h2>No Record Found.</h2>";
                    } 

                    $sql1 = "SELECT * FROM post JOIN user ON post.author = user.user_id JOIN category ON post.category = category.category_id WHERE post.title LIKE '%{$search_term}%' OR user.username LIKE '%{$search_term}%' OR category.category_name LIKE '%{$search_term}%'";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed");

                    if (mysqli_num_rows($result1) > 3) {
                        $total_records = mysqli_num_rows($result1);
                        $total_page = ceil($total_records / $limit);
    
                        echo "<ul class='pagination'>";
                        
                        if ($page > 1) {
                            echo '<li><a href="search.php?search='. ($search_term) .'&page=' . ($page - 1) . '">Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            ?>
                            <li class="<?php echo $active; ?>">
                                <a href="search.php?search=<?php echo $search_term; ?>&page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
                            </li>

                           <?php  
                        }
    
                        if ($total_page > $page) {
                            echo '<li><a href="search.php?search='. ($search_term) .'&page=' . ($page + 1) . '">Next</a></li>';
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
