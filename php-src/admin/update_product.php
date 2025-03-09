<?php
require_once '../connection.php';

if(isset($_GET['id'])){
    $id=$_GET['id'];
}

if(!empty($_POST)){
    $brand = $_POST['brand'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $image = '';

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $path = 'uploads/';

        move_uploaded_file($tmp, $path . $image);
    }


    $sql = "UPDATE product SET brand='$brand',color='$color',price='$price',
    category_id='$category_id',quantity='$quantity',description='$description',image='$image'
     WHERE id=$id" ;

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "<script>alert('Updated successfully');</script>";
        echo "<script>window.location.href='products.php';</script>";
        exit;
    } 
    
    else{
        echo "<script>alert('Failed to Add');</script>";
    }
}

$categoryOptions = "";
$catsql = "SELECT * FROM category";
$catresult = $conn->query($catsql);

if ($catresult->num_rows > 0) {
    while ($row = $catresult->fetch_assoc()) {
        $categoryOptions .= "<option value='" . $row["id"] . "'>" . $row["cat_name"] . "</option>";
    }
}

$updatesql="SELECT * FROM product WHERE id=$id";
$updateresult=mysqli_query($conn,$updatesql);

while($row=mysqli_fetch_assoc($updateresult)){





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        .back{
            position: relative;
            bottom: 200px;
            padding: 10px 25px;
            right:350px;
        }
    </style>
</head>
<body>
<a href="admin_dashboard.php"><button class="back">Back</button></a>
    <form action="" method="post"enctype="multipart/form-data">
        <label for="brand">Brand</label>
        <input type="text" id="brand" value='<?=$row['brand']?>' name="brand"><br>

        <label for="color">Color</label>
        <input type="text" id="color" value='<?=$row['color']?>'name="color"><br>

        
        <label for="image">Image</label>
        <input type="file" name="image"value='<?=$row['image']?>' required>

      

        <label for="category_id">Category</label>
        <select id="category_id" name="category_id">
            <option value="">Select Category</option>
            <?php echo $categoryOptions; ?>
        </select><br><br>

        <label for="quantity">Quantity</label>
        <input type="text" id="quantity" value='<?=$row['quantity']?>' name="quantity"><br>

        <label for="price">Price</label>
        <input type="text" id="price" value='<?=$row['price']?>' name="price"><br>

        <label for="description">Description</label>
        <input type="text" id="description" value='<?=$row['description']?>' name="description"><br>

        <button type="submit">Update</button>

        <?php } ?>


    </form>
</body>
</html>
