<?php
require('../../connection.php');
require('../inc/essentials.php');
adminLogin();
if (isset($_POST['add_package'])) {
    $features = filteration(json_decode($_POST['features']));  //pheile tho assiciotave array madhe covert hoil , json to non json  converts the JSON string into a PHP associative array.
    $facilities = filteration(json_decode($_POST['facilities']));  //pheile tho assiciotave array madhe covert hoil , json to non json
    $frm_data = filteration($_POST);

    $q1 = "INSERT INTO packages( `name`, `duration`, `price`, `travel_mode`,`date`, `adult`, `category`, `description`,`iternity`) VALUES (?,?,?,?,?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['duration'], $frm_data['price'], $frm_data['travel_mode'], $frm_data['date'], $frm_data['adult'], $frm_data['category'], $frm_data['desc'], $frm_data['iter']];
    if (insert($q1, $values, 'siississs')) {
        $flag = 1;
    }
    $package_id = mysqli_insert_id($con);//yek autoincrement vzalue se layega  value id 1 2 3 4 5 6 for sr no  
    //insert id most resent id denar\]-
    $q2 = "INSERT INTO package_facilities(package_id, facilities_id) VALUES (?,?)";
    // prepared statement  ffor executuin speed query yek yek baar prepare na ho  insert se bhi hota haiii
    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $package_id, $f);
            mysqli_stmt_execute($stmt);

        }
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot ne prepared - insert');
    }
    $q3 = "INSERT INTO package_features(package_id, features_id) VALUES (?,?)";
    // prepared statement  ffor executuin speed query yek yek baar prepare na ho  insert se bhi hota haiii
    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $package_id, $f);
            mysqli_stmt_execute($stmt);

        }
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot ne prepared - insert');
    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}
if (isset($_POST['get_all_packages'])) {
    $res = select("SELECT * FROM `packages` WHERE `removed`=?", [0], 'i');
    $i = 1;
    $data = "";
    while ($row = mysqli_fetch_assoc($res)) {

        if ($row['status'] == 1) {
            $status = " <button onclick='toggleStatus($row[id],0)' class='btn btn-info btn-sm shadow-none'>active</button>";

        } else {
            $status = " <button onclick='toggleStatus($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
        }
        $data .= "
            <tr class='align-middle'>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[duration]</td>
                <td>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Adult: $row[adult]
                    </span><br>
                 
                </td>   
                  <td>
                   
                    <span class='badge rounded-pill bg-light text-dark'>
                        	Category: $row[category]
                    </span>
                </td>   
                <td>₹$row[price] </td>
                <td>$row[travel_mode]</td>
    <td>" . date('d-m-Y', strtotime($row['date'])) . "</td>
                <td>$status</td>
                
                <td>
                
                    <button type='button' onclick='edit_details($row[id])' class='btn btn-danger btn-sm shadow-none' data-bs-toggle='modal' data-bs-target='#edit-package'>
                        <i class='bi bi-pencil-square'></i> 
                    </button>
                            <button type='button' onclick=\"package_images($row[id],'$row[name]')\" class='btn btn-info btn-sm shadow-none' data-bs-toggle='modal' data-bs-target='#package-images'>
                        <i class='bi bi-images'></i> 
                    </button>
                    </button>
                            <button type='button' onclick='remove_package($row[id])' class='btn btn-danger btn-sm shadow-none' >
                        <i class='bi bi-trash'></i> 
                    </button>
                </td>
            </tr>";
        $i++;
    }
    echo $data;
}
if (isset($_POST['toggleStatus'])) {
    $frm_data = filteration($_POST);
    $q = "UPDATE packages SET status=? WHERE id=?";
    $v = [$frm_data['value'], $frm_data['toggleStatus']];
    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}
