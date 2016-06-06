       <link href="css/styles.css" rel="stylesheet" media="screen">      
	
	
	   <!--------------------------------------/.fluid-container-------------------------------------->
        <link href="css/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"> 
        <script src="css/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="js/scripts.js"></script>
				<script>
				$(function() {
				<!-----------------------Easy pie charts---------------------------------->
					$('.chart').easyPieChart({animate: 1000});
				});
				</script>
				
				
		<!------------------------------------- jgrowl-------------------------------------------- -->
		<script src="css/jGrowl/jquery.jgrowl.js"></script>   
				<script>
				$(function() {
					$('.tooltip').tooltip();	
					$('.tooltip-left').tooltip({ placement: 'left' });	
					$('.tooltip-right').tooltip({ placement: 'right' });	
					$('.tooltip-top').tooltip({ placement: 'top' });	
					$('.tooltip-bottom').tooltip({ placement: 'bottom' });
					$('.popover-left').popover({placement: 'left', trigger: 'hover'});
					$('.popover-right').popover({placement: 'right', trigger: 'hover'});
					$('.popover-top').popover({placement: 'top', trigger: 'hover'});
					$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});
					$('.notification').click(function() {
						var $id = $(this).attr('id');
						switch($id) {
							case 'notification-sticky':
								$.jGrowl("Stick this!", { sticky: true });
							break;
							case 'notification-header':
								$.jGrowl("A message with a header", { header: 'Important' });
							break;
							default:
								$.jGrowl("Hello world!");
							break;
						}
					});
				});
				</script>
			<link href="css/datepicker.css" rel="stylesheet" media="screen">
			<link href="css/uniform.default.css" rel="stylesheet" media="screen">
			<link href="css/chosen.min.css" rel="stylesheet" media="screen">
		<!--  -->
		<script src="js/jquery.uniform.min.js"></script>
        <script src="js/chosen.jquery.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
		<!--  -->
			<script src="js/wysihtml5-0.3.0.js"></script>
			<script src="js/bootstrap-wysihtml5.js"></script>
			<script src="js/ckeditor/ckeditor.js"></script>
			<script src="js/ckeditor/adapters/jquery.js"></script>
			<script type="text/javascript" src="js/tinymce/js/tinymce/tinymce.min.js"></script>
        <script>
        $(function() {
           <!-------------------------------Ckeditor standard-------------------------------------->
            $( 'textarea#ckeditor_standard' ).ckeditor({width:'98%', height: '150px', toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
				{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
			]});
            $( 'textarea#ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
        });
        </script>
		<!-- ----------<script type="text/javascript" src="admin/assets/modernizr.custom.86080.js"></script> ------------------------->
		<script src="js/jquery.hoverdir.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
			<script type="text/javascript">
			$(function() {
				$('#da-thumbs > li').hoverdir();
			});
			</script>
			<script src="js/fullcalendar/fullcalendar.js"></script>
			<script src="js/fullcalendar/gcal.js"></script>
			<link href="js/datepicker.css" rel="stylesheet" media="screen">
			<script src="js/bootstrap-datepicker.js"></script>
						<script>
						$(function() {
							$(".datepicker").datepicker();
							$(".uniform_on").uniform();
							$(".chzn-select").chosen();
							$('#rootwizard .finish').click(function() {
								alert('Finished!, Starting over!');
								$('#rootwizard').find("a[href*='tab1']").trigger('click');
							});
						});
						</script>