<?php
require('inc/essentials.php');
require('../connection.php');
adminLogin();
if (isset($_GET['seen'])) {
    $frm_data = filteration($_GET);
    if ($frm_data['seen'] == 'all') {
        $q = "UPDATE `rating_review` SET `seen`=? ";
        $values = [1];
        if (update($q, $values, 'i')) {
            alert('success', 'Marked All Read !');
        } else {
            alert('error', 'Failed to mark as seen');
        }
    } else {
        $q = "UPDATE `rating_review` SET `seen`=? WHERE `sr_no`=?";
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
        $q = "DELETE FROM `rating_review` ";

        if (mysqli_query($con, $q)) {
            alert('success', 'All Data Deleted');
        } else {
            alert('error', 'Failed to mark as seen');
        }
    } else {
        $q = "DELETE FROM `rating_review` WHERE `sr_no`=?";
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
    <title>Admin Panel - Ratings And Reviews</title>
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
                <h3 class=" mb-4">RATINGS AND REVIEWS</h3>
                <!-- GEneral Settings -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body ">
                        <div class="text-end mb-4">
                            <!-- <a href="?seen=all" class="btn btn-sm rounded-pill btn-success"><i
                                    class="bi bi-check-all"></i>Mark All Read</a> -->
                            <a href="?del=all" class="btn btn-sm rounded-pill btn-danger"><i
                                    class="bi bi-trash"></i>Delete All</a>
                        </div>
                        <div class="table-responsive-md" ">
                            <table class=" table table-hover border">
                            <thead class="">
                                <tr class="bg-light text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Package Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Review</th>
                                    <th scope="col">Date</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //ithe 2 column cha same name ahe 
                                $q = "SELECT rr.*,uc.name AS uname, p.name AS pname  FROM `rating_review` rr 
                                INNER JOIN `user_cred` uc ON rr.user_id=uc.id
                                INNER JOIN `packages` p ON rr.package_id=p.id
                                ORDER BY `sr_no` DESC";

                                //navinn data var disel
                                $data = mysqli_query($con, $q);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($data)) {
                                    $date = date('d-m-Y', strtotime($row['datentime']));

                                    $seen = '';
                                    if ($row['seen'] != 1) {
                                        // $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-success'>Mark Read</a> <br>";
                                    }
                                    $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";
                                    echo <<<query
                                        <tr>
                                        <td>$i</td>
                                        <td>$row[pname]</td>
                                        <td>$row[uname]</td>
                                        <td>$row[rating]</td>
                                        <td>$row[review]</td>
                                        <td>$date</td>
                                        <td>$seen</td>    
                                        <tr>
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