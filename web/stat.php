<?php
echo "
<html>
<body>

<a href='/php/show.php'>Show</a> </td> | 
<a href='/php/stat.php'>Statistics</a> </td> | 
<a href='/php/graph.php'>Graph</a> </td>  
<br>
<br>

<table border='0' align='left'>
<tr>
<td>Name</td>
<td>Last Day</td>
<td>Count</td>
<td>Remains</td>
</tr> ";

$db     =       new SQLite3("/home/pi/code/Day21Inst/Day21.db");

$res = $db->query('SELECT name, max(day) as d, count(day) as m, 21-max(day) as r  FROM Day21 group by name');
while ($row = $res->fetchArray()) {
                echo "<tr>	<td>{$row['name']}</td> 
			  	<td>{$row['d']}</td>
			  	<td>{$row['m']}</td>
				<td>{$row['r']}</td> </tr>";
}
$db->close();
echo "</table>
</body>
</html>";

?>
