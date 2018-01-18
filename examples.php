<? 
echo "hello world\n";

// Using operators
$a = 10;
$b = 10;
$result = $a + $b;

echo "$result\n";

// Define Constants
define('TIREPRICE', 100);
echo TIREPRICE;
echo "\n";

// String concatenation
$a = "Hello ";
$b = "World";

echo $a.$b;
echo "\n";

// echo "<p>Items Ordered: ".totalqty."<br /> </p>";


// Reference Operator
$a = 5;
$b = &$a;
$a = 7;
$b = 10;
$a = 9;

echo "$a\n";
echo "$b\n";

// Variable handling functions
$a = 56;
echo gettype($a).'<br />';
settype($a, 'float');
echo gettype($a).'<br />';

// Testing variable Status
echo 'isset($tireqty): '.isset($tireqty).'<br />';
echo 'isset($nothere): '.isset($nothere).'<br />';
echo 'empty($tireqty): '.empty($tireqty).'<br />';
echo 'empty($nothere): '.empty($nothere).'<br />';


?>