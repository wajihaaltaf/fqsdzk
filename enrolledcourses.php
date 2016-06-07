<?php
require_once('config.php');
?>

<?php
require_once('session1.php');
include('headercand.php');
?>
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
			<form method="post">
			<div class="control-label" align="right">
<table class="table" cellspacing="0" border="0" class="table" id="example">
				<thead>
				<tr class="head">
				<th>Module</th>
                <th>Category</th>
                <th>Detail</th>
				</tr>
				 <script>
				$(function() {
							
				 });
				 </script>
				</thead>


<!-------------------------------- select table inventory ---------------------------------->
						<?php $cand_id= $_SESSION['cand_id'];
						//echo "SELECT enrollment.module_id,enrollment.category_id FROM enrollment WHERE enrollment.cand_id='$cand_id'";
						$query=mysqli_query($con,"SELECT enrollment.module_id,enrollment.category_id FROM enrollment WHERE enrollment.cand_id='$cand_id' ")or die(mysqli_error($con));
						while($rec=mysqli_fetch_array($query)){
						$mid = $rec['module_id'];
						$cid = $rec['category_id'];
						//echo "SELECT module.module_name,category.category_name FROM category,module WHERE module.module_id='$mid' and category.category_id='$cid' ";
						$quer=mysqli_query($con,"SELECT module.module_name,category.category_name FROM category,module WHERE module.module_id='$mid' and category.category_id='$cid' ")or die(mysqli_error($con));
						$rc=mysqli_fetch_array($quer);
						?>
						<tr class="edit_tr">
						<td><center><?php echo $rc['module_name']; ?></center></td>
						<td><center><?php echo $rc['category_name'] ?></center></td>
                        <td><a href="coursedetail.php <?php echo '?id='.$id; ?> ">Course Detail</a></td>
						</tr><?php }?>
							</table>
							</div>
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