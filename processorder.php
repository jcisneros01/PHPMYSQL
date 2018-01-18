<?php
  // create short variable names
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bob's Auto Parts - Order Results</title>
	</head>
<body>
	<h1>Bob's Auto Parts</h1>
	<h2>Order Results</h2>
	<?php
	echo date('H:i, jS F Y');

	?>
	<?php

	// Print Order
	echo '<p>Your order is as follows:</p>';
	$tireqty = htmlspecialchars($tireqty).' tires';
	echo "$tireqty<br />";
	echo htmlspecialchars($oilqty).' bootles of oil<br />';
	echo htmlspecialchars($sparkqty).' spark plugs<br />';

	// Qty items ordered
	$totalqty = 0;
	$totalqty =  $tireqty + $oilqty + $sparkqty;
	echo "<p>Items Ordered: ".$totalqty."<br /> </p>";

	// Print total amount
	$totalamount = 0.00;
	define('TIREPRICE', 100);
	define('OILPRICE', 10);
	define('SPARKPRICE', 4);

	$totalamount = ($tireqty * TIREPRICE) + ($oilqty * OILPRICE) + ($sparkqty * SPARKPRICE);

	echo "Subtotal: $".number_format($totalamount, 2)."<br />";

	$taxrate = 0.10; // local sales tax is 10%
	$totalamount = $totalamount * ( 1 + $taxrate);
	echo "Total including tax: $".number_format($totalamount, 2)."</p>";


	echo 'isset($tireqty): '.isset($tireqty).'<br />';
	echo 'isset($nothere): '.isset($nothere).'<br />';
	echo 'empty($tireqty): '.empty($tireqty).'<br />';
	echo 'empty($nothere): '.empty($nothere).'<br />';
	?>
</body>
</html>