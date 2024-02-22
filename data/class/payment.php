<?php //client.php 
    //Incluimos la conexion.
    include_once(PROJECT_ROOT . "data/conexion.php");

    //Creamos la clase para nuestra tabla
    class Payment extends conexion{
        private $id;
        private $amount;
        private $description;
        private $date;
        private $fk_duration;
        private $fk_method;
        private $fk_paymentStatus;
        private $fk_client;

        //METODOS: GET && SETTERS
        public function setID($id) {
            $this->id = $id;
        }
        public function setAmount($amount) {
            $this->amount= $amount;
        }
        public function setDescription($description) {
            $this->description = $description;
        }
        public function setDate($date) {
            $this->date = $date;
        }
        public function setDuration($fk_duration) {
            $this->fk_duration= $fk_duration;
        }
        public function setMethod($fk_method) {
            $this->fk_method= $fk_method;
        }
        public function setPaymentStatus($fk_paymentStatus) {
            $this->fk_paymentStatus= $fk_paymentStatus;
        }
        public function setClient($fk_client) {
            $this->fk_client= $fk_client;
        }
 

        //METODOS

        //SELECT 
        public function getAllPayments(){
            $result = $this->connect();
            if ($result == true){
                //echo "vammos bien";
                $dataset = $this->execquery("SELECT * FROM Payment");
            }
            else{
                echo "algo fallo";
                $dataset = "error";
            }
            return $dataset;
        } 
        
        //INSERT
        public function setPayment() {
            $query = "INSERT INTO Payment (payment_amount, payment_description, payment_date, fk_duration, fk_method, fk_paymentStatus, fk_client) 
            VALUES (".$this->amount.", '".$this->description."', NOW(),'".$this->fk_duration."', 1, 1, '".$this->fk_client."')";
            $result = $this->connect();
            if($result) {
                $newID = $this->execinsert($query);
                echo "Ha funcionado el registro del pago"; 
            } else {
                echo "algo salio mal";
                $newID = "error";
            }
            return $newID;
        }

    } //Fin de la clase
?>