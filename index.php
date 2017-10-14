<?php 
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

<script type="" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css
"></script>
<script type="text/javascript" src="
https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
</script>


<style type="text/css">
form{
	margin:350px;
}
	body{
		background:url("welcomepic.png");
		background-size: cover;
		background-repeat: no-repeat; 
		color: white;
	}
	.center {
  
  margin-left: 50%;
  margin-right: 50%;  
}
	
</style>
<script type="text/javascript">
	
</script>

	<title>Welcome</title>
</head>
<body>

<form class="form-inline center" action="game.php" method="post">
  <label class="sr-only" for="name">NAME:</label>
  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name" name="name"  placeholder="Kunj Patel" >

  
  <button type="submit" class="btn btn-success" name="submit"> Submit </button>
  
</form>

</body>
</html>

