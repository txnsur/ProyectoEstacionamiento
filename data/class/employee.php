<?php //user.php 
    //Incluimos la conexion.
    include_once(__DIR__.'/../conexion.php');

    //creamos la clase para nuestra tabla
    class Employee extends conexion{
        
        private $id;
        private $name;
        private $lastNameP;
        private $lastNameM;
        private $fk_client;
        private $fk_rol;

        //METODOS: GET && SETTERS
        public function setID($id) {
            $this->id = $id;
        }
        public function setName($name) {
            $this->name = $name;
        }
        public function setLastNameP($lastNameP) {
            $this->lastNameP = $lastNameP;
        }
        public function setLastNameM($lastNameM) {
            $this->lastNameM = $lastNameM;
        }
        public function setFKclient($fk_client) {
            $this->fk_client = $fk_client;
        }
        public function setRol($fk_rol) {
            $this->fk_rol= $fk_rol;
        }
        //METODOS 

        //GET
        public function getEmployee() {
            $query = "SELECT Employee.*, Rol.rol_name FROM Employee 
              INNER JOIN Rol ON Employee.fk_rol = Rol.pk_rol 
              WHERE Employee.fk_status = 1 AND Employee.fk_client = '".$this->fk_client."'";
            $result = $this->connect();
            if ($result == true){
                //echo "vammos bien";
                $dataset = $this->execquery($query);
            }
            else{
                echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
        }

        //Metdoo para obtener el id del empleado.
        public function getEmployeeById2($employee_id) {
            $result = $this->connect();
        
            if ($result) {
                $employee_id = mysqli_real_escape_string($this->getConnection(), $employee_id); // Escapa el valor para evitar SQL injection
                $query = "SELECT * FROM Employee WHERE pk_employee = $employee_id";
                $employee_data = mysqli_query($this->getConnection(), $query);
        
                if ($employee_data) {
                    return $employee_data; // Devuelve un array asociativo con los datos del cliente
                }
            }
            return null; // Devuelve null si no se encuentra el cliente
        }
        public function getEmployeeById($employee_id) {
            $result = $this->connect();
        
            if ($result) {
                $employee_id = mysqli_real_escape_string($this->getConnection(), $employee_id); // Escapa el valor para evitar SQL injection
                $query = "SELECT * FROM Employee WHERE pk_employee = $employee_id";
                $employee_data = mysqli_query($this->getConnection(), $query);
        
                if ($employee_data) {
                    return mysqli_fetch_assoc($employee_data); // Devuelve un array asociativo con los datos del cliente
                }
            }
            return null; // Devuelve null si no se encuentra el cliente
        }

        public function getRol() {
            $result = $this->connect();
            if ($result == true){
                //echo "vammos bien";
                $dataset = $this->execquery("SELECT * FROM Rol (rol_name) WHERE pk_rol = '".$this->fk_rol."'");
            }
            else{
                echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
        }

        //INSERT
        public function setEmployee() {
            $query = "INSERT INTO Employee (employee_name, employee_lastNameP, employee_lastNameM, fk_client, fk_status, fk_rol) VALUES ('".$this->name."', '".$this->lastNameP."', '".$this->lastNameM."', '".$this->fk_client."', 1, '".$this->fk_rol."')";
            $result = $this->connect();
            if($result) {
                $newID = $this->execquery($query);
                echo "Ha funcionado el registro de empleado"; 
            } else {
                echo "algo salio mal";
                $newID = "error";
            }
            return $newID;
        }

         //UPDATE
        
        //Metodo para actualizar el cliente.
        public function updateEmployee() {
            $query = 'UPDATE Employee SET  employee_name = "'.$this->name.'", employee_lastNameP = "'.$this->lastNameP.'", employee_lastNameM = "'.$this->lastNameM.'", fk_rol = "'.$this->fk_rol.'" WHERE pk_employee = '.$this->id.'';
            $result = $this->connect();
            if($result) {
                echo "Ha funcionado la actualizacion de usuario"; 
                $newID = $this->execquery($query);
            } else {
                echo "algo salio mal";
                $newID = "error";
            }
            return $newID;
        }

         //Metodo para eliminar el cliente.
         public function deleteEmployee() {
            $query = 'UPDATE Employee SET fk_status = 2 WHERE pk_employee = ' . $this->id . '';
            $result = $this->connect();
            if($result) {
                echo "Ha funcionado la eliminacion de usuario"; 
                $newID = $this->execquery($query);
        
                // Cambiar el estado de la tarjeta de acceso asociada al empleado eliminado
                $query_access_card = 'UPDATE Access_Card SET fk_status = 2 WHERE fk_employee = ' . $this->id . '';
                $result_access_card = $this->execquery($query_access_card);
                if ($result_access_card) {
                    echo "Estado de la tarjeta de acceso actualizado correctamente";
                } else {
                    echo "Hubo un problema al actualizar el estado de la tarjeta de acceso";
                }
            } else {
                echo "algo salio mal";
                $newID = "error";
            }
            return $newID;
        }

        public function getEmployeeList($client_id) {
            $query = "SELECT * FROM Employee WHERE fk_client = $client_id";
            $result = $this->connect();
            if ($result) {
                return $this->execquery($query);
            } else {
                return null;
            }
        }
        

    } //Fin de la clase
?>