<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial
scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("/xampp/htdocs/EmpCrud/db/dbconnection.php");
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Upload Image:</label>
        <input type="file" name="ImageUpload" required><br><br>
        <input type="submit" value="Upload" name="UploadBtn">
    </form>

    <?php

$query = "select * from image_data";
$result = mysqli_query($con, $query);
$totalRows = mysqli_num_rows($result);

if ($totalRows > 0) {
    echo "<table border='1'>
<tr>
<th>Image</th>
</tr>
";

while ($row = mysqli_fetch_array($result)) {
    echo "
    <tr>
    <td><img src='$row[0]' height='150' width='150'> </td>
    </tr>
    ";
}}
?>


    <?php
    if (isset($_POST["UploadBtn"])) {
        // print_r($_FILES['ImageUpload']);

        $image_name = $_FILES['ImageUpload']['name'];
        $image_size = $_FILES['ImageUpload']['size'];
        $image_type = $_FILES['ImageUpload']['type'];
        $temp_name = $_FILES['ImageUpload']['tmp_name'];
        $folder = "Images/";

        if ($image_size <= 1000000) //1mb
        {
            $folder = "Images/" . $image_name;
            $query = "insert into image_data(image_path) values('$folder')";
            $result = mysqli_query($con, $query);
            if ($result)
            {
                move_uploaded_file($temp_name, $folder);
                echo "File Uploaded..!";
            } else
            {
                echo "Failed..!";
            }
        }
    }
    ?>

</body>

</html>