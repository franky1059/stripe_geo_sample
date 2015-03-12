<?php

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

# include parseCSV class.
require_once('../parsecsv.lib.php');

$new_csv_name = '_data.csv';
$csv = new parseCSV();
//$csv->sort_by = 'id';
//$csv->parse($new_csv_name);
# "4" is the value of the "id" column of the CSV row
//$csv->data[4] = array('firstname' => 'John', 'lastname' => 'Doe', 'email' => 'john@doe.com');
$csv->save($new_csv_name, array(array('1986', 'Home', 'Nowhere', time())), true);
unset($csv);


$csv = new parseCSV();
$csv->auto($new_csv_name);

?>

<style type="text/css" media="screen">
	table { background-color: #BBB; }
	th { background-color: #EEE; }
	td { background-color: #FFF; }
</style>
<table border="0" cellspacing="1" cellpadding="3">
	<tr>
		<?php foreach ($csv->titles as $value): ?>
		<th><?php echo $value; ?></th>
		<?php endforeach; ?>
	</tr>
	<?php foreach ($csv->data as $key => $row): ?>
	<tr>
		<?php foreach ($row as $value): ?>
		<td><?php echo $value; ?></td>
		<?php endforeach; ?>
	</tr>
	<?php endforeach; ?>
</table>