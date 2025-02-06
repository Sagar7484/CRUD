<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
include("/xampp/htdocs/EmpCrud/db/dbconnection.php");
$id= $_GET['id'];
$query= "delete from employee where eid ='$id'";
$result= mysqli_query($con,$query) ;


if($result)
{
    echo "<script>window.location.href='viewData.php';
     </script>  ";
}
else
{
    echo "<script>Alert('Record Failed to Delete..!');
    window.location.href='viewData.php';
     </script>  ";
}
    ?>
</body>
</html>