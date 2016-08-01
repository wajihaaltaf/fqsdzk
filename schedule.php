<?php
require_once('config.php');

require_once('session2.php');
?>
<?php
	if (isset($_POST['register'])){
	if($catagory="" || $module="" || $station = "" || $edate="" || $ddate = "" )
	{
	?>
<script>
alert('Schedule has been added');
window.location = "schedule.php";
</script>
<?php exit();} 
	else {
	$category=mysql_real_escape_string($_POST['category']);
	$module=mysql_real_escape_string($_POST['module']);
	//$station=mysql_real_escape_string($_POST['station']);
  //$stations=mysql_real_escape_string($)
	$edate=mysql_real_escape_string($_POST['edate']);
	$ddate=mysql_real_escape_string($_POST['ddate']);
	$user_query = mysqli_query($con,"SELECT module.module_id,category.category_id FROM module,category WHERE module.category_id=category.category_id AND category.category_name='$category' AND module.module_name='$module'")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query))
													{$mid = $row['module_id'];
													$cid= $row['category_id'];
													}				
	   if(!empty($_POST['station_list']))
  {
    $qry=mysqli_query($con,"INSERT INTO `schedule` (`exam_date`, `module_id`, `category_id`, `exam_id`, `exam_deadline`) VALUES ('$edate','$mid','$cid', '', '$ddate')")or die(mysqli_error($con));
    if($qry)
    { 
      $result1=mysqli_query($con,"SELECT schedule.exam_id FROM schedule WHERE schedule.exam_id=(select max(exam_id) from schedule)") or die(mysqli_error($con));
      //$eid = mysqli_fetch($result1);
      while($row = mysqli_fetch_array($result1))
                          {
                          $eid= $row['exam_id'];
                          }
   
    mysqli_commit($con);
    foreach ($_POST['station_list'] as $selected) {
      $result2=mysqli_query($con,"SELECT station.station_id FROM station WHERE station.station_id='$selected'") or die(mysqli_error($con));
      while($row = mysqli_fetch_array($result2))
                          {
                          $sid= $row['station_id'];
                          }   
      $qry=mysqli_query($con,"INSERT INTO `exam_station` (`exam_id`, `station_id`) VALUES ('$eid','$sid')")or die(mysqli_error($con));   
    }
  }
  else
  {
    mysqli_rollback($con);
  ?>
  <script>
alert('Schedule was not added');
window.location = "schedule.php";
</script>
<?php
  }
              mysqli_commit($con);
?>
<script>
alert('Schedule has been added');
window.location = "schedule.php";
</script>
<?php } 
		else { mysqli_rollback($con);
		?>
<script>
alert('Schedule was not added. Please, select atleast one station');
window.location = "schedule.php";
</script>
		}
        <?php
		mysqli_close($con);
		}}}
		?>
      
			
<?php include('headeradmin.php'); ?>
  <!--//////////////////////////////// Add Dialog ///////////////////////////////////////////-->
  <nav>
  <div id="page-wrapper" class="page-wrapper-cls">
    <div id="page-inner">
    <div class="row">
    <div class="col-md-12">
    <form class="form-horizontal" role="form" method="post">
      <h3>
        <center>
          ADD EXAM SCHEDULE
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
      
      <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Exam Date:</label>
							  <div class="col-md-3">
						<input type="date" name="edate" id = "date" title="click to choose a date" class="form-control input-md" required/>
					</div>
				</div>
                <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Exam Registeration Deadline:</label>
							  <div class="col-md-3">
						<input type="date" name="ddate" id = "date" title="click to choose a date" class="form-control input-md" required/>
					</div>
				</div>
<div class="form-group">
							<label class="col-md-5 control-label" for="room">Station:</label>  
							  <div class="col-md-3">
      
								<?php 
                
			$query=mysqli_query($con,"SELECT * FROM station where isexam_allowed=1 ORDER by station_name");
						while($row=mysqli_fetch_array($query))
						 { 
						  $sel= "selected";
						 	?>
							<input type="checkbox" name="station_list[]" style="margin: 3px; padding: 10px; display:inline-block" value="<?php echo $row['station_id'];?>" <?=$sel?> > <?php echo $row['station_name']; ?> 
              <?php 
						} ?>

                                </div></div>      
      <div class="control-group">
        <div class="controls" align="center">
          <button type="submit" id="submit" name="register" class="btn btn-success">ADD</button>
           <a button id="cancel" name="cancel" class="btn btn-danger" href="admin.php" >Cancel</button></a>
          <br>
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
<!-- jQuery Version 1.11.0 -->
<script src="js/jquery-1.11.0.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- Morris Charts JavaScript -->
<script src=".js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
var selectBrand = $("#brand");
var selectType = $("#type");

var optionsList = {
    B1: [
        <?php $user_query = mysqli_query($con,"SELECT module_name from module where category_id=1 ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													printf("'%s',", $row[0]);
													?>
			
			<?php } ?>
			],
    B2: [
          <?php $user_query = mysqli_query($con,"SELECT module_name from module where category_id=2 ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
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
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
$.webshims.formcfg = {
en: {
    dFormat: '-',
    dateSigns: '-',
    patterns: {
        d: "yy-mm-dd"
    }
}
};
</script>
</body>
</html>
