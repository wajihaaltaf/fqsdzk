<?php
require_once('config.php');
?>
<?php
require_once('session2.php');
if(isset($_POST['approve']))
{ header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=candidate.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Ref_id', 'Name', 'Email','NIC'));
$rows = mysqli_query($con,"SELECT candidate.Ref_id,candidate.cand_full_name,candidate.cand_email,candidate.cand_nic FROM candidate where isapprove=1 and isactive=1");
while ($row = mysqli_fetch_assoc($rows))
{
 fputcsv($output, $row);
}
exit();
}
?>
<?php include('headeradmin.php'); ?>
<nav>
    <center><h2>Candidate LOGS<h2></center>
      <h4>Candidate LOGS</h4>
			<link href="css/table1.css" rel="stylesheet" type="text/css" />
			<form method="post">
			<div class="control-label" align="right">
<table class="table" cellspacing="0" border="0" class="table" id="example">
				<thead>
				<tr class="head">
				<th>Username</th>
                <th>Email</th>
				<th>Link</th>
				</tr>
				 <script>
				$(function() {
							
				 });
				 </script>
				</thead>


<!-------------------------------- select table inventory ---------------------------------->
						<?php 
						$query=mysqli_query($con,"select * FROM candidate where isapprove=1")or die(mysqli_error($con));
						while($rec=mysqli_fetch_array($query)){
						$id = $rec['cand_id'];
						?>
						<tr class="edit_tr">
						<td><?php echo $rec['cand_full_name']; ?></td>
						<td><?php echo $rec['cand_email'] ?></td>
                        <td><a href="candinfo.php <?php echo '?id='.$id; ?> ">Candidate detail</a></td>
						</tr><?php }?>
							</table>
							</div>
                            <div class="control-group">
				<div class="controls" align="center">
						           				 <button name="approve" class="btn btn-success">Create CSV</button>
											 </div></div>
							</form>
                             
</nav>
  </div>
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