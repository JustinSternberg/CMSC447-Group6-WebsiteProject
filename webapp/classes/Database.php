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
            //$conn = new PDO("mysql:host=studentdb-maria.gl.umbc.edu;dbname=jstand1", "jstand1", "jstand1");
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
     * Tests to see if connection works
     * Precondtions: None
     * Postconditions: Bool is returned
     * @return bool
     */
    public function testConn(){
        $conn = $this->connect();
        return !is_null($conn);
    }

    /**
     * @param $ID
     * @return array|bool|string
     */
    public function getName($ID){
        $table = "LIBRARY_Student_Apps";
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

    /**
     * Submits a query to the database
     */
    public function selectAll(){
        $table = "user_accounts";
        $conn = $this->connect();
        $stmt = $conn->prepare("select * from $table");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        $conn = null;
        return $result;
    }

    public function getAppData($ID){
        $table = "LIBRARY_Student_Apps";
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM $table WHERE campusID = '" . $ID ."'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        $conn = null;

        foreach($result as $k=>$v) {
            return $v;
        }

        return $result;
    }

    public function getWorkAppData($ID){
        $table = "LIBRARY_Student_App_Work";
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM $table WHERE campusID = '" . $ID ."'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        $conn = null;

        foreach($result as $k=>$v) {
            return $v;
        }

        return $result;
    }

    /**
     * @param $UMBCID - The UMBC ID of the user checking their application status
     * @return array - Associate array containing the application status
     */
    public function getAppStatus($UMBCID){
        $table = "LIBRARY_Student_Apps";
        $conn = $this->connect();
        $stmt = $conn->prepare("select * from $table WHERE campusID = '" . $UMBCID . "'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        $conn = null;

        foreach($result as $k=>$v) {
            return $v["appStatus"];
        }
        return $result;
    }

    /**
     * @param $UMBCID
     * @return bool - True if the user already applied
     *              - False if the user hasn't applied yet
     */
    public function applied($UMBCID){
        $table = "LIBRARY_Student_Apps";
        $conn = $this->connect();
        $stmt = $conn->prepare("select * from $table WHERE campusID = '" . $UMBCID . "'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $conn = null;

        if($result){
           return true;
        }
        return false;
    }

    /**
     * This function takes the user data from the client side
     * and submits it to the database.
     * @param $data - Information pertaining to the user applying
     * @return bool - Return's true if the app was submitted successfully
     *              - Return's false if the ID already exists or an error occurred
     */
    public function submitApp($data){
        if($this->applied($data["campusID"])){
            return false;
        }
        try {
            $table = "LIBRARY_Student_Apps";
            $conn = $this->connect();
            $stmt = $conn->prepare("INSERT INTO LIBRARY_Student_Apps (lastname, firstname, address, city, state, zip, email, campusID, dept, comments, notes, appStatus, dateApplied)
                                VALUES (:lastname, :firstname, :address, :city, :state, :zip, :email, :campusID, :dept, :comments, :notes, :status, :dateApplied)");
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state);
            $stmt->bindParam(':zip', $zip);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':campusID', $campusID);
            $stmt->bindParam(':dept', $dept);
            $stmt->bindParam(':comments', $NA);
            $stmt->bindParam(':notes', $NA);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':dateApplied', $date);
            $date = date("Y-m-d");
            $lastname = $data["lName"];
            $firstname = $data["fName"];
            $address = $data["street"];
            $city = $data["city"];
            $state = $data["state"];
            $zip = $data["zip"];
            $email = $data["email"];
            $campusID = $data["campusID"];
            $dept = $data["dept"];
            $status = "submitted";
            $NA = "N/A";
            $stmt->execute();
        }
        catch(PDOException $e){
            return false;
        }
        return true;
    }

}
