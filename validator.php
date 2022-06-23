<?php
    Class Validator
    {
        private $data;
        private $error = [];
        private static $fields = ["name", "surname", "idNo", "dob"];

        function __construct($post_data)
        {
            $this->data = $post_data;
        }

        public function validateForm()
        {
            foreach(self::$fields as $field)
            {
                if(!array_key_exists($field, $this->data))
                {
                    trigger_error("$field is not present");
                    return;
                }
            }

            $this->validateName();
            $this->validateSurname();
            $this->validateIdNum();
            $this->validateDOB();
        }

        private function validateName()
        {
            $val = trim($this->data["name"]);

            if(empty($val))
            {
                $this->addError("name", " does not exist");

            }
            else
            {
                if(!preg_match('/^[a-zA-Z0-9]{6,16}$/', $val))
                {
                    $this->addError("name", " should consist of 6-16 chars and alphanumeric, No symbols allowed.");
                }
            }
        }

        private function validateSurname()
        {
            $val = trim($this->data["surname"]);

            if(empty($val))
            {
                $this->addError("surname", " does not exist");

            }
            else
            {
                if(!preg_match('/^[a-zA-Z0-9]{6,16}$/', $val))
                {
                    $this->addError("surname", " should consist of 6-16 chars and be alphanumeric, No symbols allowed.");
                }
            }
        }

        private function validateIdNum()
        {
            $val = trim($this->data["idNo"]);

            if(empty($val))
            {
                $this->addError("idNo", " does not exist");

            }
            else
            {
                if(!preg_match('/^[0-9]{11}$/', $val))
                {
                    $this->addError("ID Number", " should consist of 11 chars and be numerical, No symbols allowed.");
                }
            }
        }

        private function validateDOB()
        {
            $val = $this->data["dob"];
            $d1 = $val->format('Y-m-d');
            $d2 = explode('-', $d1);
            $d3 = implode("", $d2);
            $date = substr($d3,2, 7);
            
            $val2 = $this->data["idNo"];
            $idNo =  substr($val2, 0, 5);
            if(empty($val))
            {
                $this->addError("idNo", " does not exist");

            }
            else
            {
                if(!date('d-m-Y', $val))
                {
                    $this->addError("DOB", " is not in correct format");
                }
                elseif($date != $idNo)
                {
                    $this->addError("DOB", " does not correspond with ID number");
                }
            }
        }
        
        private function addError($key, $value)
        {
            $this->error[$key] = $value;
        }
    }
?>