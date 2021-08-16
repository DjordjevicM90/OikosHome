<?php

    class DB{

        private $_pdo;
        private $_query;
        private $_error = false;
        private $_results;
              
        public function __construct()
        {
            try {
                $this->_pdo = new PDO("mysql:host=localhost;dbname=housesfurniture", "root", "");
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        } 

        public function query($sql, $params = array())
        {
            $this->error = false;
            $this->_query = $this->_pdo->prepare($sql);
            if($this->_query) {
                $x=1;
                if(count($params)) {
                    foreach($params as $param){
                        $this->_query->bindValue($x, $param);
                        $x++;
                    }
                }
                
                if($this->_query->execute()){  
                                   
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                } else{
                    $this->_error = true;
                }
            }
            return $this;
        }

        public function select($table, $value, $columnFirst, $columnSecond){

            if($value!=null AND $columnSecond != null)
            {
                $sql = "SELECT * FROM $table WHERE $columnFirst = $value AND $columnSecond = 0";
            }
            else if($value!=null AND $columnSecond == null)
            {
                $sql = "SELECT * FROM $table WHERE $columnFirst = $value";
            }
            else
            {
                $sql = "SELECT * FROM $table";   
            }
            
            if(!$this->query($sql)->getError())
            {
                return $this->_results;       
            }  
            return false;
        }

        public function selectRow($table, $email, $columnFirst, $columnSecond){

            $sql = "SELECT * FROM $table WHERE $columnFirst = '$email' AND $columnSecond = 0";

            if(!$this->query($sql)->getError())
            {
                return $this->_results;       
            }  
            else
            return false;
        }

        public function selectSpec($table, $columnFirst, $columnFirstVal, $columnSecond, $columnSecondVal, $columnDelete){

            $sql = "SELECT * FROM $table WHERE $columnFirst = $columnFirstVal AND $columnSecond = $columnSecondVal AND $columnDelete = 0"; 
                  
            if(!$this->query($sql)->getError())
            {
                return $this->_results;       
            }  
            return false;
        }

        public function insert($table, $fields = array()){
            if (count($fields)){
                $keys = array_keys($fields);
                $values = null;

                $x = 1;
                foreach($fields as $field){
                    $values .= "?";
                    if($x < count($fields)){
                        $values .= ', ';
                    }
                    $x++;
                }
                
                $sql = "INSERT INTO ".$table." (`".implode('`, `', $keys)."`) VALUES ({$values})";

                if(!$this->query($sql, $fields)->getError()){
                    return true;
                }
                return false;
            }
        }

        public function updateQuantityAccep($table, $set1, $set2, $productId, $userId, $columnFirst, $columnSecond)
        {
            if($set1!=null AND $set2!=null)
            {
                $sql = "UPDATE {$table} SET $set1=$set2 WHERE $columnFirst = $productId AND $columnSecond = $userId";
            }
            else
            {
                $sql = "UPDATE {$table} SET basket_quantity=basket_quantity+1 WHERE $columnFirst = $productId AND $columnSecond = $userId";   
            }
            
            if(!$this->query($sql)->getError()){
                return true;
            }
            return false;
        }

        public function updateUser($table, $id, $columId, $fields)
        {
            $set = "";

            $x=1;
            foreach($fields as $name =>$value){
                $set .= "{$name} = ?";
                if($x<count($fields)){
                    $set .= ", ";
                }
                $x++;
            }
            $sql = "UPDATE {$table} SET {$set} WHERE $columId = {$id}";

            if(!$this->query($sql, $fields)->getError()){
                return true;
            }
            return false;
        }

        public function delete($table, $productId, $userId, $columnFirst, $columnSecond, $columnThird)
        {
            if($userId!=null)
            {
                $sql = "DELETE FROM $table WHERE $columnFirst = $productId AND $userId = $columnSecond AND $columnThird=0 ";
            }
            else 
                $sql = "DELETE FROM $table WHERE $columnFirst = $productId";

            if(!$this->query($sql)->getError()){
                return true;
            }
            return false;
        }

        public function search($table, $value, $columnFirst, $columnSecond)
        {
            $sql = "SELECT * FROM $table WHERE $columnFirst = 0 AND ($columnSecond LIKE ('%".$value."%'))";

            if(!$this->query($sql)->getError())
            {
                return $this->_results;       
            }  
            return false;;
        }

        public function insertId(){
            return $this->_pdo->lastInsertId();
        }

        public function getError()
        {
            return $this->_error;
        }

        public function getCount(){
            return $this->_count;
        }
    
    }

?>