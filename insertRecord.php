<?php
if (isset($_POST["submitbtn"])) {
    include("/xampp/htdocs/EmpCrud/db/dbconnection.php");


    // Sanitize input
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $age = (int) $_POST['age'];
    $salary = (float) $_POST['salary'];
    $mono = mysqli_real_escape_string($con, $_POST['mono']);

    // Define Directories
    $image_folder = "uploads/images/";
    $resume_folder = "uploads/resumes/";

    // Create Directories if Not Exists
    if (!is_dir($image_folder)) {
        mkdir($image_folder, 0777, true); // Creates directories recursively
    }
    if (!is_dir($resume_folder)) {
        mkdir($resume_folder, 0777, true);
    }

    // Image Upload Handling
    $image_name = $_FILES['ImageUpload']['name'];
    $image_size = $_FILES['ImageUpload']['size'];
    $temp_name = $_FILES['ImageUpload']['tmp_name'];
    $image_path = $image_folder . basename($image_name);

    // Resume Upload Handling
    $resume_name = $_FILES['resume']['name'];
    $resume_size = $_FILES['resume']['size'];
    $resume_temp = $_FILES['resume']['tmp_name'];
    $resume_path = $resume_folder . basename($resume_name);

    $fileType = strtolower(pathinfo($resume_path, PATHINFO_EXTENSION));
    $allowedTypes = array("pdf", "doc", "docx");

    // Validate Image Size (Max 1MB)
    if ($image_size > 1000000) {
        echo "Image size must be less than 1MB.";
        exit();
    }

    // Validate Resume File Type and Size (Max 2MB)
    if (!in_array($fileType, $allowedTypes) || $resume_size > 2 * 1024 * 1024) {
        echo "Invalid resume format or size!";
        exit();
    }

    // Move Files
    if (move_uploaded_file($temp_name, $image_path) && move_uploaded_file($resume_temp, $resume_path)) {
        // Use Prepared Statement
        $query = "INSERT INTO employee (name, age, salary, mono, image, file_name, file_path) VALUES ('$name','$age','$salary','$mono','$image_path','$resume_name,','$resume_path')";
        $stmt = mysqli_prepare($con, $query);
        

        if (mysqli_stmt_execute($stmt)) {
            header('location:viewData.php');
        } else {
            echo "Database Error: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "File upload failed!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="col-5 offset-4 mt-3 border shadow p-3">
        <h3 class="fs-3 text-center">Insert Record</h3>
        <form action="#" method="post" enctype="multipart/form-data">
            Enter Name:
            <input type="text" name="name"><br><br>

            Enter Age:
            <input type="text" name="age"><br><br>

            Enter Salary:
            <input type="text" name="salary"><br><br>

            Enter Mobile No:
            <input type="text" name="mono"><br><br>

            Upload Image:
            <input type="file" name="ImageUpload" required><br><br>

            Upload Resume:
            <input type="file" name="resume" id="resume" required><br><br>
    

            <input type="submit" value="insert" class="btn btn-info w-100" name="submitbtn">
        </form>
    </div>
</body>



</html>