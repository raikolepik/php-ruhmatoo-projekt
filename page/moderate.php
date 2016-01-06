<?php
	$page_title = "Kommentaaride modereerimine";
	$page_file_name = "moderate.php";
	require_once("../header.php");
	require_once("../functions.php");
?>
<Title><?php echo $page_title?></title>

<h1>Kommentaarid</h1>
	<form action="table.php" method="get">
		<input name="keyword" type="search" value="<?=$keyword?>">
		<input type="submit" value="otsi">
	<form>
	<br><br>
	<table border=1>
	<tr>
	<th>Kommentaari id</th>
	<th>Proffessori id</th>
    <th>Kasutaja id</th>
    <th>Kommentaari aeg</th>
    <th>Kommentaar</th>
	<th>Kontrollitud</th>
	</tr>
<?php

	for($i = 0; $i < count($car_array); $i++){
		
	if(isset($_GET["edit"]) && $_GET["edit"] == $car_array[$i]->id){
		echo "<tr>";
            echo "<form action='table.php' method='get'>";
            // input mida välja ei näidata
            echo "<input type='hidden' name='comment_id' value='".$car_array[$i]->comment_id."'>";
            echo "<td>".$car_array[$i]->comment_id."</td>";
            echo "<td>".$car_array[$i]->pro_id."</td>";
			echo "<td>".$car_array[$i]->user_id."</td>";
            echo "<td>".$car_array[$i]->inserted."</td>";
            echo "<td>".$car_array[$i]->comment."</td>";
			echo "<td><input name='confirm' value='".$car_array[$i]->accepted."' ></td>";
            echo "<td><input name='update' type='submit'></td>";
            echo "<td><a href='table.php'>cancel</a></td>";
            echo "</form>";
            echo "</tr>";
		 }else{
            
            echo "<tr>";
            echo "<td>".$car_array[$i]->comment_id."</td>";
			echo "<td>".$car_array[$i]->pro_id."</td>";
            echo "<td>".$car_array[$i]->user_id."</td>";
            echo "<td>".$car_array[$i]->inserted."</td>";
            echo "<td>".$car_array[$i]->comment."</td>";
			echo "<td>".$car_array[$i]->accepted."</td>";
			echo "<td><a href='?edit=".$car_array[$i]->id."'>edit</a></td>";
			
			
			
		
		
			
            echo "<td><a href='?delete=".$car_array[$i]->id."'>X</a></td>";
			echo "<td><a href='?edit=".$car_array[$i]->id."'>edit</a></td>";
			}
			
            
            echo "</tr>";
		}
	
	
?>
</table>
<?php
	
	require_once("../footer.php");
?>