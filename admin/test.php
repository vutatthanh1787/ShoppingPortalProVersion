<?php 
	require_once 'core/config.php';
	$db = new Database(); // Tao 1 doi tuong Database moi
	$db::getInstance(); // Ket noi voi csdl
    // Lay tat ca ban ghi trong bang users
    echo "<h1>Select All Data</h1>";
    if (!$db->get_info('users')->error()){ // kiem tra k co loi
        if ($db->count() > 0){ // kiem tra xem co ban ghi nao k?
            $users_data = $db->results();
?>
            <table>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                </tr>
                <?php foreach ($users_data as $row) : // Thuc hien vong lap ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
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
/*
    $args = array(
        'name' => 'thanh',
        'email' => 'thanh@gmail.com',
        'contactno' => '0968256787',
        'password' => '123456'
    );
    var_dump($db->insert('users', $args));
*/
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
    $id = 'abc';
    if ($db->delete('users', $id))
        echo "Delete Successful";
    else
        echo "Delete Error!";
?>
