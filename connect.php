<?php
	function connectDB(){
		return pg_connect("host=localhost port=4321 dbname=cinguettio user=postgres password=unimi");
	}
?>