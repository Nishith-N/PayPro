<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');

$sql_query = "SELECT pay_id,card_name as CardHolder,card_number,cvv,validto from card_details ";
$resultset = mysqli_query($db, $sql_query) or die("database error:". mysqli_error($db));
$developer_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$developer_records[] = $rows;
}	

if(isset($_POST["export_data"])) {	
	$filename = "card_details_".date('Ymd') . ".xls";			
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
        <h1>Card Details</h1>
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
                <th>Pay Id</th>
                <th>CardHolder</th>
                <th>Card Number</th>
                <th>Cvv</th>
                <th>Valid upto</th>	
            </tr>
            </thead>
            <tbody>
                <?php foreach($developer_records as $developer) { ?>
                    <tr>
                    <td><?php echo $developer ['pay_id']; ?></td>
                    <td><?php echo $developer ['CardHolder']; ?></td>
                    <td><?php echo $developer ['card_number']; ?></td>
                    <td><?php echo $developer ['cvv']; ?></td>
                    <td><?php echo $developer ['validto']; ?></td>      
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