<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database {

    private $dns = "mysql:host=localhost;dbname=poultry";
    private $dbuser = "root";
    private $dbpass = "";
    public $conn;
    public function __construct() 
{
        try {
           $this->conn = new PDO($this->dns, $this->dbuser, $this->dbpass);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error : '. $e->getMessage();
        }
}

// check inputes
public function test_input($data)
{
    if (!is_null($data) && is_string($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }
    return $data;
}
// check Error message alert

public function showMessage($type, $message)
{
    return '<div class="alert alert-'.$type.' alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong class="text-center">'.$message.'</strong>
    </div>';
}
}

?>