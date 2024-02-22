<?php
include_once(PROJECT_ROOT . "data/conexion.php");

class carentry extends conexion {
    private $pk_check;
    private $date_in;
    private $date_out;
    private $fk_parking;
    private $fk_card;
    private $fk_status;
    public function getPkCheck() {
        return $this->pk_check;
    }

    public function setPkCheck($pk_check) {
        $this->pk_check = $pk_check;
    }

    public function getDateIn() {
        return $this->date_in;
    }

    public function setDateIn($date_in) {
        $this->date_in = $date_in;
    }

    public function getDateOut() {
        return $this->date_out;
    }

    public function setDateOut($date_out) {
        $this->date_out = $date_out;
    }

    public function getFkParking() {
        return $this->fk_parking;
    }

    public function setFkParking($fk_parking) {
        $this->fk_parking = $fk_parking;
    }

    public function getFkCard() {
        return $this->fk_card;
    }

    public function setFkCard($fk_card) {
        $this->fk_card = $fk_card;
    }

    public function getFkStatus() {
        return $this->fk_status;
    }

    public function setFkStatus($fk_status) {
        $this->fk_status = $fk_status;
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("Property {$property} does not exist on this object.");
        }
    }

    
    public function registrarEntradaVehiculo($QR_code, $selectedParking) {
        date_default_timezone_set('America/Tijuana');
        $conexion = new conexion();
        $conexion->connect();
        $entryDate = date('Y-m-d H:i:s');
    
        $accessCardQuery = "SELECT pk_card, fk_employee, fk_visit FROM Access_Card WHERE QR_code = '$QR_code' AND fk_status = 1";
        $accessCardResult = $conexion->execquery($accessCardQuery);
    
        if ($accessCardResult && mysqli_num_rows($accessCardResult) > 0) {
            $accessCardRow = mysqli_fetch_assoc($accessCardResult);
            $selectedCard = $accessCardRow['pk_card'];
            $selectedCardEmployee = $accessCardRow['fk_employee'];
            $selectedCardVisit = $accessCardRow['fk_visit'];
            $salidaPendiente = $this->verificarSalidaPendiente($selectedCard);
            if ($salidaPendiente) {
                $errorMessage = "No has registrado tu salida, por lo tanto, no puedes volver a entrar.";
                return $errorMessage;
            }
    
            // Verificar si el empleado tiene un carro registrado
            if($selectedCardEmployee != null) {
            $carCheckQuery = "SELECT pk_car FROM Car_Information WHERE fk_employee = $selectedCardEmployee";
            $carCheckResult = $conexion->execquery($carCheckQuery);
            }
    
            if ($selectedCardEmployee !== null && (!$carCheckResult || mysqli_num_rows($carCheckResult) === 0)) {
                $errorMessage = "El empleado no tiene un carro registrado y no puede hacer check-in.";
                return $errorMessage;
            }
    
            $spaceQuery = "SELECT pk_spaces FROM Parking_Spaces WHERE fk_parking = $selectedParking AND fk_status = 1 LIMIT 1";
            $spaceResult = $conexion->execquery($spaceQuery);
    
            if ($spaceResult && mysqli_num_rows($spaceResult) > 0) {
                $spaceRow = mysqli_fetch_assoc($spaceResult);
                $selectedSpace = $spaceRow['pk_spaces'];
    
                $spaceUpdate = ($selectedCardEmployee !== null) ?
                    "UPDATE Parking_Spaces SET fk_employee = $selectedCardEmployee WHERE pk_spaces = $selectedSpace AND fk_status = 1 LIMIT 1" :
                    "UPDATE Parking_Spaces SET fk_visit = $selectedCardVisit WHERE pk_spaces = $selectedSpace AND fk_status = 1 LIMIT 1";
    
                $spaceResultUpdate = $conexion->execquery($spaceUpdate);
    
                if ($spaceResultUpdate) {
                    $queryInsert = "INSERT INTO Check_In_Out (date_in, fk_parking, fk_card, fk_space, fk_status) VALUES ('$entryDate', $selectedParking, $selectedCard, $selectedSpace, 1)";
                    $resultInsert = $conexion->execinsert($queryInsert);
    
                    if ($resultInsert) {
                        $lastEntryId = $conexion->getConnection()->insert_id;
                        $assignSpaceQuery = "UPDATE Parking_Spaces SET fk_status = 2 WHERE pk_spaces = $selectedSpace";
                        $resultAssignSpace = $conexion->execquery($assignSpaceQuery);
    
                        if ($resultAssignSpace) {
                            $ticket = "<div class='ticket'><h1>¡Gracias por su visita!</h1><br>";
                            $ticket .= "<h2>Número de Boleto: $lastEntryId</h2><br>";
                            $ticket .= "<h2>Fecha: $entryDate</h2>";
                            $ticket .= "</div>";
                            return $ticket;
                        } else {
                            $errorMessage = "Error al asignar el espacio al vehículo.";
                            return $errorMessage;
                        }
                    } else {
                        $errorMessage = "Error al registrar la entrada del vehículo.";
                        return $errorMessage;
                    }
                } else {
                    $errorMessage = "Error al asignar el espacio al vehículo.";
                    return $errorMessage;
                }
            } else {
                $errorMessage = "No hay espacios disponibles en el parking seleccionado.";
                return $errorMessage;
            }
        } else {
            $errorMessage = "La tarjeta de acceso no es válida o no está activa.";
            return $errorMessage;
        }
    }
    

    private function verificarSalidaPendiente($selectedCard) {
        $conexion = new conexion();
        $conexion->connect();
        
        $query = "SELECT date_out FROM Check_In_Out WHERE fk_card = $selectedCard AND date_out IS NULL";
        $result = $conexion->execquery($query);
        
        return ($result && mysqli_num_rows($result) > 0);
    }
    
    public function registrarSalidaVehiculo($entryId) {
        date_default_timezone_set('America/Tijuana');
    
        $conexion = new conexion();
        $conexion->connect();
    
        $checkQuery = "SELECT date_out, fk_parking, fk_space FROM Check_In_Out WHERE pk_check = $entryId";
        $checkResult = mysqli_query($conexion->getConnection(), $checkQuery);
    
        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            $row = mysqli_fetch_assoc($checkResult);
            $existingExitDate = $row['date_out'];
            $parkingId = $row['fk_parking'];
            $spaceId = $row['fk_space'];
    
            if ($existingExitDate !== null) {
                //$ticket = "<div class='ticket'>";
                $ticket = "<h1 style='margin-left: 20px; font-size: 20px;'>Esta entrada ya tiene fecha de salida: $existingExitDate</h1>";
                //$ticket .= "<a href='javascript:history.go(-1)' class='back-button'>Volver atrás</a>";
                //$ticket .= "</div>";
                return $ticket;
            }
    
            $exitDate = new DateTime('now', new DateTimeZone('America/Tijuana'));
            $formattedExitDate = $exitDate->format('Y-m-d H:i:s');
            $query = "UPDATE Check_In_Out SET date_out = '$formattedExitDate' WHERE pk_check = $entryId";
    
            $result = mysqli_query($conexion->getConnection(), $query);
    
            if ($result) {
                $releaseSpaceQuery = "UPDATE Parking_Spaces SET fk_status = 1, fk_employee = NULL, fk_visit = NULL WHERE pk_spaces = $spaceId";
                $resultReleaseSpace = mysqli_query($conexion->getConnection(), $releaseSpaceQuery);
    
                if ($resultReleaseSpace) {
                    $ticket = "<div class='ticket' style='font-size: 24px; margin: 0px 35px;'><h1>¡Gracias por su visita!</h1><br>";
                    $ticket .= "<h1>Número de Boleto: $entryId</h1><br>";
                    $ticket .= "<h1>Fecha de salida: $formattedExitDate</h1>";
                    //$ticket .= "<a href='javascript:history.go(-1)' class='back-button'>Volver atrás</a>";
                    $ticket .= "</div>";
                    return $ticket;
                } else {
                    //$ticket = "<div class='ticket'>";
                    $ticket = "<h1 style='margin-left: 20px;'>Error al liberar el espacio del estacionamiento: " . mysqli_error($conexion->getConnection()) . "</h1>";
                    //$ticket .= "<a href='javascript:history.go(-1)' class='back-button'>Volver atrás</a>";
                    //$ticket .= "</div>";
                    return $ticket;
                }
            } else {
                //$ticket = "<div class='ticket'>";
                $ticket = "<h1 style='margin-left: 20px;'>Error al registrar la salida del vehículo: " . mysqli_error($conexion->getConnection()) . "</h1>";
                //$ticket .= "<a href='javascript:history.go(-1)' class='back-button'>Volver atrás</a>";
                //$ticket .= "</div>";
                return $ticket;
            }
        } else {
            //$ticket = "<div class='ticket'>";
            $ticket = "<h1 style='margin-left: 20px;'>La entrada no existe.</h1>";
            //$ticket .= "<a href='javascript:history.go(-1)' class='back-button'>Volver atrás</a>";
            //$ticket .= "</div>";
            return $ticket;
        }
    }
    
    
    
}


?>
