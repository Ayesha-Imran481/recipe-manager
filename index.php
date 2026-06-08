<?php
include 'config.php';

$recipe_id = 0;
$persons = 0;
$recipe = null;

if(isset($_POST['calculate'])){

    $recipe_id = intval($_POST['recipe_id']);
    $persons   = floatval($_POST['number']);

    $recipe_query = mysqli_query($conn,"
        SELECT *
        FROM recipe
        WHERE id='$recipe_id'
    ");

    $recipe = mysqli_fetch_assoc($recipe_query);
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

    <?php include 'nav.php'; ?>

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">🍰 Recipe Calculator</h3>
            <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addModal">
            + Add Ingredient
        </button>
        </div>

        <div class="card-body">

           

            <form method="post">

                <div class="row">

                    <div class="col-md-5">
                        <label class="form-label">
                            Select Recipe
                        </label>

                        <select name="recipe_id"
                                class="form-select"
                                required>

                            <option value="">
                                Select Recipe
                            </option>

                            <?php
                            $recipes = mysqli_query($conn,"
                                SELECT *
                                FROM recipe
                                ORDER BY name ASC
                            ");

                            while($r = mysqli_fetch_assoc($recipes)){
                            ?>

                            <option value="<?php echo $r['id']; ?>"
                            <?php if($recipe_id==$r['id']) echo 'selected'; ?>>

                                <?php echo $r['name']; ?>

                            </option>

                            <?php } ?>

                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">
                            Persons
                        </label>

                        <input type="number"
                               name="number"
                               class="form-control"
                               min="1"
                               value="<?php echo $persons; ?>"
                               required>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button type="submit"
                                name="calculate"
                                class="btn btn-primary w-100">
                            Calculate
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <?php if($recipe){ ?>

    <div class="card shadow mt-4">

        <div class="card-header">

            <h4 class="mb-1">
                <?php echo $recipe['name']; ?>
            </h4>

            <small>
                Original Serve:
                <strong><?php echo $recipe['serve']; ?></strong>
            </small>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead class="table-dark">

                    <tr>
                        <th>Ingredient</th>
                        <th>Original Qty</th>
                        <th>Required Qty</th>
                        <th>Unit</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    $materials = mysqli_query($conn,"
                        SELECT *
                        FROM materials
                        WHERE recipe_id='$recipe_id'
                        ORDER BY name ASC
                    ");

                    while($row = mysqli_fetch_assoc($materials)){

                        $original_qty = floatval($row['qty']);
                        $serve = floatval($recipe['serve']);

                        if($persons > 0 && $serve > 0){

                            $new_qty = round(
                                ($original_qty / $serve) * $persons,
                                2
                            );

                        }else{

                            $new_qty = $original_qty;
                        }
                    ?>

                    <tr>

                        <td><?php echo $row['name']; ?></td>

                        <td><?php echo $original_qty; ?></td>

                        <td>
                            <strong>
                                <?php echo $new_qty; ?>
                            </strong>
                        </td>

                        <td><?php echo $row['unit']; ?></td>

                    </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <?php } ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>