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

   
 //Select all contentin our query 

 $no_per_page = 4; //This is the number of Items we want per page

  $current_page = (isset($_GET['page_id'])) ? $_GET['page_id'] : 1; //Gets the current page, if not set, default to page 1

 $skip = ($current_page - 1) * $no_per_page; //Gets the total number of page we want to skip when making request. When we are on page one, We don't need to skip any Item.

 $query = \Couchbase\N1qlQuery::fromString("SELECT * FROM `commenting`  LIMIT $no_per_page OFFSET $skip");

 $result = $bucket->query($query);

 //count total number of result in the database

 $total = $bucket->query(\Couchbase\N1qlQuery::fromString("SELECT COUNT(comment) total FROM `commenting`"));

 $total = $total->rows[0]->total;
 
 $number_of_pages = ceil( $total/$no_per_page ); //calculate number of pages


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
     
     <div class="container" style="margin-left: auto; margin-right: auto; width: 700px;">
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
           
      <?php foreach( $result->rows as $comment ):?>
        <div> 
                  
          <div class="alert alert-success" role="alert">
            <h5 class="alert-heading"> By: <?=$comment->commenting->name?>, Created At: <?=$comment->commenting->created_at?> </h5><br>
            <p> <?=$comment->commenting->comment?></p>
            <hr>
          </div>

       </div>
     <?php endforeach; ?>
               
		</div>

		<div id="pagination">
      
      <nav aria-label="Page navigation example">
        <ul class="pagination">
        <?php for($i = 1; $i <= $number_of_pages; $i++): ?>
          <li class="page-item"><a class="page-link" href="?page_id=<?=$i?>"><?=$i?></a></li>
        <?php endfor; ?>
        </ul>
      </nav>

		</div>

	 </div>

  </div>
    
  </body>
</html>