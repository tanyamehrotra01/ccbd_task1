<?php

	$user_id = $_GET['user_id'];

	$cmd = "mongo --eval \"var user_id='$user_id'\" db_newsfeed.js";

	exec($cmd, $output, $status);

	$json = mongoOutputToJSON($output, $status);

	header('Location: newsfeed.php');

    function mongoOutputToJSON($output, $status)
    {
  		$json = "";

		if ($status) echo "Exec command failed";
		else
		{
			$i = 0; 
			foreach($output as $line) 
				if ($i++ > 6) 
				{	
					$json .= "$line\n"; 
				}
		}

		$json = json_decode($json);

		switch (json_last_error()) {
	        case JSON_ERROR_NONE:
	        break;
	        case JSON_ERROR_DEPTH:
	            echo ' - Maximum stack depth exceeded';
	        break;
	        case JSON_ERROR_STATE_MISMATCH:
	            echo ' - Underflow or the modes mismatch';
	        break;
	        case JSON_ERROR_CTRL_CHAR:
	            echo ' - Unexpected control character found';
	        break;
	        case JSON_ERROR_SYNTAX:
	            echo ' - Syntax error, malformed JSON';
	        break;
	        case JSON_ERROR_UTF8:
	            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
	        break;
	        default:
	            echo ' - Unknown error';
	        break;
	    }

		return $json;
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript">
		var json = <?php echo json_encode($json); ?>;
		document.write(JSON.stringify(json))
	</script>
</body>
</html>
