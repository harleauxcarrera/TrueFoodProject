
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


  function displayDbTable($tableQuery){
    $db = new Database();
    $conn = $db->connect();
    $result = mysqli_query($conn, $tableQuery);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "Recipe Title: " . $row["title"];
      }
  } else {
      echo "Nothing the table right now";
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
  // Prepares a statement for execution by the database.
  public function prepare($statement) {
    $db = $this->connect();
    return $db->prepare($statement);
  }
  // Executes and closes a prepared statement, returning its result
  public function execute($statement) {
    $statement->execute();
    $result = $statement->get_result();
    $statement->close();
    if ($result == false) {
      return false;
    } else {
      $rows = array();
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
    }
    return $result;
  }
  // Escapes the passed string and returns it.
  public function real_escape_string($string) {
    $db = $this->connect();
    return $db->real_escape_string($string);
  }
  // Performs the passed PROCEDURE and returns the result.
  public function call($query) {
    $db = $this->connect();
    $result = $db->query($query);
    return $result;
  }
  // Escapes a string
  public function escape($string) {
    $db = $this->connect();
    return $db->real_escape_string($string);
  }
  // Retrieves errorp
  public function error() {
    $db = $this->connect();
    return $db->error;
  }
}
?>
