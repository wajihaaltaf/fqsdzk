<?php
require_once('config.php');
include('headcand.php'); 
?>
<nav>
<div id="page-wrapper" class="page-wrapper-cls">
<div id="page-inner">
  <div class="row">
    <div class="col-md-12">
    
    <form class="form-horizontal" role="form" method="post">
      <h3>
        <center>
          Module Enrollment
        </center>
      </h3>
      <br />
      <div class="form-group">
        <label class="col-md-5 control-label">Category:</label>
        <div class="col-md-3">
          <select id="brand" name="category" class="form-control" required="required">
            <option value="">- select -</option>
            <option value="B1">B1</option>
            <option value="B2">B2</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-5 control-label" for="room">Module:</label>
        <div class="col-md-3">
          <select id="type" name="module" class="form-control" required="required">
          </select>
        </div>
      </div>
       <div class="form-group">
        <label class="col-md-5 control-label" for="room">Station:</label>
        <div class="col-md-3">
          <select id="station" name="station" class="form-control" required="required">
          </select>
        </div>
      </div>
     
      <div class="control-group">
        <div class="controls" align="center">
          <button type="submit" id="submit" name="register" class="btn btn-success">ADD</button>
          <a button="button" id="cancel" name="cancel" class="btn btn-danger" href="admin.php" >Cancel
          </button>
          </a> <br />
          <br />
          <br />
          <br />
          <br />
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
var selectBrand = $("#brand");
var selectType = $("#type");

var optionsList = {
    B1: [
        
								<?php 
								
						$user_query = mysqli_query($con,"SELECT DISTINCT(CONCAT(module.module_name,CONCAT('-', DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' )))) as e FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=1 and schedule.exam_deadline >= NOW() and schedule.station_id=station.station_id ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module = $row['e'];
													
									printf("'$module',");
						 	}?>
							
			],
    B2: [
          		
					
								<?php 
								
					$user_query = mysqli_query($con,"SELECT DISTINCT(CONCAT(module.module_name,CONCAT('-', DATE_FORMAT( schedule.exam_date, '%d-%m-%Y' )))) as e FROM module,schedule,station WHERE schedule.module_id=module.module_id AND module.category_id=2 and schedule.exam_deadline >= NOW() and schedule.station_id=station.station_id ")or die(mysqli_error($con));
												while($row = mysqli_fetch_array($user_query)){
													$module = $row['e'];
									printf("'$module',");
									}?>
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

<script>
$(document).ready(function(){
var selectBrand = $("#brand");
var selectType = $("#type");
var selectStation = $("#station");
selectType.change(function() {
var str= selectType.val();
var dates = str.substring(10, 20);
window.alert(dates);
var optionsList = {
   B101: [
        
								<?php 
								
						$user_query = mysqli_query($con,"SELECT station.station_name FROM station,schedule,module WHERE schedule.station_id=station.station_id AND schedule.category_id=1 and module.module_name='Module 01' AND schedule.module_id=module.module_id ")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													
													$module = $row['station_name'];
									printf("'$module',");
						 	}?>
							
			],
			B102: [
			<?php 
     
$user_query = mysqli_query($con,"SELECT station.station_name,schedule.exam_date FROM station,schedule,module WHERE schedule.station_id=station.station_id AND schedule.category_id=1 and module.module_name='Module 02' AND schedule.module_id=module.module_id")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module = $row['station_name'];
									                printf("'$module',");
						 	}?>
							
			],
  B201: [
          
					
								<?php 
					$user_query = mysqli_query($con,"SELECT station.station_name FROM station,schedule,module WHERE schedule.station_id=station.station_id AND schedule.category_id=2 and module.module_name='Module 01' AND schedule.module_id=module.module_id")or die(mysqli_error($con));
													while($row = mysqli_fetch_array($user_query)){
													$module = $row['station_name'];
									printf("'$module',");
									}?>
    ]
};

    var get = selectType.val(); 
	var type=selectBrand.val()+get.substring(9,7);
    var options = optionsList[type];
    var html;
    
    if (options) {
        html = '<option value="">- select -</option>';
        $.each(options, function(index, value) {
            html += '<option value="' + value + '">' + value + '</option>';
        });
    } else {
        html = '<option value="">- select module -</option>';
    }
   selectStation.html(html);
}).change();
});
</script>
</body>
</html>
<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>
