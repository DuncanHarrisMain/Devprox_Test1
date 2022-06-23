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
            return $this->error;
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
                if(!preg_match('/^[a-zA-Z0-9]{3,16}$/', $val))
                {
                    $this->addError("name", " should consist of 3-16 chars and alphanumeric, No symbols allowed.");
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
                if(!preg_match('/^[a-zA-Z0-9]{3,16}$/', $val))
                {
                    $this->addError("surname", " should consist of 3-16 chars and be alphanumeric, No symbols allowed.");
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
            {if(!preg_match('/^[0-9]{13}$/', $val))
            {
                $this->addError("idNo", " should consist of 13 chars and be alphanumeric, No symbols allowed.");
            }
            }
        }

        private function validateDOB()
        {
            $val = $this->data["dob"];
            $d = substr($val, 0, 2);
            $m = substr($val, 3, 2);
            $y = substr($val, 8, 9);
            $date = "$y$m$d";
            
            $val2 = $this->data["idNo"];
            $idNo =  substr($val2, 0, 6);
            if(empty($val))
            {
                $this->addError("dob", " does not exist");

            }
            else
            {
                if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$val))
                {
                    $this->addError("dob", " is not in correct format");
                }
                elseif($date != $idNo)
                {
                    $this->addError("dob", " does not correspond with ID number");
                }
            }
        }
        
        private function addError($key, $value)
        {
            $this->error[$key] = $value;
        }
    }
?>