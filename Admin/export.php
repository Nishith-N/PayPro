<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');

$sql_query = "SELECT pay_username,pay_name,amount,dates,reasons FROM trans_hist";
$resultset = mysqli_query($db, $sql_query) or die("database error:". mysqli_error($db));
$developer_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$developer_records[] = $rows;
}	

if(isset($_POST["export_data"])) {	
	$filename = "trans_hist_".date('Ymd') . ".xls";			
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$filename\"");	
	$show_coloumn = false;
	if(!empty($developer_records)) {
	  foreach($developer_records as $record) {
		if(!$show_coloumn) {
		  // display field/column names in first row
		  echo implode("\t", array_keys($record)) . "\n";
		  $show_coloumn = true;
		}
		echo implode("\t", array_values($record)) . "\n";
	  }
	}
	exit;  
}

?>


<html>
<div class="container">	
	<h2>Export Data to Excel</h2>
	<div >
		<div>	
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
				<button type="submit" id="export_data" name='export_data' value="Export to excel">Export to excel</button>
			</form>
		</div>
	</div>				  
	<table border="1">
		<tr>
			<th>Payer</th>
			<th>Payee</th>
			<th>Amount</th>	
			<th>Date</th>
			<th>Reason</th>
		</tr>
		<tbody>
			<?php foreach($developer_records as $developer) { ?>
			   <tr>
			   <td><?php echo $developer ['pay_username']; ?></td>
			   <td><?php echo $developer ['pay_name']; ?></td>
			   <td><?php echo $developer ['amount']; ?></td>   
			   <td><?php echo $developer ['dates']; ?></td>
			   <td><?php echo $developer ['reasons']; ?></td>   
			   </tr>
			<?php } ?>
		</tbody>
    </table>
</div>
</html>