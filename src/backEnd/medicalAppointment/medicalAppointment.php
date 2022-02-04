<?php 
    class MedicalAppointment{
        private $id;
        private $userID;
        private $specialtyID;
        private $appointmentDay;
        private $patientName;
        private $patientCitizenshipID;
        private $sex;
        private $descriptionMedicalAppointment;
        private $appointmentAvailability;

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getUserID()
        {
                return $this->userID;
        }

        public function setUserID($userID)
        {
                $this->userID = $userID;
        }

        public function getSpecialtyID()
        {
                return $this->specialtyID;
        }

        public function setSpecialtyID($specialtyID)
        {
                $this->specialtyID = $specialtyID;
        }

        public function getAppointmentDay()
        {
                return $this->appointmentDay;
        }

        public function setAppointmentDay($appointmentDay)
        {
                $this->appointmentDay = $appointmentDay;
        }

        public function getPatientName()
        {
                return $this->patientName;
        }

        public function setPatientName($patientName)
        {
                $this->patientName = $patientName;
        }

        public function getPatientCitizenshipID()
        {
                return $this->patientCitizenshipID;
        }

        public function setPatientCitizenshipID($patientCitizenshipID)
        {
                $this->patientCitizenshipID = $patientCitizenshipID;
        }

        public function getSex()
        {
                return $this->sex;
        }

        public function setSex($sex)
        {
                $this->sex = $sex;
        }

        public function getDescriptionMedicalAppointment()
        {
                return $this->descriptionMedicalAppointment;
        }

        public function setDescriptionMedicalAppointment($descriptionMedicalAppointment)
        {
                $this->descriptionMedicalAppointment = $descriptionMedicalAppointment;
        }

        public function getAppointmentAvailability()
        {
                return $this->appointmentAvailability;
        }

        public function setAppointmentAvailability($appointmentAvailability)
        {
                $this->appointmentAvailability = $appointmentAvailability;
        }
    }
?>