<?php
//***************************************
// This is downloaded from www.plus2net.com //
/// You can distribute this code with the link to www.plus2net.com ///
//  Please don't  remove the link to www.plus2net.com ///
// This is for your learning only not for commercial use. ///////
//The author is not responsible for any type of loss or problem or damage on using this script.//
/// You can use it at your own risk. /////
//*****************************************

require 'config.php';  // Database connection
//////// End of connecting to database ////////
?>

<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Multiple drop down list box from plus2net</title>
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value;
self.location='dd.php?cat=' + val ;
}

</script>
</head>

<body>
<?Php

@$cat=$_GET['cat']; 

$quer2="SELECT DISTINCT course_title FROM module order by course_title"; 

{
$quer="SELECT DISTINCT module.module_id,module.module_name, schedule.exam_date FROM module,schedule where course_title='$cat' and module.module_id=schedule.module_id "; 
}
echo "<div class=form-group>
							  <label class=col-md-5 control-label>Category:</label>  
							  <div class=col-md-3>";
echo "<select name='cat' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
foreach ($dbo->query($quer2) as $noticia2) {
if($noticia2['course_title']==@$cat){echo "<option selected value='$noticia2[course_title]'>$noticia2[course_title]</option>"."<BR>";}
else{echo  "<option value='$noticia2[course_title]'>$noticia2[course_title]</option>";}
}
echo "</select>";

echo "<div class=form-group>
							  <label class=col-md-5 control-label>Category:</label>  
							  <div class=col-md-3><select name='subcat'><option value=''>Select one</option>";
foreach ($dbo->query($quer) as $noticia) {
echo  "<option value='$noticia[course_title]'>$noticia[module_name] - $noticia[exam_date]</option>";

}
echo "</select>";
//////////////////  This will end the second drop down list ///////////
//// Add your other form fields as needed here/////
//echo "<input type=submit value=Submit>";
echo "</form>";
?>
</html>
