<?php
include 'config.php';

/* ADD */
if(isset($_POST['add_recipe'])){

    $category_id = intval($_POST['category_id']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $serve = mysqli_real_escape_string($conn,$_POST['serve']);

    mysqli_query($conn,"
        INSERT INTO recipe(category_id,name,serve)
        VALUES('$category_id','$name','$serve')
    ");

    header("Location: recipe.php");
    exit();
}

/* UPDATE */
if(isset($_POST['update_recipe'])){

    $id = intval($_POST['id']);
    $category_id = intval($_POST['category_id']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $serve = mysqli_real_escape_string($conn,$_POST['serve']);

    mysqli_query($conn,"
        UPDATE recipe SET
        category_id='$category_id',
        name='$name',
        serve='$serve'
        WHERE id='$id'
    ");

    header("Location: recipe.php");
    exit();
}

/* DELETE */
if(isset($_GET['delete'])){

    $id = intval($_GET['delete']);

    mysqli_query($conn,"
        DELETE FROM recipe
        WHERE id='$id'
    ");

    header("Location: recipe.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Recipe Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-4">

    <?php include 'nav.php'; ?>
   
    <div class="card-header bg-danger text-white">

            <h3 class="mb-0" style="padding:10px;">🍰 All Recipes
                <button class="btn btn-secondary" style="float:right;"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal">
                    + Add Recipe
                </button>
            </h3>

             
    </div>

    <table class="table table-bordered table-striped">

        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Recipe Name</th>
            <th>Serve</th>
            <th width="300">Action</th>
        </tr>

        <?php
        $result = mysqli_query($conn,"
            SELECT recipe.*,
                   category.name AS category_name
            FROM recipe
            LEFT JOIN category
            ON category.id = recipe.category_id
            ORDER BY recipe.id DESC
        ");

        while($row = mysqli_fetch_assoc($result)){
        ?>

        <tr>
            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['category_name']; ?></td>

            <td><?php echo $row['name']; ?></td>

            <td><?php echo $row['serve']; ?></td>

            <td>

                <button
                    class="btn btn-success btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#edit<?php echo $row['id']; ?>">
                     Edit
                </button>

                <a href="ingredients.php?id=<?php echo $row['id']; ?>"
                   class="btn btn-info btn-sm">
                    Add ingredients
                </a>

                <a href="?delete=<?php echo $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete Recipe?')">
                     Delete
                </a>

            </td>
        </tr>

        <!-- EDIT MODAL -->
        <div class="modal fade" id="edit<?php echo $row['id']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form method="post">

                        <div class="modal-header">
                            <h5>Edit Recipe</h5>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <input type="hidden"
                                   name="id"
                                   value="<?php echo $row['id']; ?>">

                            <label>Category</label>

                            <select name="category_id"
                                    class="form-control"
                                    required>

                                <?php
                                $cats = mysqli_query($conn,"SELECT * FROM category ORDER BY name ASC");

                                while($cat = mysqli_fetch_assoc($cats)){
                                ?>

                                <option value="<?php echo $cat['id']; ?>"
                                <?php if($cat['id']==$row['category_id']) echo "selected"; ?>>

                                    <?php echo $cat['name']; ?>

                                </option>

                                <?php } ?>

                            </select>

                            <br>

                            <label>Recipe Name</label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="<?php echo $row['name']; ?>"
                                   required>

                            <br>

                            <label>Serve</label>

                            <input type="text"
                                   name="serve"
                                   class="form-control"
                                   value="<?php echo $row['serve']; ?>"
                                   required>

                        </div>

                        <div class="modal-footer">

                            <button type="submit"
                                    name="update_recipe"
                                    class="btn btn-success">
                                Update Recipe
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

                    <h5>Add Recipe</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <label>Category</label>

                    <select name="category_id"class="form-control"required>
                        <option value="">Select Category</option>
						
                        <?php
                        $cats = mysqli_query($conn,"SELECT * FROM category ORDER BY name ASC");
                        while($cat = mysqli_fetch_assoc($cats)){
                        ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                        <?php } ?>
						
                    </select>

                    <br>

                    <label>Recipe Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="e.g Chocolate Cake"
                           required>

                    <br>

                    <label>Serve</label>

                    <input type="text"
                           name="serve"
                           class="form-control"
                           placeholder="e.g 4 Persons"
                           required>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            name="add_recipe"
                            class="btn btn-primary">
                        Save Recipe
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>