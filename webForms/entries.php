


<?php session_start(); /* Starts the session */
require 'dbMan.php';

if(!isset($_SESSION['UserData']['Username'])){
	header("location:index.php");
	exit;
}


/////////////////////////INSERT ENTRY QUERIES/////////////////////////////////////////////////
////recipes query
if (isset($_POST['name'])  && isset($_POST['ingredients']) && isset($_POST['link'])){
  $name = $_POST['name'];
  $ingredients = $_POST['ingredients'];
  $link = $_POST['link'];
  $recipeQuery = "INSERT INTO Recipes (title, ingredients, link)
VALUES ('$name', '$ingredients', '$link')";

}




//events query

if ( isset($_POST['title'])  && isset($_POST['location']) && isset($_POST['date']) && isset($_POST['description'])){
  $title = $_POST['title'];
  $location = $_POST['location'];
  $date = $_POST['date'];
  $description = $_POST['description'];
  $eventsQuery = "INSERT INTO Events (title, location, date, description)
 VALUES ('$title', '$location', '$date', '$description')";
}

//shopping goods query
if (isset($_POST['category'])  && isset($_POST['title']) && isset($_POST['description']) ){
  $category = $_POST['category'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $goodsQuery = "INSERT INTO Goods (category, title, description)
  VALUES('$category', '$title', '$description')";
}


///////////////////////////////////EDIT QUERIES//////////////////////////////////////////////////
//Edit recipe $query
if (isset($_POST['specificRecipe'])  && isset($_POST['editIngredients']) && isset($_POST['editLink']) ){
  $editRecipeName = $_POST['specificRecipe'];
  $editIngredients= $_POST['editIngredients'];
  $editLink = $_POST['editLink'];
  $editRecipeQuery = "UPDATE Recipes SET link = '$editLink',
 ingredients= '$editIngredients' WHERE title = '$editRecipeName' ";
}
 //Edit Event $query
if (isset($_POST['specificEvent'])  && isset($_POST['editEventLocation']) && isset($_POST['editEventDescr']) && isset($_POST['editEventDate'])){

  $editEventName = $_POST['specificEvent'];
  $editEventLocation= $_POST['editEventLocation'];
  $editEventDescr = $_POST['editEventDescr'];
  $editEventDate = $_POST['editEventDate'];
  $editEventQuery = "UPDATE Events SET location = '$editEventLocation',
  date= '$editEventDate' , description='$editEventDescr' WHERE title = '$editEventName' ";
}
	//Edit Goods $query
if (isset($_POST['specificGood'])  && isset($_POST['editCategory']) && isset($_POST['editGoodDescription']) ){

	$editGoodName = $_POST['specificGood'];
	$editCategory= $_POST['editCategory'];
	$editGoodDescription = $_POST['editGoodDescription'];
	$editGoodsQuery = "UPDATE Goods SET category = '$editCategory',
	 description= '$editGoodDescription' WHERE title = '$editGoodName' ";
}

//create the db manager instance
$db = new Database();

//////////////////////////////////////////ENTRY INSERTS/////////////////////////////////////////////////////
//recipes

//
//
// /
//recipes
if(isset($name)){
if ($db->insert($recipeQuery) === TRUE) {
	$result='<script>
								function myFunction() {
										alert("New Entry Added!");
								}
						</script>';
}else{
	$error = '<div class="alert alert-danger">
						Oops! Something went wrong with that entry. Try again.
						</div>';
  }
}
//
//events
if(isset($title)){
if ($db->insert($eventsQuery) === TRUE) {
	$result='<script>
								function myFunction() {
										alert("New Entry Added!");
								}
						</script>';
}else{
	$error = '<div class="alert alert-danger">
						Oops! Something went wrong with that entry. Try again.
						</div>';
  }
}
//
//
//goods
if(isset($category)){
if ($db->insert($goodsQuery) === TRUE) {
	$result='<script>
								function myFunction() {
										alert("New Entry Added!");
								}
						</script>';
}else{
	$error = '<div class="alert alert-danger">
						Oops! Something went wrong with that entry. Try again.
						</div>';
  }
}
//
//
//
// //////////////////////////////////////////ENTRY  EDIT INSERTS/////////////////////////////////////////////////////
//recipes
if(isset($editRecipeName)){
	if ($db->insert($editRecipeQuery) === TRUE) {
		$result='<script>
									function myFunction() {
											alert("New Entry Added!");
									}
							</script>';
	}else{
		$error = '<div class="alert alert-danger">
							Oops! Something went wrong with that entry. Try again.
							</div>';
	  }
}
//Events
if(isset($editEventName)){
if ($db->insert($editEventQuery) === TRUE) {
	$result='<script>
								function myFunction() {
										alert("New Entry Added!");
								}
						</script>';
}else{
	$error = '<div class="alert alert-danger">
						Oops! Something went wrong with that entry. Try again.
						</div>';
  }
}
//Goods
if(isset($editGoodName)){
if ($db->insert($editGoodsQuery) === TRUE) {
	$result='<script>
								function myFunction() {
										alert("New Entry Added!");
								}
						</script>';
}else{
	$error = '<div class="alert alert-danger">
						Oops! Something went wrong with that entry. Try again.
						</div>';
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
	<link href="https://fonts.googleapis.com/css?family=Black+Han+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">
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
          <button type="button" class="btn btn-warning btn-lg main" data-toggle="modal" data-target="#recipeModal">Recipes</button>
          <button type="button" class="btn btn-warning btn-lg main" data-toggle="modal" data-target="#eventsModal">Events</button>
          <button type="button" class="btn btn-warning btn-lg main" data-toggle="modal" data-target="#goodsModal">Shopping Goods</button>
					<button type="button" class="btn btn-danger btn-lg main" data-toggle="modal" data-target="#deleteModal">Delete/Edit entry</button>
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

                  <h2></h2>
                  <input class="form-control" type="text" name="link" value="" placeholder="Link to cooking instructions"  required>
                  <h2></h2>
									<i><p>(Seperate ingredients by commas)<p></i>
									<textarea class="form-control" id="text-area" type="text" name="ingredients" value="" placeholder="Ingredients" cols="30" rows="5" required ></textarea>
									<br>
									<h1></h1>
									<button class="btn btn-primary btn-lg main"  name="button"  type="submit">Submit</button>
                </form>
              </div>

              <!--Modal Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default main-close" data-dismiss="modal">Close</button>
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
                  <button class="btn btn-primary btn-lg main" type="submit" name="button">Submit</button>
                </form>
              </div>

              <!--Modal Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default main-close" data-dismiss="modal">Close</button>
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
                  <button class="btn btn-primary btn-lg main" type="submit" name="button">Submit</button>
                </form>
              </div>

              <!--Modal Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default main-close" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>







				<!--DELETE ENTRY MODALS-------------------------------->
				<!-- Delete Entries Modal -->
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
								<button type="button" class="btn btn-warning btn-lg main" data-toggle="modal" data-target="#editRecipeModal">Recipes</button>
			          <button type="button" class="btn btn-warning btn-lg main" data-toggle="modal" data-target="#editEventsModal">Events</button>
			          <button type="button" class="btn btn-warning btn-lg main" data-toggle="modal" data-target="#editGoodsModal">Shopping Goods</button>
							</div>
							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default main-close" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>








				<!-- EDIT/DELETE specific Recipe Modal -->
        <div class="modal fade" id="editRecipeModal" role="dialog">
          <div class="modal-dialog">
            <!-- Recipe Modal content-->
            <div class="modal-content">
                <!--Modal Header-->
              <div class="modal-header">
                <!--x Button-->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!--Header Title-->
                <h3 class="modal-title">Edit Recipe:</h3>
              </div>
              <!--Modal Body-->
              <div class="modal-body">
						  <form class="recipeForm" action="entries.php" method="post">
                </form>
								<form class="recipeForm" action="entries.php" method="post">
									<!--Drop down to choose specific recipe to edit (Use value of the select element as title in form)-->
									<select name = "specificRecipe" >
										<?php
											$query = "SELECT title from Recipes";
											$db->populateDropDown($query);
											?>
									</select>
                  <h2></h2>
                  <input class="form-control" type="text" name="editLink" value="" placeholder="Edit link to cooking instructions"  required>
                  <h2></h2>
									<i><p>(Seperate ingredients by commas)<p></i>
									<textarea class="form-control" id="text-area" type="text" name="editIngredients" value="" placeholder="Edit ingredients" cols="30" rows="5" required ></textarea>
									<br>
									<h1></h1>
									<button class="btn btn-primary btn-lg main" type="submit" name="button">Submit</button>
                </form>
              </div>
              <!--Modal Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default "  id="main-close" data-dismiss="modal">Close</button>
								<button href="https://www.google.com" type="button" class="btn btn-default main-delete">Delete Entry</button>
              </div>
            </div>
          </div>
        </div>





				<!-- EDIT/DELETE specific Event Modal -->
				<div class="modal fade" id="editEventsModal" role="dialog">
					<div class="modal-dialog">
						<!-- Recipe Modal content-->
						<div class="modal-content">
								<!--Modal Header-->
							<div class="modal-header">
								<!--x Button-->
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<!--Header Title-->
								<h3 class="modal-title">Edit Event:</h3>
							</div>
							<!--Modal Body-->
							<div class="modal-body">
							<form class="recipeForm" action="entries.php" method="post">
								</form>
								<form class="recipeForm" action="entries.php" method="post">
									<!--Drop down to choose specific recipe to edit (Use value of the select element as title in form)-->
									<select name = "specificEvent" >
										<?php
											$query = "SELECT title from Events";
											$db->populateDropDown($query);
											?>
									</select>
									<h1></h1>
									<p style="padding-left:5px;">Edit Event's Date:</p>
									<input class="form-control" type="date" name="editEventDate" value="" required>
									<h2></h2>
									<input class="form-control" type="text" name="editEventLocation" value="" placeholder="Edit Event's Location"  required>
									<h2></h2>
									<i><p>(Seperate ingredients by commas)<p></i>
									<textarea class="form-control" id="text-area" type="text" name="editEventDescr" value="" placeholder="Edit Event's Decscription" cols="30" rows="5" required ></textarea>
									<br>
									<h1></h1>

									<button class="btn btn-primary btn-lg main" type="submit" name="button">Submit</button>
								</form>
							</div>
							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default main-close" data-dismiss="modal">Close</button>
								<button href="https://www.google.com" type="button" class="btn btn-default main-delete">Delete Entry</button>
							</div>
						</div>
					</div>
				</div>

				<!-- EDIT/DELETE specific Goods Modal -->
				<div class="modal fade" id="editGoodsModal" role="dialog">
					<div class="modal-dialog">
						<!-- Recipe Modal content-->
						<div class="modal-content">
								<!--Modal Header-->
							<div class="modal-header">
								<!--x Button-->
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<!--Header Title-->
								<h3 class="modal-title">Edit Good:</h3>
							</div>
							<!--Modal Body-->
							<div class="modal-body">
							<form class="recipeForm" action="entries.php" method="post">
								</form>
								<form class="recipeForm" action="entries.php" method="post">
									<!--Drop down to choose specific recipe to edit (Use value of the select element as title in form)-->
									<select name = "specificGood" >
										<?php
											$query = "SELECT title from Goods";
											$db->populateDropDown($query);
											?>
									</select>
									<h2></h2>

									<p style="padding-left:2px;">Edit Goods' Category:</p>
									<select name="editCategory" >
										<option >Farm Box</option>
										<option >Baked Goods</option>
										<option >Dry Goods</option>
										<option >Eggs & Dairy</option>
										<option >Produce</option>
									</select>
									<h2></h2>
									<textarea class="form-control" id="text-area" type="text" name="editGoodDescription" value="" placeholder="Edit Description" cols="30" rows="5" required ></textarea>
									<br>
									<h1></h1>
									<button class="btn btn-primary btn-lg main" type="submit" name="button">Submit</button>
								</form>
							</div>
							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default main-close" data-dismiss="modal">Close</button>
								<button href="https://www.google.com" type="button" class="btn btn-default main-delete">Delete Entry</button>
							</div>
						</div>
					</div>
				</div>







      </div><!--Container 1-->










  </body>
</html>
