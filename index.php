
<?php include_once('connection.php');?>
<?php 
if(isset($_POST['Submit']))
{
$img_name =  $_POST['img_name'];
if(($_FILES['image']['type']== 'image/jpeg')
||($_FILES['image']['type']== 'image/gif')
||($_FILES['image']['type']== 'image/png')
&&($_FILES['image']['size']<200000)
&&($_FILES['image']['error'] == 0))
  {
   $document = time().$_FILES['image']['name'];
	move_uploaded_file($_FILES['image']['tmp_name'],"UploadImage/".$document);
  }
  else
  {
	$document =  $_POST['old_image_path']; 
  }  
if(empty($_GET['id']))
{		
$query = "INSERT INTO tbl_image SET image_name = '$img_name',image_path = '$document'  ";
$queryrun = mysqli_query($conn,$query);
$_SESSION['msg'] = "Your Data inserted Successfully";
}
if(isset($_GET['id']))
{
$id =  $_GET['id'];
$queryrun=mysqli_query($conn,"SELECT image_path FROM tbl_image WHERE id='$id' ");
$row=mysqli_fetch_object($queryrun);
if($row->image_path!== $document)
{
	unlink("UploadImage/".$row->image_path);
}
$query = " UPDATE tbl_image SET image_name = '$img_name',image_path = '$document' where id = '$id' ";
$queryrun = mysqli_query($conn,$query);
$_SESSION['msg'] = "Your Data Updated Successfully";	
}
header("location:image_list.php");
}
if(!empty($_GET['id']))
{
$id = $_GET['id'];
$query = "SELECT * FROM tbl_image  where id = '$id' ";	
$queryrun = mysqli_query($conn,$query);
$row = mysqli_fetch_object($queryrun);	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert Update Delete and Edit image Using Php and Mysqli</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="form-style-1">
<form enctype="multipart/form-data" method="post" action="">
    <li>
    <?php if(!empty($_GET['id'])){ ?>
    <div style="width:160px; height:100px; margin-bottom:10px;">
    <input type="hidden"  name="old_image_path" value="<?php if(isset($id)) echo $row->image_path;?>" >
    <img src="<?php echo "UploadImage/".$row->image_path; ?>" width="100" height="100" />
    </div>
    <?php }?>
    </li>
    <li>
        <label>Image <span class="required">*</span></label>
        <input type="file"  class="field-long" name="image" <?php if(isset($id)){}else{echo 'required';};?>  />
    </li>   
    <li>
    <label>Image Name <span class="required">*</span></label>
    <input type="text" name="img_name" class="field-divided" placeholder="Name" value="<?php if(isset($id)){echo $row->image_name;}?>" required />
    </li>
    <li>
        <input type="submit" value="Submit"  name="Submit" />
    </li>
    </form>

</div>
</body>
</html>