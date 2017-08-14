
<?php include_once('connection.php');
$query1="SELECT * FROM tbl_image";
$result1=mysqli_query($conn,$query1);
?>
<html>
<head>
<title>Insert Update Delete and Edit image Using Php and Mysqli</title>
</head>
<body>
<br>
<table  width="50%"  border='2' align="center">

<tr>
<tr> 
<td colspan="4" align="center"><B style="color:#F00" ><?php if(isset($_SESSION['msg'])){echo $_SESSION['msg']; unset($_SESSION['msg']);} ?></B></td>
</tr>

<tr> 
<td colspan="4"  align="center"><B>Add New image  <a href="image_add.php">Click Here</a></B></td>
</tr>
<th width="10%">Sno</th>
<th width="25%">Image</th>
<th width="25%">Image Name</th>
<th width="25%">Action</th>
</tr>
<?php
$i=1;
while($row=mysqli_fetch_object($result1))
{
?>
<tr>
<td align="center"><?=$i?></td>
<td align="center"><img width="30%" src="UploadImage/<?=$row->image_path;?>"></td>
<td align="center"><?php echo $row->image_name; ?></td>
<td align="center"><a href="image_add.php?id=<?=$row->id?>">Update</a> ||<a onClick="return confirm('Are You Sure ?');" title="Delete" href="image_del.php?deleteid=<?=$row->id?>">Delete</a></td>
</tr>
<?php $i++; }?>
</table>

</body>
</html>