if (isset($_POST['get_package'])) {
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `packages` WHERE `id`=?", [$frm_data['get_package']], datatypes: 'i');
    $res2 = select("SELECT * FROM `package_features` WHERE `package_id`=?", [$frm_data['get_package']], datatypes: 'i');
    $res3 = select("SELECT * FROM `package_facilities` WHERE `package_id`=?", [$frm_data['get_package']], datatypes: 'i');
    $packagedata = mysqli_fetch_assoc($res1);
    $features = [];
    $facilities = [];
    //yek se jadya facility
    if (mysqli_num_rows($res2) > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            array_push($features, $row['features_id']);
        }
    }

    //yek se jadya facility
    if (mysqli_num_rows($res3) > 0) {
        while ($row = mysqli_fetch_assoc($res3)) {
            array_push($facilities, $row['facilities_id']);
        }
    }


    //associtive array
    $data = ["packagedata" => $packagedata, "features" => $features, "facilities" => $facilities];
    $data = json_encode($data);//json me convert keya
    echo $data;
}
if (isset($_POST['edit_package'])) {
    $features = filteration(json_decode($_POST['features']));  //pheile tho assiciotave array madhe covert hoil , json to non json
    $facilities = filteration(json_decode($_POST['facilities']));  //pheile tho assiciotave array madhe covert hoil , json to non json
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "UPDATE `packages` SET `name`=?,`duration`=?,`price`=?,`travel_mode`=?,`date`=?,`adult`=?,`category`=?,`description`=?,`iternity`=? WHERE `id`=?";

    $values = [$frm_data['name'], $frm_data['duration'], $frm_data['price'], $frm_data['travel_mode'], $frm_data['date'], $frm_data['adult'], $frm_data['category'], $frm_data['desc'], $frm_data['iter'], $frm_data['package_id']];
    if (update($q1, $values, 'siississsi')) {
        $flag = 1;
    }
    $del_features = ddelete("DELETE FROM `package_features` WHERE `package_id`=?", [$frm_data['package_id']], 'i');
    $del_facilities = ddelete("DELETE FROM `package_facilities` WHERE `package_id`=?", [$frm_data['package_id']], 'i');
    if (!($del_facilities && $del_features)) {
        $flag = 0;
    }
    //mysqli_query($con, "SET foreign_key_checks = 0");
    // Perform the INSERT operation
    $q2 = "INSERT INTO `package_facilities` (`package_id`, `facilities_id`) VALUES (?, ?)";

    $stmt = mysqli_prepare($con, $q2);

    // prepared statement  ffor executuin speed query yek yek baar prepare na ho  insert se bhi hota haiii
    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['package_id'], $f);
            mysqli_stmt_execute($stmt);

        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot ne prepared - insert');
    }
    // mysqli_query($con, "SET foreign_key_checks = 1");

    //mysqli_query($con, "SET foreign_key_checks = 0");
    $q3 = "INSERT INTO `package_features`(`package_id`, `features_id`) VALUES (?,?)";
    // prepared statement  ffor executuin speed query yek yek baar prepare na ho  insert se bhi hota haiii
    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['package_id'], $f);
            mysqli_stmt_execute($stmt);

        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot ne prepared - insert');
    }
    //  mysqli_query($con, "SET foreign_key_checks = 1");
    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}
if (isset($_POST['add_image'])) {
    $frm_data = filteration($_POST);
    #function alag alag folder me uplaoad karega data
    $img_r = uploadImage($_FILES['image'], PACKAGE_FOLDER);
    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'upd_failed') {
        echo $img_r;
    } else {
        $q = "INSERT INTO `package_image`( `package_id`, `image`) VALUES (?,?)";
        $values = [$frm_data['package_id'], $img_r];
        $res = insert($q, $values, 'ss');
        echo $res;
    }
}
if (isset($_POST['get_package_images'])) {
    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `package_image` WHERE `package_id`=? ", [$frm_data['get_package_images']], 'i');
    $path = PACKAGE_IMG_PATH;
    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['thumb'] == 1) {
            $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
        } else {
            $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[package_id])' class='btn btn-secondary  shadow-none'>
                       <i class='bi bi-check-lg '></i>
                    </button>";
        }
        echo <<<data
            <tr class='align-middle'>
                <td><img src='$path$row[image]' class='img-fluid'></td>
                <td>$thumb_btn</td>
                <td>
                    <button onclick='rem_image($row[sr_no],$row[package_id])' class='btn btn-danger  shadow-none'>
                        <i class='bi bi-trash'></i>
                    </button>

                </td>
            </tr>
        data;
    }

}
if (isset($_POST['rem_image'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['image_id'], $frm_data['package_id']];
    $pre_q = "SELECT * FROM `package_image` WHERE `sr_no`=? AND   `package_id` =?";
    $res = select($pre_q, $values, 'ii');
    $img = mysqli_fetch_assoc($res);
    if (deleteImage($img['image'], PACKAGE_FOLDER)) {
        $q = "DELETE FROM `package_image` WHERE `sr_no`=? AND   `package_id` =?";
        $res = ddelete($q, $values, 'ii');
        echo $res;
    }
}
if (isset($_POST['thumb_image'])) {
    $frm_data = filteration($_POST);

    $pre_q = "UPDATE `package_image` SET `thumb`=? WHERE `package_id`=?";
    $pre_v = [0, $frm_data['package_id']];
    $pre_res = update($pre_q, $pre_v, 'ii');

    $q = "UPDATE `package_image` SET `thumb`=? WHERE `sr_no`=? AND `package_id`=?";
    $v = [1, $frm_data['image_id'], $frm_data['package_id']];
    $res = update($q, $v, 'iii');

    echo $res;
}
if (isset($_POST['remove_package'])) {
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `package_image` WHERE `package_id`=?", [$frm_data['package_id']], 'i');
    while ($row = mysqli_fetch_assoc($res1)) {
        deleteImage($row['image'], PACKAGE_FOLDER);
    }
    $res2 = ddelete("DELETE FROM `package_image` WHERE `package_id`=?", [$frm_data['package_id']], 'i');
    $res3 = ddelete("DELETE FROM `package_features` WHERE `package_id`=?", [$frm_data['package_id']], 'i');
    $res4 = ddelete("DELETE FROM `package_facilities` WHERE `package_id`=?", [$frm_data['package_id']], 'i');
    $res5 = update("UPDATE `packages` SET `removed`=? WHERE `id`=? ", [1, $frm_data['package_id']], 'ii');

    if ($res2 || $res3 || $res4 || $res5) {
        echo 1;

    } else {
        echo 0;
    }
}
?>