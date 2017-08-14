
<?php include_once('connection.php');?>
<?php 
if(isset($_GET['deleteid'])){
	$as = mysqli_query($conn,"SELECT image_path FROM tbl_image WHERE id = '".$_GET['deleteid']."'");
	$array=mysqli_fetch_object($as);		     	
    unlink("UploadImage/".$array->image_path);
	$SQL = "DELETE FROM tbl_image WHERE id = '".$_GET['deleteid']."'";
	$Query = mysqli_query($conn,$SQL);			
	$_SESSION['msg'] =("Selected Data(s) has been Delete successfully");
    header("location:image_list.php");
}

?>