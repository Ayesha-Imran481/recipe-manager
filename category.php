<?php
include 'config.php';

/* ADD */
if(isset($_POST['add_category'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);

    mysqli_query($conn,"INSERT INTO category (name) VALUES('$name')");
    header("Location: index.php");
    exit();
}

/* UPDATE */
if(isset($_POST['update_category'])){
    $id   = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);

    mysqli_query($conn,"UPDATE category SET name='$name' WHERE id='$id'");
    header("Location: category.php");
    exit();
}

/* DELETE */
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);

    mysqli_query($conn,"DELETE FROM category WHERE id='$id'");
    header("Location: category.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Category Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3> Bakery Categories</h3>

        <button class="btn btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#addModal">
            ➕ Add Category
        </button>
		<a href="index.php" class="btn btn-secondary">
			Back to Home
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th width="180">Action</th>
        </tr>

        <?php
        $result = mysqli_query($conn,"SELECT * FROM category ORDER BY id DESC");

        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>
                <button
                    class="btn btn-success btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#edit<?php echo $row['id']; ?>">
                    ✏ Edit
                </button>
                <a href="?delete=<?php echo $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete Category?')">
                    🗑 Delete
                </a>
            </td>
        </tr> 
        <!-- EDIT MODAL -->
        <div class="modal fade" id="edit<?php echo $row['id']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form method="post">

                        <div class="modal-header">
                            <h5>Edit Category</h5>
                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <input type="hidden"
                                   name="id"
                                   value="<?php echo $row['id']; ?>">

                            <label>Category Name</label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="<?php echo $row['name']; ?>"
                                   required>

                        </div>

                        <div class="modal-footer">

                            <button type="submit"
                                    name="update_category"
                                    class="btn btn-success">
                                Update
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>

        <?php } ?>

    </table>

</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post">

                <div class="modal-header">
                    <h5>Add Category</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <label>Category Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="e.g Cakes"
                           required>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            name="add_category"
                            class="btn btn-primary">
                        Save Category
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>