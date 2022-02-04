<?php
    class Shifts{
        private $id;
        private $shiftsName;
        private $schedule;
        function __construct(){}

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getShiftsName()
        {
                return $this->shiftsName;
        }

        public function setShiftsName($shiftsName)
        {
                $this->shiftsName = $shiftsName;
        }

        public function getSchedule()
        {
                return $this->shedule;
        }

        public function setSchedule($shedule)
        {
                $this->shedule = $shedule;
        }

        
    }
