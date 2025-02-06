<?php

include("/xampp/htdocs/EmpCrud/db/dbconnection.php");


if (isset($_GET['searchbtn'])) 
{
    $SearchBy = $_GET['searchList'];
    $SearchText = $_GET['search'];
    if ($SearchBy == "Id") 
    {
        $query = "select * from employee where eid='$SearchText'";
    } else if ($SearchBy == "Name")
    {
        $query = "select * from employee where name='$SearchText'";
    } else if ($SearchBy == "Salary") 
    {
        $query = "select * from employee where salary='$SearchText'";
    }
    $run = mysqli_query($con, $query);
} else {
    $query = "select * from employee";
    $run = mysqli_query($con, $query);
}
function btn()
{
    global $SearchBy;
    if ($SearchBy) {
        return "<a class='btn btn-outline-primary btn-sm mb-2' href='viewData.php'>Back</a>";
    } else {
        return "";
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
    <div class="col-12  mt-3 border shadow p-4">
    <div class="col-12  mt-3 border shadow p-4">
        <h3 class="display-6 text-center"> Employee Data</h3>
        <?php
        echo btn();
        ?>
        <table class="table table-bordered" syyle="width:100%">
            <tr>
                <th>Employee Id</th>
                <th>Employee Name</th>
                <th>Age</th>
                <th>Salary</th>
                <th>Mobile No</th>
                <th>Image</th>
                <th>Resume</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($data = mysqli_fetch_assoc($run)) {
                echo "
                <tr>
                    <td>" . $data['eid'] . "</td>
                   <td>" . $data['name'] . "</td>
                    <td>" . $data['age'] . "</td>
                   <td>" . $data['salary'] . "</td>
                    <td>" . $data['mono'] . "</td>
                    <td> <img src='".$data['image']."' height='50' width='50'></td>
                   <td><a href='" . $data['file_path'] . "' target='_blank'>" . $data['file_name'] . "</a></td>

                    <td>
                    <a href='delete.php?id=$data[eid]' class='btn btn-danger' onclick='return Confirmation()'>Delete</a>
                  <a href='update.php?id=$data[eid]' class='btn btn-success'>Update</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
        <a href="insertRecord.php" class="btn btn-dark w-100">Insert Record</a>
        <form action="" method="get">
            <label class="fs-4 mt-2 border mb-2 bg-light">Search By -</label>
            <select name="searchList" class="form-control">
                <option value="Select">Select</option>
                <option value="Id">Id</option>
                <option value="Name">Name</option>
                <option value="Salary">Salary</option>
            </select>
            <input type="text" name="search" value="" class="form-control mt-2">
            <input type="submit" value="Search" required name="searchbtn" class="btn btn-info mt-2 w-100">
        </form>
    </div>
</body>
<script>
    function Confirmation() {
        return confirm("Are You Sure to Delete Data??");
    }
</script>
</html>