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

?>
