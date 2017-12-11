<?php
	require_once 'core/config.php';
	$db = new Database(); // Tao 1 doi tuong Database moi
	$db::getInstance(); // Ket noi voi csdl
    // Lay tat ca ban ghi trong bang users
    echo "<h1>Select All Data</h1>";
    if (!$db->get_info('users')->error()){ // kiem tra k co loi
        if ($db->count() > 0){ // kiem tra xem co ban ghi nao k?
            $users_data = $db->results();
            if (isset($_POST['btn_delete_multi'])){
                if (isset($_POST['checked_id']) && !empty($_POST['checked_id'])){
                    $id_arr = $_POST['checked_id'];
                    if (!$db->delete_multi_rows($id_arr)->error())
                        echo 'Delete Successful';
                    else
                        echo 'Delete Error!';
                }
            }
?>
            <form action="" method="post">
            <table>
                <tr>
                    <td>Select</td>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Action</td>
                </tr>
                <?php foreach ($users_data as $row) : // Thuc hien vong lap ?>
                <tr>
                    <td><input type="checkbox" name="checked_id[]" value="<?php echo $row['id']; ?>"></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>Edit||Delete</td>
                </tr>
                <?php endforeach; ?>
            </table>
            <input type="submit" name="btn_delete_multi" value="Delete Multi Rows Checked" onclick="return confirm('Are you sure you want delete?')">
            </form>
<?php
        }
    }
?>
<h1>Select Data By Name</h1>
<?php
    // Lay ban ghi theo name
//    if (!$db->get_info('users', 'name', 'admin')->error()){
//        if ($db->count() > 0){
//            $result = $db->results();
////            var_dump($result);
//            echo 'Lay ban ghi theo name' . '<br />';
//            echo 'Name = ' . $result['name'] . '<br />';
//        }
//    }
?>
<h1>Select Data By Id</h1>
<?php
    // Lay ban ghi theo id
    /*
    if (!$db->get_info('users', 'id', 4)->error()){
        if ($db->count() > 0){
            $user_by_id = $db->results();
            var_dump($user_by_id);
            echo 'Lay ban ghi theo id' . '<br />';
            echo 'Name = ' . $user_by_id['name'];
        }else{
            echo 'User Not Found!';
        }
    }else {
        echo 'Have Error!';
    }
    */
?>

<h1>Insert Data</h1>
<?php

    /*$args = array(
        'name' => 'thanh',
        'email' => 'thanh@gmail.com',
        'contactno' => '0968256787',
        'password' => '123456'
    );
    if (!$db->insert('users', $args)->error())
        echo 'Insert Successful';
    else
        echo 'Insert Error!';*/

?>
<h1>Update Data</h1>
<?php
/*
    $args = array(
        'name' => 'thanh',
        'email' => 'thanh@gmail.com',
        'contactno' => '0968256787',
        'password' => '123456'
    );
    if (!$db->update('users', 7, $args)->error())
        echo 'Update Successful';
    else
        echo 'Update Error!';
*/
?>
<h1>Delete Row</h1>
<?php
/*
    $id = 'abc';
    if ($db->delete('users', $id))
        echo "Delete Successful";
    else
        echo "Delete Error!";
*/
?>

<h1>Delete Multi Rows</h1>
<?php
    /*$id_arr = array(11, 12, 13, 14);
    $db->delete_multi_rows($id_arr);*/
?>

<?php
    $user->select_users();
    if (count($user->data()) > 0):
        $user_lists = $user->data();
?>
        <ul>
<?php
        foreach ($user_lists as $value) :
?>
            <li><?php //echo $value['id']; ?></li>
<?php
        endforeach;
?>
        </ul>
<?php
    else:
?>
        <h1>Not Found Data</h1>
<?php
    endif;
?>

<h1>Find User </h1>
<?php
    /*if ($user->find('admin'))
        var_dump($user->data());*/
?>
<h1>Find User By Email</h1>
<?php
    /*if ($user->find_user_by_email('admin@gmail.com'))
        var_dump($user->data());
    else
        echo 'User Not Found!';*/

//    var_dump($db->get_info('users', 'email', 'admin111@gmail.com'));
?>

<h1>Login Control</h1>
<?php
    if ($user->isLoggedIn()){
        echo 'Okie LoggedIn';
    }
?>