<?php


//include config details

require_once('config.php');

//include connection to the database.

require_once('db.php');

if( $_SERVER['REQUEST_METHOD'] == "POST"){
  
  $uid = uniqid();

  $comment = [
     
     "_id"           => $uid,
     "name"       => $_POST["name"],
     "comment"    => $_POST["comment"],
     "created_at" => date("Y-m-d H:i:s")
  ];

  $bucket->insert($uid, $comment);

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>

  <div class="container">
     
     <div class="container" style="margin-left: auto; margin-right: auto; width: 400px;">
        <h4 class="text-center">Add a comment</h4> 

		<form action="" method="POST">
		  <div class="form-group">
		    <label for="name">Name:</label>
		    <input type="text" class="form-control" name="name" required>
		  </div>

		<div class="form-group">
		  <label for="comment">Comment:</label>
		  <textarea class="form-control" rows="5" name="comment" required> </textarea>
		</div>

		  <button type="submit" class="btn btn-primary">Submit</button>
		</form> <br />


		<div >
            <h4 class="text-center">Listing comments</h4> 


		</div>

		<div id="pagination">

		</div>

	 </div>

  </div>
    
  </body>
</html>