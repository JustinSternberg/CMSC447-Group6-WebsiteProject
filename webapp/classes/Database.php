<?php
/** <Author> Joshua Standiford </Author>
 ** <Date Modified> 7/27/2016 </Date Modified>
 ** <Description>
 ** Database.php acts as a class file used for database functions. 
 ** Collection of connection methods and helper functions populate this 
 ** file
 ** </Description>
 */
class DB {

	/* Constructor for Database class
	 *
	 *
	 */
    function DB() {

    }


    /**
     * Desc: This function connects to the database
     * Called on creation of the database class
     * Preconditions: None
     * Postconditions: Either a new PDO connection is returned or null
     * @return null|PDO
     */
    private function connect(){
        $cred = parse_ini_file(dirname(__FILE__) . "/../db_key.ini");

        try{
		    $conn = new PDO("mysql:host=$cred[servername];dbname=$cred[dbname]", $cred['username'], $cred['password']);

		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    return $conn;
        }
		catch(PDOException $e){
		   	echo "Connection failed: " . $e->getMessage();
        }
		return null;
	}

    /**
     * @param $user
     * @param $pass
     * @return array|bool
     */
    public function authorize($ID, $pass){
        $table = "user_accounts";
        try {
            $conn = $this->connect();
            $stmt = $conn->prepare("select password from $table WHERE campusID = '" . $ID . "'");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            $conn = null;
            return $pass === $result[0]["password"];
        }
        catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function testConnection(){
        return !is_null($this->connect());
    }
    /*
     * @param $ID
     * @return array|bool|string
     */
    public function getName($ID){
        $table = "user_accounts";
        try {
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT * FROM $table WHERE campusID = '" . $ID . "'");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            $conn = null;

            foreach ($result as $k => $v) {
                return $v["firstName"] . " " . $v["lastName"];
            }

            return $result;
        }
        catch(PDOException $e){
            echo $e;
            return null;
        }
    }

    public function archive($ID, $CODE){
        $table = "LIBRARY_Student_Apps";
        try {
            $conn = $this->connect();
            $stmt = $conn->prepare("UPDATE $table SET archived = '" . date('Y-m-d') . "', appStatus = '" . $CODE . "' WHERE campusID = '" . $ID . "'");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            $conn = null;

            return true;
        }
        catch(PDOException $e){
            echo $e;
            return false;
        }
    }
}
