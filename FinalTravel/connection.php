<?php

$con = mysqli_connect("localhost", "root", "", "easytravel");
if (mysqli_connect_error()) {
    echo "<script>alert('Cannot connext to database')";
    exit();
}
// function filteration($data)
// {
//     foreach ($data as $key => $value) {
//         $value = trim($value); //site_title = aryan __________trim space
//         $value = stripslashes($value); //
//         $value = strip_tags($value);
//         $value = htmlspecialchars($value);
//         $data[$key] = $value;
//     }
//     return $data;
// }
function filteration($data)
{
    foreach ($data as $key => $value) {
        $value = trim($value); // Extra spaces hata do (e.g., " Aryan " -> "Aryan").
        $value = stripslashes($value); // Backslashes (\) ko hata do
        $value = strip_tags($value); // HTML or PHP tags hata do (e.g., "<b>bold</b>" -> "bold")
        $value = htmlspecialchars($value); // Special HTML chars ko safe banate hain (e.g., "<" -> "&lt;")
        $data[$key] = $value; // Cleaned value ko wapas array mein daal do
    }
    return $data;
}
function select($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //...is splat operator stack overflow var bhetla 
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            die("QUERYT CANNOT BE EXECUTED - SELECT");

        }
    } else {
        die("QUERYT CANNOT BE Prepared - SELECT");
    }
}

function update($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //...is splat operator stack overflow var bhetla 
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            die("QUERYT CANNOT BE EXECUTED - Update");

        }
    } else {
        die("QUERYT CANNOT BE Prepared - Update");
    }
}
function insert($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //...is splat operator stack overflow var bhetla
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("QUERYT CANNOT BE EXECUTED - INSERT");
        }
    } else {
        die("QUERYT CANNOT BE Prepared - INSERT");
    }
}

function selectAll($table)
{
    $con = $GLOBALS['con'];
    $res = mysqli_query($con, "SELECT * FROM $table");
    return $res;
}
function ddelete($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values); //...is splat operator stack overflow var bhetla
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("QUERYT CANNOT BE EXECUTED - Delete");
        }
    } else {
        die("QUERYT CANNOT BE Prepared - Delete");
    }
}
?>