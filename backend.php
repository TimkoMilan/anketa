<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
            $value = $_GET['val'];
            echo "You vote for ".$value.".";
    $dotaz="update vote set ".$value. "= ".$value." + 1 where id = 1";
                $conn = mysqli_connect("localhost:3306","root","","hlasovanie");
		if(!$conn){
			die("Conn fail");
		}
		if(!$conn->query($dotaz)=== TRUE){
			//echo "New record";
		}else{
			//echo "Error connection";
		}
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hlasovanie";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "select * from vote";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
            $bmw = $row["BMW"];
            $mercedes = $row["Mercedes"];
            $audi = $row["Audi"];
            $bentley = $row["Bentley"];
            echo '<div> bmw with '.$bmw.'votes</div>';
            echo '<div> mercedes with '.$mercedes.'votes</div>';	
            echo '<div> audi with '.$audi.'votes</div>';
            echo '<div> bentley with '.$bentley.'votes</div>';
            }
        }else {
                echo "0 results";
            }
            $conn->close();
    ?>

<?php
 
$dataPoints = array(
	array("x"=> 10, "y"=> $bmw),
	array("x"=> 20, "y"=> $mercedes),
	array("x"=> 30, "y"=> $audi),
	array("x"=> 40, "y"=> $bentley)
);
	
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	 theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "All votes"
	},
	data: [{
		type: "column",
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</body>
</html>