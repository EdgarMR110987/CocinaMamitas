<?php
$con = new mysqli("localhost", "root", "", "kusoftde_cocina_mamitas");
if ($con->connect_errno)
{
    echo "Fallo al contenctar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
    exit();
}
else
@mysqli_query($con, "SET NAMES 'utf8'");
?>