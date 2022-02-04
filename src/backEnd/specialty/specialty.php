<?php
    class Specialty{
        private $id;
        private $specialtyName;
        private $specialtyAvailability;


        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getSpecialtyName()
        {
                return $this->specialtyName;
        }

        public function setSpecialtyName($specialtyName)
        {
                $this->specialtyName = $specialtyName;
        }

        public function getSpecialtyAvailability()
        {
                return $this->specialtyAvailability;
        }

        public function setSpecialtyAvailability($specialtyAvailability)
        {
                $this->specialtyAvailability = $specialtyAvailability;
        }
    }
?>