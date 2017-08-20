<?php


//include config details

require_once('config.php');

//include connection to the database.

require_once('db.php');

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
           
           <?php 

             foreach( $result->rows as $result ): ?>
			  

	           <div class="card">

	              By: <?= $result->name ?>, On: <?= $result->created_at ?> <br><br>

	              <?= $result->comment ?>
	           </div> <br>
			 
		   <?php endforeach; ?>


		</div>

		<div id="pagination">

		</div>

	 </div>

  </div>
    
  </body>
</html>