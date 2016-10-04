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
<<<<<<< HEAD
            //$conn = new PDO("mysql:host=studentdb-maria.gl.umbc.edu;dbname=jstand1", "jstand1", "jstand1");
=======
>>>>>>> fef812aff75a8dad58ee649dd4dd18f6079051af
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
<<<<<<< HEAD
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
=======
>>>>>>> fef812aff75a8dad58ee649dd4dd18f6079051af
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
<<<<<<< HEAD
        $table = "user_accounts";
=======
        $table = "LIBRARY_Student_Apps";
>>>>>>> fef812aff75a8dad58ee649dd4dd18f6079051af
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

<<<<<<< HEAD
=======
    public function submitWorkStudy($data){
        if($this->applied($data["campusID"])){
            return false;
        }
        try {
            $table = "LIBRARY_Student_App_Work";
            $conn = $this->connect();
            $stmt = $conn->prepare("INSERT INTO LIBRARY_Student_App_Work (campusID, semesterApplied, mondayOne, mondayTwo, 
                                                                          tuesdayOne, tuesdayTwo, wednesdayOne, wednesdayTwo,
                                                                           thursdayOne, thursdayTwo, fridayOne, fridayTwo,
                                                                           saturdayOne, saturdayTwo, sundayOne, sundayTwo,
                                                                           workedBefore, workedBeforeWhere, currentlyWorking,
                                                                           currentlyWhere, computerExp, officeEquipment, publicExp,
                                                                           foreignLang, specialSkills, recentEmployer, employerAddress, 
                                                                           supervisorName, position, employedFrom, employedTo, reasonForLeaving,
                                                                           recentEmployerTwo, employerAddressTwo, supervisorNameTwo, positionTwo, 
                                                                           employedFromTwo, employedToTwo, reasonForLeavingTwo, academicStatus, anticipatedGrad, major)
                                                                          VALUES(:campusID, :semesterApplied, :mondayOne, :mondayTwo, 
                                                                          :tuesdayOne, :tuesdayTwo, :wednesdayOne, :wednesdayTwo,
                                                                          :thursdayOne, :thursdayTwo, :fridayOne, :fridayTwo,
                                                                          :saturdayOne, :saturdayTwo, :sundayOne, :sundayTwo,
                                                                          :workedBefore, :workedBeforeWhere, :currentlyWorking,
                                                                          :currentlyWhere, :computerExp, :officeEquipment, :publicExp,
                                                                          :foreignLang, :specialSkills, :recentEmployer, :employerAddress, 
                                                                          :supervisorName, :position, :employedFrom, :employedTo, :reasonForLeaving,
                                                                          :recentEmployerTwo, :employerAddressTwo, :supervisorNameTwo, :positionTwo, 
                                                                          :employedFromTwo, :employedToTwo, :reasonForLeavingTwo, :academicStatus, :anticipatedGrad, :major)");
            $stmt->bindParam(':campusID', $campusID);
            $stmt->bindParam(':semesterApplied', $semesterApplied);
            $stmt->bindParam(':mondayOne', $mondayOne);
            $stmt->bindParam(':mondayTwo', $mondayTwo);
            $stmt->bindParam(':tuesdayOne', $tuesdayOne);
            $stmt->bindParam(':tuesdayTwo', $tuesdayTwo);
            $stmt->bindParam(':wednesdayOne', $wednesdayOne);
            $stmt->bindParam(':wednesdayTwo', $wednesdayTwo);
            $stmt->bindParam(':thursdayOne', $thursdayOne);
            $stmt->bindParam(':thursdayTwo', $thursdayTwo);
            $stmt->bindParam(':fridayOne', $fridayOne);
            $stmt->bindParam(':fridayTwo', $fridayTwo);
            $stmt->bindParam(':saturdayOne', $saturdayOne);
            $stmt->bindParam(':saturdayTwo', $saturdayTwo);
            $stmt->bindParam(':sundayOne', $sundayOne);
            $stmt->bindParam(':sundayTwo', $sundayTwo);
            $stmt->bindParam(':workedBefore', $workedBefore);
            $stmt->bindParam(':workedBeforeWhere', $workedBeforeWhere);
            $stmt->bindParam(':currentlyWorking', $currentlyWorking);
            $stmt->bindParam(':currentlyWhere', $currentlyWhere);
            $stmt->bindParam(':computerExp', $computerExp);
            $stmt->bindParam(':officeEquipment', $officeEquipment);
            $stmt->bindParam(':publicExp', $publicExp);
            $stmt->bindParam(':foreignLang', $foreignLang);
            $stmt->bindParam(':specialSkills', $specialSkills);
            $stmt->bindParam(':recentEmployer', $recentEmployer);
            $stmt->bindParam(':employerAddress', $employerAddress);
            $stmt->bindParam(':supervisorName', $supervisorName);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':employedFrom', $employedFrom);
            $stmt->bindParam(':employedTo', $employedTo);
            $stmt->bindParam(':reasonForLeaving', $reasonForLeaving);
            $stmt->bindParam(':recentEmployerTwo', $recentEmployerTwo);
            $stmt->bindParam(':employerAddressTwo', $employerAddressTwo);
            $stmt->bindParam(':supervisorNameTwo', $supervisorNameTwo);
            $stmt->bindParam(':positionTwo', $positionTwo);
            $stmt->bindParam(':employedFromTwo', $employedFromTwo);
            $stmt->bindParam(':employedToTwo', $employedToTwo);
            $stmt->bindParam(':reasonForLeavingTwo', $reasonForLeavingTwo);
            $stmt->bindParam(':academicStatus', $academicStatus);
            $stmt->bindParam(':anticipatedGrad', $anticipatedGrad);
            $stmt->bindParam(':major', $major);
            $campusID = $data["campusID"];
            $semesterApplied = $data["semester"];
            $mondayOne = $data["Monday1"];
            $mondayTwo = $data["Monday2"];
            $tuesdayOne = $data["Tuesday1"];
            $tuesdayTwo = $data["Tuesday2"];
            $wednesdayOne = $data["Wednesday1"];
            $wednesdayTwo = $data["Wednesday2"];
            $thursdayOne = $data["Thursday1"];
            $thursdayTwo = $data["Thursday2"];
            $fridayOne = $data["Friday1"];
            $fridayTwo = $data["Friday2"];
            $saturdayOne = $data["Saturday1"];
            $saturdayTwo = $data["Saturday2"];
            $sundayOne = $data["Sunday1"];
            $sundayTwo = $data["Sunday2"];
            $workedBefore = $data["prior"];
            $workedBeforeWhere = $data["priorInfo"];
            $currentlyWorking = $data["else"];
            $currentlyWhere = $data["whereElse"];
            $computerExp = $data["compExp"];
            $officeEquipment = $data["ofmacExp"];
            $publicExp = $data["psExp"];
            $foreignLang = $data["languages"];
            $specialSkills = $data["skills"];
            $recentEmployer = $data["recEmp"];
            $employerAddress = $data["recEmpAd"];
            $supervisorName = $data["recEmpSup"];
            $position = $data["recEmpDut"];
            $employedFrom = $data["recEmpd1"];
            $employedTo = $data["recEmpd2"];
            $reasonForLeaving = $data["recEmplv"];
            $recentEmployerTwo = $data["prevEmp"];
            $employerAddressTwo = $data["prevEmpAd"];
            $supervisorNameTwo = $data["prevEmpSup"];
            $positionTwo = $data["prevEmpDut"];
            $employedFromTwo = $data["prevEmpd1"];
            $employedToTwo = $data["prevEmpd2"];
            $reasonForLeavingTwo = $data["prevEmplv"];
            $academicStatus = $data["status"];
            $anticipatedGrad = $data["grad"];
            $major = $data["field"];
            $stmt->execute();
        }
        catch(PDOException $e){
            return false;
        }
        return true;
    }
>>>>>>> fef812aff75a8dad58ee649dd4dd18f6079051af
}
