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
fputcsv($output, array('Ref_id', 'Name', 'Email','NIC','Active'));
$rows = mysqli_query($con,"SELECT candidate.Ref_id,candidate.cand_full_name,candidate.cand_email,candidate.cand_nic,candidate.isactive FROM candidate where isapprove=1");
while ($row = mysqli_fetch_assoc($rows))
{
 fputcsv($output, $row);
}
exit();
}
?>
<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
?>
<?php include('headeradmin.php');
include ('paginate.php'); //include of paginat page

$per_page = 5;         // number of results to show per page
$result= mysql_query("select * from candidate where isapprove=1")or die(mysqli_error());
												
$total_results = mysql_num_rows($result);
$show_page=1;
$total_pages = ceil($total_results / $per_page);//total pages we going to have

//-------------if page is setcheck------------------//
if (isset($_GET['page'])) {
    $show_page = $_GET['page'];             //it will telles the current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;              
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
}
// display pagination
//$page = intval($_GET['page']);

$tpages=$total_pages;
//if ($page <= 0)
    $page = 1;
 ?>
<nav>
  


    <div class="container">
     <h1><center><b>Candidate Log</b></center></h1>
        <div class="row">
            <div class="span6 offset3">
                <div class="mini-layout">
                 <?php
                    $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
                    echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
                    // display data in table
                    echo "<table class='table table-bordered'>";
                    echo "<thead><tr><th>Candidate Name</th> <th>Candidate Email</th><th>Active</th><th>Detail</th></tr></thead>";
                    // loop through results of database query, displaying them in the table 
                    for ($i = $start; $i < $end; $i++) {
                        // make sure that PHP doesn't try to show results that don't exist
                        if ($i == $total_results) {
                            break;
                        }
                      
                        // echo out the contents of each row into a table
                      
                        echo '<td>' . mysql_result($result, $i, 'cand_full_name') . '</td>';
                        echo '<td>' . mysql_result($result, $i, 'cand_email') . '</td>';
						echo '<td>' . mysql_result($result, $i, 'isactive') . '</td>';
						echo "<td><a href='candinfo.php?id=".mysql_result($result, $i,'cand_id')."'>Candidate detail</a></td>";
						 echo "</tr>";
                    }       
                    // close table>
                echo "</table>";
            // pagination
            ?>
            </div>
        </div>
    </div>
</div>
</nav>
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>