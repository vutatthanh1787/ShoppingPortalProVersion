<?php 
	require_once 'core/config.php';
	$db = new Database(); // Tao 1 doi tuong Database moi
	$db::getInstance(); // Ket noi voi csdl
    // Lay tat ca ban ghi trong bang users
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
<?php
    // Lay ban ghi theo id
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
?>

<h1>Insert Data</h1>
<?php
    $args = array(
        'name' => 'thanh',
        'email' => 'thanh@gmail.com',
        'contactno' => '0968256787',
        'password' => '123456'
    );
    var_dump($db->insert('users', $args));
?>
