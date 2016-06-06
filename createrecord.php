<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
?>
<?php
require_once('session2.php');
if(isset($_POST['register']))
{
$mname=$_POST['module'];
$category= $_POST['category'];
$shift = $_POST['shift'];
$station=$_POST['station'];
$user_query = mysql_query("SELECT module.module_id,category.category_id FROM module,category WHERE module.category_id=category.category_id AND category.category_name='$category' AND module.module_name='$mname' ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$module_id = $row['module_id'];
													$cid = $row['category_id'];
													$user_query2=mysql_query("SELECT DATE_FORMAT(exam_date, '%d-%m-%Y') as exam_date from schedule  where module_id='$module_id' and station_id= '$station' and category_id='$cid'");
													$row = mysql_fetch_array($user_query2);
													$dte = $row['exam_date']; 
														$user_query2=mysql_query("SELECT STN from station where station_id='$station' ");
													$row = mysql_fetch_array($user_query2);
													$STN = $row['STN']; 
 $mnam=str_replace(' ','',$mname);
  
$mnam=$mnam."-".$dte."-".$STN;
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename='$mnam'.csv");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings

$yes = mysql_query("SELECT module.module_name , schedule.exam_date  from schedule , module where schedule.module_id=module.module_id and schedule.module_id='$module_id' and schedule.station_id= '$station' ") or die(mysql_error());
// fetch the datau
$row = mysql_fetch_assoc($yes);

fputcsv($output, $row);
fputcsv($output, array('Ref_id', 'First Name', 'Module Name','NIC'));
// fetch the data
$rows = mysql_query("SELECT candidate.Ref_id,candidate.cand_full_name,module.module_name,candidate.cand_nic FROM candidate,module,enrollment WHERE module.module_id=enrollment.module_id and enrollment.module_id='$module_id' and candidate.cand_id=enrollment.cand_id") or die(mysql_error());
$total= mysql_num_rows($rows);
$count= ceil($total/$shift); $var=0;
for ($x = 1; $x <= $shift; $x++)
{
$abc = mysql_query("SELECT candidate.Ref_id,candidate.cand_full_name,module.module_name,candidate.cand_nic FROM candidate,module,enrollment WHERE module.module_id=enrollment.module_id and enrollment.module_id='$module_id' and candidate.cand_id=enrollment.cand_id  limit $var,$count") or die(mysql_error());
fputcsv($output, array('shift'.$x));
while ($row = mysql_fetch_assoc($abc)){
 fputcsv($output, $row);
}
$var=$var+$count;
}}
exit();
}?>
<?php include('headeradmin.php'); ?>

<nav>
  <div id="page-wrapper" class="page-wrapper-cls">
    <div id="page-inner">
    <div class="row">
    <div class="col-md-12">
    <form class="form-horizontal" role="form" method="post">
      <h3>
        <center>
          Create CSV
        </center>
      </h3>
      <br>
    <div class="form-group">
        <label class="col-md-5 control-label">Category:</label>
        <div class="col-md-3">
          <select id="brand" name="category" class="form-control" required>
     <option value="">- select -</option>
    <option value="B1">B1</option>
    <option value="B2">B2</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-5 control-label" for="room">Module:</label>
        <div class="col-md-3">
          <select id="type" name="module" class="form-control" required>
</select>
        </div>
      </div>
      
	<div>
         <div class="form-group">
										 
                                         <div class="form-group">
							  <label class="col-md-5 control-label">Shift:</label>
							  <div class="col-md-3">
					 <input type="number"  class="form-control" name="shift" required autofocus>
				</div>
				</div>
				<div class="form-group">
							<label class="col-md-5 control-label" for="room">Station:</label>  
							  <div class="col-md-3">
								<select id="dept_id" name="station" class="form-control" required/>  
									<option></option>
								<?php 
						$query=mysql_query("SELECT * FROM station ORDER by station_name");
						while($row=mysql_fetch_array($query))
						 { 
						 $sel= "selected";
						 	?>
							<option value="<?php echo $row['station_id'];?>" <?=$sel?> > <?php echo $row['station_name'];?> </option>
							<?php 
						} ?>
								</select>
                                </div></div> 
      <div class="control-group">
        <div class="controls" align="center">
          <button type="submit" id="submit" name="register" class="btn btn-success">Create CSV</button>
          <a button id="cancel" name="cancel" class="btn btn-danger" href="admin.php" >Cancel
          </button>
          </a> <br>
          <br>
          <br>
          <br>
          <br>
        </div>
      </div>
      </div>
    </form>
  </div>
  </div>
</nav>
</div>
</div>
</div>
<!-- jQuery Version 1.11.0 -->
<script src="js/jquery-1.11.0.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
var selectBrand = $("#brand");
var selectType = $("#type");

var optionsList = {
    B1: [
        <?php $user_query = mysql_query("SELECT module_name from module where category_id=1 ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													printf("'%s',", $row[0]);
													?>
			
			<?php } ?>
			],
    B2: [
          <?php $user_query = mysql_query("SELECT module_name from module where category_id=2 ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													printf("'%s',", $row[0]);
													?>
			
			<?php } ?>
    ]
};

selectBrand.change(function() {
    var brand = selectBrand.val();
    var options = optionsList[brand];
    var html;
    
    if (options) {
        html = '<option value="">- select -</option>';
        $.each(options, function(index, value) {
            html += '<option value="' + value + '">' + value + '</option>';
        });
    } else {
        html = '<option value="">- select category -</option>';
    }
    selectType.html(html);
}).change();
});
</script>
<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>
<?php include('script.php'); ?>
</body></html>