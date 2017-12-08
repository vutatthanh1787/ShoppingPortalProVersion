<?php
	session_start();
	include("includes/config.php");
	$_SESSION['login'] == "";
	date_default_timezone_set('Asia/ho_chi_minh');
	$ldate = date( 'd-m-Y h:i:s A', time () );
	$sql_update = "UPDATE userlog  SET logout = '$ldate' WHERE userEmail = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1";
	$conn->query($sql_update);
	session_unset();
	$_SESSION['errmsg'] = "Bạn đã đăng xuất thành công";
?>
<script language="javascript">
	document.location = "index.php";
</script>
