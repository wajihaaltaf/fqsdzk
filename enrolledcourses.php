<?php
require_once('config.php');
?>

<?php
require_once('session1.php');
include('headcand.php');
?>
<head>
<script>
						function withdrawn(){
						var a=confirm("Are you sure you want to withdraw?");
                         if(a==true){
						 alert("You have successfully withdrawn");
                         myfunction();		
						 window.location.reload();
						 }
						}
						
			   </script>

</head>
<body>
	<nav>
   <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line" align="center">Enrolled Courses</h1>
                    </div>
                </div>
               
                </div></div>
  </div>
          <link href="css/table1.css" rel="stylesheet" type="text/css" />
			<form method="post" >
			<div class="control-label" align="right">
<table class="table" cellspacing="0" border="0" class="table" id="example">
				<thead>
				<tr class="head">
				<th>Module</th>
                <th>Category</th>
                <th>Detail</th>
				<th>Status</th>
				</tr>
				</thead>


<!-------------------------------- select table inventory ---------------------------------->
						<?php $cand_id= $_SESSION['cand_id'];
						
						$query=mysqli_query($con,"SELECT enrollment.withdrawn,enrollment.module_id,enrollment.category_id FROM enrollment WHERE enrollment.cand_id='$cand_id' ")or die(mysqli_error($con));
						while($rec=mysqli_fetch_array($query)){
						$mid = $rec['module_id'];
						$cid = $rec['category_id'];
						$iswithdrawn = $rec['withdrawn'];
						
						$quer=mysqli_query($con,"SELECT module.module_name,category.category_name,module.module_id FROM category,module WHERE module.module_id='$mid' and category.category_id='$cid' ")or die(mysqli_error($con));
						$rc=mysqli_fetch_array($quer);
						$id= $rc['module_id'];
						?>
						<tr class="edit_tr">
						<td><center><?php echo $rc['module_name']; ?></center></td>
						<td><center><?php echo $rc['category_name'] ?></center></td>
                        <td><a href="coursedetail.php<?php echo '?id='.$id; ?> ">Course Detail</a></td>
						<td><center><?php if($iswithdrawn==0){?><input type="button" id="withdraw" value="Withdraw" style="background:green" onclick="withdrawn();" ><?php }?>
						<?php if($iswithdrawn==1){?><input type="button" id="withdraw" value="Withdrawn" style="background:red" disabled><?php }?></center>
						</td>
						</tr><?php }?>
							</table>
							</div>
						<script>
						function myfunction(){
							<?php
						mysqli_query($con,"UPDATE enrollment SET withdrawn = 1 WHERE enrollment.cand_id = '$cand_id' AND enrollment.category_id='$cid' AND enrollment.module_id='$mid' ")or die(mysqli_error($con));
                        mysqli_commit($con);
						?>
						}
						</script>
							</form>
                             
  </nav>

  </div>
  </div>
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
	<?php include('script.php'); ?>
	
</body>
</html>