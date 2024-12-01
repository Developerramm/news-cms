<?php include "header.php";
include "config.php";
// session_start();
if ($_SESSION['role'] == 0) {
    header("Location:{$hostname}/admin/post.php");
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->

                <?php
                include "config.php";
                $id = mysqli_real_escape_string($conn, $_GET['id']);

                $sql = "SELECT * FROM user WHERE user_id = {$id}";

                $result = mysqli_query($conn, $sql) or die("Query Failed");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                        <form action="update-user-data.php" method="POST">
                            <div class="form-group">
                                <input
                                    type="hidden"
                                    name="user_id" class="form-control" value="<?= $row['user_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control"
                                    value="<?= $row['first_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control"
                                    value="<?= $row['last_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control"
                                    value="<?= $row['username'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?php echo $row['role'] ? $select = "selected" : $select = ""; ?>">
                                    <option <?php echo $select ?> value="0">User</option>
                                    <option <?php echo $select ?> value="1">Admin</option>
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php }
                } ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>