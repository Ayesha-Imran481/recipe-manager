<?php
include 'config.php';

$recipe_id = $_GET['id'];

$recipe = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM recipe WHERE id='$recipe_id'")
);

if(!$recipe){
    die("Recipe not found");
}

/* ADD */
if(isset($_POST['add_material'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $qty  = mysqli_real_escape_string($conn,$_POST['qty']);
    $unit  = mysqli_real_escape_string($conn,$_POST['unit']);

    mysqli_query($conn,"
        INSERT INTO materials(recipe_id,name,qty, unit)
        VALUES('$recipe_id','$name','$qty','$unit')
    ");

    header("Location: ingredients.php?id=".$recipe_id);
    exit();
}

/* UPDATE */
if(isset($_POST['update_material'])){

    $id   = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $qty  = mysqli_real_escape_string($conn,$_POST['qty']);
    $unit  = mysqli_real_escape_string($conn,$_POST['unit']);

    mysqli_query($conn,"
        UPDATE materials
        SET name='$name',
            qty='$qty',
            unit='$unit'
        WHERE id='$id'
    ");

    header("Location: ingredients.php?id=".$recipe_id);
    exit();
}

/* DELETE */
if(isset($_GET['delete'])){

    $id = intval($_GET['delete']);

    mysqli_query($conn,"
        DELETE FROM materials
        WHERE id='$id'
    ");

    header("Location: ingredients.php?id=".$recipe_id);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Ingredients</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">

        <div>
            <h3>🥣 Ingredients</h3>
            <strong>Recipe:</strong>
            <?php echo $recipe['name']; ?>
        </div>

        <div>
            <a href="recipe.php" class="btn btn-secondary">
                ← Back
            </a>

            <button class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal">
                ➕ Add Ingredient
            </button>
        </div>

    </div>

    <table class="table table-bordered table-striped">

        <tr>
            <th>ID</th>
            <th>Ingredient Name</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th width="180">Action</th>
        </tr>

        <?php

        $result = mysqli_query($conn,"SELECT * FROM materials WHERE recipe_id='$recipe_id' ORDER BY id DESC");

        while($row=mysqli_fetch_assoc($result)){
        ?>
        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['name']; ?></td>

            <td><?php echo $row['qty']; ?></td>
            <td><?php echo $row['unit']; ?></td>

            <td>

                <button class="btn btn-success btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#edit<?php echo $row['id']; ?>">
                    ✏ Edit
                </button>

                <a href="?id=<?php echo $recipe_id; ?>&delete=<?php echo $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete Ingredient?')">
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

                            <h5>Edit Ingredient</h5>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"></button>

                        </div>

                        <div class="modal-body">

                            <input type="hidden"
                                   name="id"
                                   value="<?php echo $row['id']; ?>">

                            <label>Ingredient Name</label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="<?php echo $row['name']; ?>"
                                   required>

                            <br>

                            <label>Quantity</label>

                            <input type="text"
                                   name="qty"
                                   class="form-control"
                                   value="<?php echo $row['qty']; ?>"
                                   required>
							<br>
							
							<label>Unit</label>

							<select name="unit" class="form-control" required>
								<option value="Gram" <?php if($row['unit']=='Gram') echo 'selected'; ?>>Gram</option>
								<option value="Kg" <?php if($row['unit']=='Kg') echo 'selected'; ?>>Kg</option>
								<option value="ML" <?php if($row['unit']=='ML') echo 'selected'; ?>>ML</option>
								<option value="Liter" <?php if($row['unit']=='Liter') echo 'selected'; ?>>Liter</option>
								<option value="Piece" <?php if($row['unit']=='Piece') echo 'selected'; ?>>Piece</option>
								<option value="Cup" <?php if($row['unit']=='Cup') echo 'selected'; ?>>Cup</option>
								<option value="Tablespoon" <?php if($row['unit']=='Tablespoon') echo 'selected'; ?>>Tablespoon</option>
								<option value="Teaspoon" <?php if($row['unit']=='Teaspoon') echo 'selected'; ?>>Teaspoon</option>
							</select>
                        </div>

                        <div class="modal-footer">

                            <button type="submit"
                                    name="update_material"
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

                    <h5>Add Ingredient</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <label>Ingredient Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="e.g Flour"
                           required>

                    <br>

                    <label>Quantity</label>

                    <input type="text"
                           name="qty"
                           class="form-control"
                           placeholder="e.g 500 Gram"
                           required>
					<br>
					<label>Unit</label>

					<select name="unit" class="form-control" required>
						<option value="">Select Unit</option>
						<option value="Gram">Gram</option>
						<option value="Kg">Kg</option>
						<option value="ML">ML</option>
						<option value="Liter">Liter</option>
						<option value="Piece">Piece</option>
						<option value="Cup">Cup</option>
						<option value="Tablespoon">Tablespoon</option>
						<option value="Teaspoon">Teaspoon</option>
					</select>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            name="add_material"
                            class="btn btn-primary">
                        Save Ingredient
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>