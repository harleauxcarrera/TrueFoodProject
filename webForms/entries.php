


<?php session_start(); /* Starts the session */
require 'dbMan.php';

if(!isset($_SESSION['UserData']['Username'])){
	header("location:index.php");
	exit;
}




////recipes query
$name = $_POST['name'];
$ingredients = $_POST['ingredients'];
$link = $_POST['link'];
$recipeQuery = "INSERT INTO Recipes (title, ingredients, link)
VALUES ('$name', '$ingredients', '$link')";


//events query
$title = $_POST['title'];
$location = $_POST['location'];
$date = $_POST['date'];
$description = $_POST['description'];
$eventsQuery = "INSERT INTO Events (title, location, date, description)
 VALUES ('$title', '$location', '$date', '$description')";

//shopping goods query
$category = $_POST['category'];
$title = $_POST['title'];
$description = $_POST['description'];
$goodsQuery = "INSERT INTO Goods (category, title, description)
VALUES('$category', '$title', '$description')";


//create the db manager class
$db = new Database();


//recipes
if(isset($name)){

if ($db->insert($recipeQuery) === TRUE) {
  $result='<div class="alert alert-success">
            New entry added successfully!
          </div>';

} else {
     $error = '<div class="alert alert-danger">
            		Oops! Something went wrong with that entry. Try again.
          		</div>';
  }
}



if(isset($title)){
//events
if ($db->insert($eventsQuery) === TRUE) {

  $result='<div class="alert alert-success">
            New entry added successfully!
          </div>';

} else {
     $error = '<div class="alert alert-danger">
            Oops! Something went wrong with that entry. Try again.
          </div>';
  }
}


//goods
if(isset($category)){
if ($db->insert($goodsQuery) === TRUE) {

  $result='<div class="alert alert-success">
            New entry added successfully!
          </div>';

} else {

  $error = '<div class="alert alert-danger">
            Oops! Something went wrong with that entry. Try again.
          </div>';

  }
}




	function displayDbTable($tableQuery){
		$db = new Database();
		$conn = $db->connect();
		$result = mysqli_query($conn, $tableQuery);

		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		       echo "<tr>
					 			<center><td><button type='button' class='btn btn-warning' data-toggle='modal' data-target='#editRecipeModal'>" .$row["title"]. "</button> </td></center>
					 		</tr>";

	    }
			} else {
	    echo "Nothing here right now. Add entries.";
		}
	}
?>






