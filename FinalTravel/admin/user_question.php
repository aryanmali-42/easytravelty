<?php
require('inc/essentials.php');
require('../connection.php');
adminLogin();
if (isset($_GET['seen'])) {
    $frm_data = filteration($_GET);
    if ($frm_data['seen'] == 'all') {
        $q = "UPDATE `user_queries` SET `seen`=? ";
        $values = [1];
        if (update($q, $values, 'i')) {
            alert('success', 'Marked All Read !');
        } else {
            alert('error', 'Failed to mark as seen');
        }
    } else {
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values = [1, $frm_data['seen']];
        if (update($q, $values, 'ii')) {
            alert('success', 'Mark as seen !');
        } else {
            alert('error', 'Failed to mark as seen');
        }
    }
}
if (isset($_GET['del'])) {
    $frm_data = filteration($_GET);
    if ($frm_data['del'] == 'all') {
        $q = "DELETE FROM `user_queries` ";

        if (mysqli_query($con, $q)) {
            alert('success', 'All Data Deleted');
        } else {
            alert('error', 'Failed to mark as seen');
        }
    } else {
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if (ddelete($q, $values, 'i')) {
            alert('success', 'Data deleted');
        } else {
            alert('error', 'Failed to mark as seen');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Questions</title>
    <?php
    require('inc/links.php');
    ?>

    <style>

    </style>
</head>

<body>


    <?php require('inc/header.php') ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class=" mb-4">User Questions</h3>
                <!-- GEneral Settings -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body ">
                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-sm rounded-pill btn-success"><i
                                    class="bi bi-check-all"></i>Mark All Read</a>
                            <a href="?del=all" class="btn btn-sm rounded-pill btn-danger"><i
                                    class="bi bi-trash"></i>Delete All</a>
                        </div>
                        <div class="table-responsive-md" style="height: 430px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-light text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width="20%">Subject</th>

                                        <th scope="col" width="30%">Message</th>
                                        <th scope="col">Date</th>

                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";//navinn data var disel
                                    $data = mysqli_query($con, $q);
                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($data)) {
                                        $seen = '';

                                        // Check if the query is not marked as seen
                                        if ($row['seen'] != 1) {
                                            if (!empty($row['email'])) {
                                                // Create Gmail URL for contacting the user
                                                $contact_url = "https://mail.google.com/mail/?view=cm&fs=1&to=" . urlencode($row['email']) . "&subject=Regarding your query";

                                                // "Mark Read" button with email redirection
                                                $seen = "<a href='$contact_url' target='_blank' class='btn btn-sm rounded-pill btn-success' onclick='this.style.display=\"none\"'>Solve</a> <br>";
                                            }
                                        }

                                        // Add the Delete button
                                        $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";

                                        // Output the table row
                                        echo <<<query
                                        <tr>
                                            <td>$i</td>
                                            <td>$row[name]</td>
                                            <td>$row[email]</td>
                                            <td>$row[subject]</td>
                                            <td>$row[message]</td>
                                            <td>$row[date]</td>
                                            <td>$seen</td>    
                                        </tr>
                                    query;
                                        $i++;
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <?php require('inc/scripts.php') ?>

</body>

</html>