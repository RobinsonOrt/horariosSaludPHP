<?php
    class User{
        private $id;
        private $userName;
        private $userLastName;
        private $specialtyID;
        private $professionalLicenseNumber;
        private $citizenshipID;
        private $phoneNumber;
        private $userEmail;
        private $userAvailability;
        private $userImage;
        private $shiftsID;
        
        function __construct(){}
        
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getUserName()
        {
                return $this->userName;
        }

        public function setUserName($userName)
        {
                $this->userName = $userName;
        }

        public function getUserLastName()
        {
                return $this->userLastName;
        }

        public function setUserLastName($userLastName)
        {
                $this->userLastName = $userLastName;
        }

        public function getSpecialtyID()
        {
                return $this->specialtyID;
        }

        public function setSpecialtyID($specialtyID)
        {
                $this->specialtyID = $specialtyID;
        }

        public function getProfessionalLicenseNumber()
        {
                return $this->professionalLicenseNumber;
        }
        

        public function setProfessionalLicenseNumber($professionalLicenseNumber)
        {
                $this->professionalLicenseNumber = $professionalLicenseNumber;
        }

        public function getCitizenshipID()
        {
                return $this->citizenshipID;
        }

        public function setCitizenshipID($citizenshipID)
        {
                $this->citizenshipID = $citizenshipID;
        }

        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;
        }

        public function getUserEmail()
        {
                return $this->userEmail;
        }

        public function setUserEmail($userEmail)
        {
                $this->userEmail = $userEmail;
        }
        public function getUserAvailability()
        {
                return $this->userAvailability;
        }
        public function setUserAvailability($userAvailability)
        {
                $this->userAvailability = $userAvailability;
        }
        public function getUserImage()
        {
                return $this->userImage;
        }
        public function setUserImage($userImage)
        {
                $this->userImage = $userImage;
        }

        public function getShiftsID()
        {
                return $this->shiftsID;
        }

        public function setShiftsID($shiftsID)
        {
                $this->shiftsID = $shiftsID;
        }
   }
?>