<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TrueFood</title>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/main.css">
	<link rel="icon" href="http://www.elpasotruefood.com/wp-content/uploads/2017/12/TRUE-7-6-e1514515491312.jpg">
  </head>


  <body>
       <div class="container"><!--Container 1-->


          <div class="headerImage-text-box">
            <!--Condition for displaying the result or the error stated in the insert query above-->
            <div class="alert-container" id="alert-container">
               <?php echo $result ?>
              <?php echo $error ?>
            </div>
          <h1>Add new entry:</h1>
          <!-- Trigger the modal with these buttons -->
          <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#recipeModal">Recipes</button>
          <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#eventsModal">Events</button>
          <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#goodsModal">Shopping Goods</button>
					<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#deleteModal">Delete/Edit entry</button>
				</div>



        <!--echo $result of query in form of alert-->


        <!-- Recipe Modal -->
        <div class="modal fade" id="recipeModal" role="dialog">
          <div class="modal-dialog">

            <!-- Recipe Modal content-->
            <div class="modal-content">
                <!--Modal Header-->
              <div class="modal-header">
                <!--x Button-->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!--Header Title-->
                <h3 class="modal-title">Add New Recipe</h3>
              </div>
              <!--Modal Body-->
              <div class="modal-body">
                <form class="recipeForm" action="entries.php" method="post">
                  <input class="form-control" type="text" name="name" value="" placeholder="Recipe Title" required>
                  <h4>(Seperate ingredients by commas)</h4>
                  <textarea class="form-control" id="text-area" type="text" name="ingredients" value="" placeholder="Ingredients" cols="30" rows="5" required ></textarea>
                  <h2></h2>
                  <input class="form-control" type="text" name="link" value="" placeholder="Link to cooking instructions"  required>
                  <br>
                  <h1></h1>
                  <button class="btn btn-primary btn-lg" type="submit" name="button">Submit</button>
                </form>
              </div>

              <!--Modal Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>







        <!-- Events Modal -->
        <div class="modal fade" id="eventsModal" role="dialog">
          <div class="modal-dialog">

            <!-- Events Modal content-->
            <div class="modal-content">
                <!--Modal Header-->
              <div class="modal-header">
                <!--x Button-->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!--Header Title-->
                <h3 class="modal-title">Add New Event to the Calendar</h3>
              </div>
              <!--Modal Body-->
              <div class="modal-body">
                <form class="recipeForm" action="entries.php" method="post">
                  <input class="form-control" type="text" name="title" value="" placeholder="Title" required>
                  <h2></h2>
                  <input class="form-control" type="text" name="location" value="" placeholder="Location" required>
                  <h2></h2>
                  <input class="form-control" type="date" name="date" value="" placeholder="Date" required>
                  <h2></h2>
          <textarea class="form-control" id="text-area" type="text" name="description" value="" placeholder="Description" cols="80" rows="5" required></textarea>
                  <h1></h1>
                  <button class="btn btn-primary btn-lg" type="submit" name="button">Submit</button>
                </form>
              </div>

              <!--Modal Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>



        <!-- Shopping Goods Modal -->
        <div class="modal fade" id="goodsModal" role="dialog" zindex>
          <div class="modal-dialog">

            <!-- Events Modal content-->
            <div class="modal-content">
                <!--Modal Header-->
              <div class="modal-header">
                <!--x Button-->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!--Header Title-->
                <h3 class="modal-title">Add New Goods</h3>
              </div>
              <!--Modal Body-->
              <div class="modal-body">
                <!--Dropdown to choose shopping category-->

                <h2></h2>
                <form class="recipeForm" action="entries.php" method="post">
                  <h3>Choose Goods Category:</h3>
                  <select name="category" >
                    <option >Farm Box</option>
                    <option >Baked Goods</option>
                    <option >Dry Goods</option>
                    <option >Eggs & Dairy</option>
                    <option >Produce</option>
                  </select>
                  <br>
                  <h2></h2>
                  <input class="form-control" type="text" name="title" value="" placeholder="Title" required>
                  <h2></h2>
                  <textarea class="form-control" id="text-area" type="text" name="description" value="" placeholder="Description" cols="30" rows="5" required></textarea>
                  <h1></h1>
                  <button class="btn btn-primary btn-lg" type="submit" name="button">Submit</button>
                </form>
              </div>

              <!--Modal Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


				<!--DELETE ENTRY MODALS-------------------------------->

				<!-- Delete Entry Modal -->
				<div class="modal fade" id="deleteModal" role="dialog">
					<div class="modal-dialog">

						<!-- Events Modal content-->
						<div class="modal-content">
								<!--Modal Header-->
							<div class="modal-header">
								<!--x Button-->
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<!--Header Title-->
								<h3 class="modal-title">Delete / Edit  entry from:</h3>
							</div>
							<!--Modal Body-->
							<div class="modal-body">
								<button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteRecipeModal">Recipes</button>
			          <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteEventsModal">Events</button>
			          <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteGoodsModal">Shopping Goods</button>

							</div>

							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

				<!-- Delete Recipe Modal -->
				<div class="modal fade" id="deleteRecipeModal" role="dialog">
					<div class="modal-dialog">

						<!-- Delete Recipe Modal content-->
						<div class="modal-content .delete">
								<!--Modal Header-->
							<div class="modal-header">
								<!--x Button-->
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<!--Header Title-->
								<h3 class="modal-title">Click to edit or delete recipe:</h3>
							</div>
							<!--Modal Body-->



								 <div class="col-lg-4">

								    <table class="table table-striped table-bordered custab">
								    <thead>
											<th scope="col">  Title</th>

								    </thead>
												<tr>															<?php
															$query = "SELECT title from Recipes";
															displayDbTable($query);
															 ?>

								    </table>

								</div>



							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

				<!-- Delete Events Modal -->
				<div class="modal fade" role="dialog" id="deleteEventsModal">
					<div class="modal-dialog">
						<!-- Delete Recipe Modal content-->
						<div class="modal-content">
								<!--Modal Header-->
							<div class="modal-header">
								<!--x Button-->
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<!--Header Title-->
								<h3 class="modal-title">Delete a recipe:</h3>
							</div>
							<!--Modal Body-->
								 <div class="col-lg-4">
								    <table class="table table-striped table-bordered custab">
								    <thead>
											<th scope="col">  Title</th>
								    </thead>
												<tr>															<?php
															$query = "SELECT title from Events";
															displayDbTable($query);
															 ?>
								    </table>
								</div>
							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>


				<!-- Delete Goods Modal -->
				<div class="modal fade" role="dialog" id="deleteGoodsModal">
					<div class="modal-dialog">
						<!-- Delete Recipe Modal content-->
						<div class="modal-content">
								<!--Modal Header-->
							<div class="modal-header">
								<!--x Button-->
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<!--Header Title-->
								<h3 class="modal-title">Delete a recipe:</h3>
							</div>
							<!--Modal Body-->
								 <div class="col-lg-4">
										<table class="table table-striped table-bordered custab">
										<thead>
											<th scope="col">  Title</th>
										</thead>
												<tr>															<?php
															$query = "SELECT title from Goods";
															displayDbTable($query);

															 ?>
										</table>
								</div>
							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

				<!-- EDIT specific Recipe Modal -->
        <div class="modal fade" id="editRecipeModal" role="dialog">
          <div class="modal-dialog">

            <!-- Recipe Modal content-->
            <div class="modal-content">
                <!--Modal Header-->
              <div class="modal-header">
                <!--x Button-->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!--Header Title-->
                <h3 class="modal-title">Edit Recipe</h3>
              </div>
              <!--Modal Body-->
              <div class="modal-body">
								  <form class="recipeForm" action="entries.php" method="post">
                  <input class="form-control" type="text" name="name" value="" placeholder="" required>
                  <h4>(Seperate ingredients by commas)</h4>
                  <textarea class="form-control" id="text-area" type="text" name="ingredients" value="" placeholder="Ingredients" cols="30" rows="5" required ></textarea>
                  <h2></h2>
                  <input class="form-control" type="text" name="link" value="" placeholder="Link to cooking instructions"  required>
                  <br>
                  <h1></h1>
                  <button class="btn btn-primary btn-lg" type="submit" name="button">Submit</button>
                </form>
              </div>

              <!--Modal Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button href="https://www.google.com" type="button" class="btn btn-default">Delete Entry</button>
              </div>
            </div>
          </div>
        </div>







      </div><!--Container 1-->










  </body>
</html>
