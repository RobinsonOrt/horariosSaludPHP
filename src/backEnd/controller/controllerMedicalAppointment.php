<?php
require_once('conection.php');
class MedicalAppointmentController
{
    //method to add a new medical appointment
    public function registerMedicalAppointment($medicalAppointment)
    {
        $dataBase = conectionDataBase::conection();
        $insert = $dataBase->prepare('INSERT INTO medicalappointment VALUES(NULL,:userID,:specialtyID,:appointmentDay,:patientName,:patientCitizenshipID,:sex,:descriptionMedicalAppointment,:appointmentAvailability)');
        $insert->bindValue('userID', $medicalAppointment->getUserID());
        $insert->bindValue('specialtyID', $medicalAppointment->getSpecialtyID());
        $insert->bindValue('appointmentDay', $medicalAppointment->getAppointmentDay());
        $insert->bindValue('patientName', $medicalAppointment->getPatientName());
        $insert->bindValue('patientCitizenshipID', $medicalAppointment->getPatientCitizenshipID());
        $insert->bindValue('sex', $medicalAppointment->getSex());
        $insert->bindValue('descriptionMedicalAppointment', $medicalAppointment->getDescriptionMedicalAppointment());
        $insert->bindValue('appointmentAvailability', $medicalAppointment->getAppointmentAvailability());
        $res = $insert->execute();
        return $res;
    }

    

    //method to show all a medical appointment
    public function getMedicalAppointment()
    {
        $dataBase = conectionDataBase::conection();
        $medicalAppointmentList = [];
        $select = $dataBase->prepare('SELECT * FROM medicalappointment WHERE appointmentAvailability = 1');
        foreach ($select->fetchAll() as $appointment) {
            $medicalAppointmentList = new MedicalAppointment();

            $medicalAppointmentList->setId($appointment['medicalAppointmentID']);
            $medicalAppointmentList->setUserID($appointment['userID']);
            $medicalAppointmentList->setSpecialtyID($appointment['specialtyID']);
            $medicalAppointmentList->setAppointmentDay($appointment['appointmentDay']);
            $medicalAppointmentList->setPatientName($appointment['patientName']);
            $medicalAppointmentList->setPatientCitizenshipID($appointment['patientCitizenshipID']);
            $medicalAppointmentList->setSex($appointment['sex']);
            $medicalAppointmentList->setDescriptionMedicalAppointment($appointment['descriptionMedicalAppointment']);

            $medicalAppointmentLists[] = $medicalAppointmentList;
        }
        return $medicalAppointmentLists;
    }
    //method to see user whith hours
    public function showUserHour($appointmentDay, $specialty)
    {
        $dataBase = conectionDataBase::conection();
        $medicalAppointmentList = [];
        $search = $dataBase->prepare('SELECT * FROM medicalAppointment WHERE  specialtyID = :specialtyID AND appointmentDay = :appointmentDay AND appointmentAvailability = 1');
        $search -> bindValue('specialtyID', $specialty);
        $search -> bindValue('appointmentDay', $appointmentDay);
        $search -> execute();
        if($search->rowCount() > 0){
            foreach ($search->fetchAll() as $medicalAppointment) {
                $medicalAppointmentList = new MedicalAppointment();
                $medicalAppointmentList->setId($medicalAppointment['id']);
                $medicalAppointmentList->setUserID($medicalAppointment['userID']);
                $medicalAppointmentList->setAppointmentDay($medicalAppointment['appointmentDay']);
                $medicalAppointmentLists[] = $medicalAppointmentList;
            }
            return $medicalAppointmentLists;
        }
        
    }
    public function showUserHourByID($id)
    {
        $dataBase = conectionDataBase::conection();
        $medicalAppointmentList = [];
        $search = $dataBase->prepare('SELECT * FROM medicalAppointment WHERE userID = :userID AND appointmentAvailability = 1 ');
        $search -> bindValue('userID', $id);
        $search -> execute();
        if($search->rowCount() > 0){
            foreach ($search->fetchAll() as $medicalAppointment) {
                $medicalAppointmentList = new MedicalAppointment();
                $medicalAppointmentList->setId($medicalAppointment['id']);
                $medicalAppointmentList->setUserID($medicalAppointment['userID']);
                $medicalAppointmentList->setAppointmentDay($medicalAppointment['appointmentDay']);
                $medicalAppointmentList -> setPatientName($medicalAppointment['patientName']);
                $medicalAppointmentLists[] = $medicalAppointmentList;
            }
            return $medicalAppointmentLists;
        }
    }
    //method to update a medical appointment avaliability
    public function updateMedicalAppointment($appointmentDay)
    {
        $dataBase = conectionDataBase::conection();
        $update = $dataBase->prepare('UPDATE medicalAppointment SET appointmentAvailability = :appointmentAvailability WHERE appointmentDay <= :appointmentDay');
        $update->bindValue('appointmentDay', $appointmentDay);
        $update->bindValue('appointmentAvailability', 0);
        $update->execute();
    }
    //method to upfate a medicalAppointment availability by id
    public function updateMedicalAppointmentById($id){
        $dataBase = conectionDataBase::conection();
        $update = $dataBase->prepare('UPDATE medicalAppointment SET appointmentAvailability = :appointmentAvailability WHERE id = :id');
        $update->bindValue('id', $id);
        $update->bindValue('appointmentAvailability', 0);
        $update->execute();
    }
}   
    
?>
