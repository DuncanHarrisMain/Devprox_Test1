<?php 
    Class Connector
    {
        private $conn; 
        private $data;
        private $error2 = [];

        function __construct($post_data)
        {
            $this->data = $post_data;
        }

        public function runQueries()
        {
            $this->conn = mysqli_connect('localhost', 'root', 'password', 'devprox_db'); 
            if(!$this->conn)
            {
                echo "Connection error: " . mysqli_connect_error();
            } 
            $this->duplicateCheck();
            if(!empty($this->error2))
            {
               return $this->error2;
            }
            else
            {
                $this->insertSql();
                mysqli_close($this->conn);
            }
            
        }

        private function duplicateCheck()
        {
            $idNo = mysqli_real_escape_string($this->conn , $this->data["idNo"]);
            $sql = 'SELECT id_number FROM user WHERE id_number='.$idNo;
            $result = mysqli_query($this->conn, $sql);
            $id = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if(!empty($id))
            {
                $this->addError("idNo", "No duplicate Id numbers");
            }
            
        }

        private function insertSql()
        {
         
            $name = mysqli_real_escape_string($this->conn , $this->data["name"]);
            $surname = mysqli_real_escape_string($this->conn , $this->data["surname"]);
            $idNo = mysqli_real_escape_string($this->conn , $this->data["idNo"]);
            $dob = mysqli_real_escape_string($this->conn , $this->data['dob']);

            $sql = "INSERT INTO user(name, surname, id_number, date_of_birth) VALUES('$name', '$surname', '$idNo', '$dob')";
            if(mysqli_query($this->conn, $sql))
            {
                echo '<script>alert("User Saved, No duplicate Id created")</script>';
            }
            else
            {
                $this->addError("sql", mysqli_error($this->conn));
            }
        }

        private function addError($key, $value)
        {
            $this->error2[$key] = $value;
        }
    }
?>