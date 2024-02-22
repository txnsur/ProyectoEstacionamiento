<?php //user.php 
    //Incluimos la conexion.
    include_once(PROJECT_ROOT.'/data/conexion.php');

    //creamos la clase para nuestra tabla
    class Visit extends conexion{
        
        private $id;
        private $company;
        private $reason;
        private $name;
        private $last_name;
        private $fk_client;

        public function setCompany($company) {
            $this->company = $company;
        }
    
        public function setReason($reason) {
            $this->reason = $reason;
        }
    
        public function setName($name) {
            $this->name = $name;
        }
    
        public function setLastName($last_name) {
            $this->last_name = $last_name;
        }
    
        public function setFkClient($fk_client) {
            $this->fk_client = $fk_client;
        }

        //METODOS: GET && SETTERS
        //Nueva funcion, vamos a ver como funciona.
        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            } else {
                throw new Exception("Property {$property} does not exist on this object.");
            }
        }
  
        //METODOS 

        //GET
        public function getVisit() {
            $query = "SELECT * FROM Visit WHERE fk_client = '".$this->fk_client."'";
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

        //INSERT
        public function setVisit() {
            $query = "INSERT INTO Visit (visit_company, visit_reason, visit_name, visit_lastName, fk_client) VALUES ('".$this->company."', '".$this->reason."', '".$this->name."', '".$this->last_name."', ".$this->fk_client.")";
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


        // Actualizar información de visita
        public function updateVisit() {
            $query = 'UPDATE Visit SET  visit_company = "'.$this->company.'", visit_reason = "'.$this->reason.'", visit_name = "'.$this->name.'", visit_lastName = "'.$this->last_name.'" WHERE pk_visit = '.$this->id.'';
            $result = $this->connect();
            if($result) {
                echo "Actualización de visita exitosa"; 
                $newID = $this->execquery($query);
            } else {
                echo "Algo salió mal";
                $newID = "error";
            }
            return $newID;
        }

        // Eliminar visita
        public function deleteVisit() {
            $query_update_visit = 'UPDATE Visit SET fk_status = 2 WHERE pk_visit = ' . $this->id . '';
            $query_update_access_card = 'UPDATE Access_Card SET fk_status = 2 WHERE fk_visit = ' . $this->id . '';
            
            $result_visit = $this->connect();
            $result_access_card = $this->connect();
        
            if ($result_visit && $result_access_card) {
                $updated_visit = $this->execquery($query_update_visit);
                $updated_access_card = $this->execquery($query_update_access_card);
        
                if ($updated_visit && $updated_access_card) {
                    echo "Eliminación de visita y actualización de tarjetas de acceso exitosas";
                    return $updated_visit; // o podría devolver un mensaje de éxito
                } else {
                    echo "Hubo un problema al actualizar la visita o las tarjetas de acceso";
                    return "error";
                }
            } else {
                echo "Algo salió mal al conectar con la base de datos";
                return "error";
            }
        }
        
        

        public function getVisitById($visit_id) {
            $result = $this->connect();
        
            if ($result) {
                $visit_id = mysqli_real_escape_string($this->getConnection(), $visit_id); // Escapa el valor para evitar SQL injection
                $query = "SELECT * FROM Visit WHERE pk_visit = $visit_id";
                $visit_data = mysqli_query($this->getConnection(), $query);
        
                if ($visit_data) {
                    return mysqli_fetch_assoc($visit_data); // Devuelve un array asociativo con los datos de la visita
                }
            }
            return null; // Devuelve null si no se encuentra la visita
        }

    } //Fin de la clase
?>