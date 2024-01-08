<?php 
function database_config($key)
{
    $configurations = [
        'server' => ['mysql', 'localhost', 'test', 'root', '1234'],
        // เพิ่มค่าอื่นๆ ตามต้องการ
    ];
    return $configurations[$key] ?? null;
}
class Database
{
    private $engine;
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;
    public $message_log;

    public function __construct($engine, $host, $db_name, $username, $password)
    {
        $this->engine =  $engine;
        $this->host =  $host;
        $this->db_name =  $db_name;
        $this->username =  $username;
        $this->password =  $password;
    }
    public function connect()
    {
        $this->conn = null;

        try {
            if ($this->engine === 'mysql') {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            } elseif ($this->engine === 'firebird') {
                $this->conn = new PDO("firebird:dbname={$this->host}:{$this->db_name};charset=NONE", $this->username, $this->password);
            }
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->message_log = 'Connection success';
        } catch (PDOException $e) {
            $this->message_log = "Connection failed: " . $e->getMessage(); // เก็บข้อความ error ในตัวแปร error_message
        }

        return $this->conn;
    }
}

?>