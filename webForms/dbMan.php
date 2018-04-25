
<?php
class Database {
  public static $connection;
  // Creates a new connection.
  public function connect() {
    if (!isset($connection)) {
      self::$connection = new mysqli("localhost", "harleauxcarrera", "please313", "TrueFoodInputForms");
    }
    if (self::$connection == false) {
      throw new Exception('Unable to connect to database.');
    }
    return self::$connection;
  }


function populateDropDown($query){
    $db = new Database();
		$conn = $db->connect();
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0) {

        echo "<option value=''>Select...</option>";
        // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		       echo "<option>" .$row["title"]. "</option>";
	        }
			} else {
	    echo "Nothing here right now. Add entries.";
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



  // Performs the passed SELECT query and returns the result.
  public function select($query) {
    $db = $this->connect();
    $result = $db->query($query);
    if ($result == false) {
      echo (self::$connection->error);
      return false;
    } else {
      $rows = array();
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
    }
  }

  // Performs the passed INSERT query and returns true if successful.
  public function insert($query) {
    $db = $this->connect();
    $result = $db->query($query);
    // echo (self::$connection->error);//I have my own alert set up
    return $result;
  }

}
?>
