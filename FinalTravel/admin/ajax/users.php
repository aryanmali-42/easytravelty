<?php
require('../../connection.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_users'])) {
    $res = selectAll('user_cred');
    $i = 1;
    $data = "";
    $path = USERS_IMG_PATH;
    while ($row = mysqli_fetch_assoc($res)) {
        $del_btn = "        </button>
                            <button type='button' onclick='remove_user($row[id])' class='btn btn-danger btn-sm shadow-none' >
                        <i class='bi bi-trash'></i> 
                    </button>";
        $status = "<button onclick='toggleStatus($row[id],0)' class='btn btn-info btn-sm shadow-none'>active</button>";
        if (!$row['status']) {
            $status = "<button onclick='toggleStatus($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Ban</button>";

        }

        $date = date("d-m-Y ", strtotime($row['datetime']));

        $data .= "
        <tr>
           <td>$i</td>
           <td>
                <img src='$path$row[profile]' width='55px'>
                <br/>
                $row[name]</td>
           <td>$row[email]</td>
           <td>$row[phonenum]</td>
           <td>$row[address]</td>
           <td>$date</td>
           <td>$status</td>
           <td>$del_btn</td>

        </tr>


           ";
        $i++;
    }
    echo $data;
}
if (isset($_POST['toggleStatus'])) {
    $frm_data = filteration($_POST);
    $q = "UPDATE `user_cred` SET `status`=? WHERE id=?";
    $v = [$frm_data['value'], $frm_data['toggleStatus']];
    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}
if (isset($_POST['remove_users'])) {
    $frm_data = filteration($_POST);
    $res = ddelete("DELETE FROM `user_cred`  WHERE `id`=?  ", [$frm_data['user_id']], 'i');

    if ($res) {
        echo 1;

    } else {
        echo 0;
    }
}
if (isset($_POST['search_users'])) {
    $frm_data = filteration($_POST);
    $query = "SELECT * FROM `user_cred` WHERE `name` LIKE ?"; //pattern dhudne ke leay like use krte hai for searching
    $res = select($query, ["%$frm_data[name]%"], 's');//pure name naam ke column me check karega "%$frm_data[name]%"
    $i = 1;
    $data = "";
    $path = USERS_IMG_PATH;
    while ($row = mysqli_fetch_assoc($res)) {
        $del_btn = "        </button>
                            <button type='button' onclick='remove_user($row[id])' class='btn btn-danger btn-sm shadow-none' >
                        <i class='bi bi-trash'></i> 
                    </button>";
        $status = "<button onclick='toggleStatus($row[id],0)' class='btn btn-info btn-sm shadow-none'>active</button>";
        if (!$row['status']) {
            $status = "<button onclick='toggleStatus($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Ban</button>";

        }

        $date = date("d-m-Y ", strtotime($row['datetime']));

        $data .= "
        <tr>
           <td>$i</td>
           <td>
                <img src='$path$row[profile]' width='55px'>
                <br/>
                $row[name]</td>
           <td>$row[email]</td>
           <td>$row[phonenum]</td>
           <td>$row[address]</td>
           <td>$date</td>
           <td>$status</td>
           <td>$del_btn</td>

        </tr>


           ";
        $i++;
    }
    echo $data;
}
?>