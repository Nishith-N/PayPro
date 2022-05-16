<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');

$sql_query = "SELECT t.tr_id,u.fname as payer,u.phone as payer_number,t.pay_username as payee_number,t.pay_name as payee,t.amount,t.dates,t.reasons FROM trans_hist t JOIN user_details u WHERE t.pay_id=u.pay_id";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="export_style.css" rel="stylesheet">
</head>
<body>
    <br><br>
    <center>
    <div class="container">	
        <div><img src="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" class="logo"></div>
        <h1>Transaction Details</h1>
        <div >
            <div>	
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
                    <button type="submit" id="export_data" name='export_data' value="Export to excel" class="home">Export to excel</button>
                </form>
            </div>
        </div>				  
        <table border="1" class="styled-table">
            <thead>
            <tr>
                <th>Transaction Id</th>
                <th>Payer</th>
                <th>Payer Number</th>
                <th>Payee</th>
                <th>Payee Number</th>
                <th>Amount</th>	
                <th>Date</th>
                <th>Reason</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($developer_records as $developer) { ?>
                    <tr>
                    <td><?php echo $developer ['tr_id']; ?></td>
                    <td><?php echo $developer ['payer']; ?></td>
                    <td><?php echo $developer ['payer_number']; ?></td>
                    <td><?php echo $developer ['payee']; ?></td>
                    <td><?php echo $developer ['payee_number']; ?></td>
                    <td><?php echo $developer ['amount']; ?></td>   
                    <td><?php echo $developer ['dates']; ?></td>
                    <td><?php echo $developer ['reasons']; ?></td>   
                    </tr>
                 <?php } ?>
                 
            </tbody>
        </table>
    </div>
    <form action="../Admin/adminhome.php" method="post">					
		<button type="submit" id="export_data" name='export_data' value="HOME" class="home">HOME</button>
	</form>
</center>
</body>
</html>