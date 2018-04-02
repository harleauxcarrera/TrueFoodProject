<!DOCTYPE html>
<html lang="en" dir="ltr">


<?php
$servername = "localhost";
$username = "harleauxcarrera";
$password = "please313";
$dbname = "TrueFoodInputForms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Recipes (Title, Ingredients)
VALUES ('Apple Pie', 'Apples, Pie')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>






  <head>
    <meta charset="utf-8">
    <title>TrueFood</title>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/main.css">
  </head>


  <body>

      <div class="container"><!--Container 1-->
        <div class="headerImage-text-box">
          <h1>Add new entry:</h1>
          <!-- Trigger the modal with these buttons -->
          <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#recipeModal">Recipes</button>
          <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#eventsModal">Events</button>
            <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#goodsModal">Shopping Goods</button>
        </div>


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
                <form class="recipeForm" action="index.html" method="post">
                  <input type="text" name="name" value="" placeholder="Recipe Title">
                  <h4>(Seperate ingredients by commas)</h4>
                  <input type="text" name="ingredients" value="" placeholder="Ingredients">
                  <h2></h2>
                  <input type="text" name="link" value="" placeholder="Link to cooking instructions">
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
                <form class="recipeForm" action="index.html" method="post">
                  <input type="text" name="title" value="" placeholder="Title">
                  <h2></h2>
                  <input type="text" name="location" value="" placeholder="Location">
                  <h2></h2>
                  <input type="date" name="link" value="" placeholder="Date">
                  <h2></h2>
                  <input type="text" name="description" value="" placeholder="Description">
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
        <div class="modal fade" id="goodsModal" role="dialog">
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
                <!--Dropdown to choose shopping category-->

                <h2></h2>
                <form class="recipeForm" action="index.html" method="post">
                  <h3>Choose Goods Category:</h3>
                  <select>
                    <option value="volvo">Farm Box</option>
                    <option value="saab">Baked Goods</option>
                    <option value="opel">Dry Goods</option>
                    <option value="audi">Eggs & Dairy</option>
                    <option value="audi">Produce</option>
                  </select>
                  <br>
                  <h2></h2>
                  <input type="text" name="title" value="" placeholder="Title">
                  <h2></h2>
                  <input type="text" name="description" value="" placeholder="Description">
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

      </div><!--Container 1-->










  </body>
</html>
