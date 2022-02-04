<?php
require_once('conection.php');
class ShiftsController{
    public function __construct(){}

    //method to add a new shift
    public function registerShifts($shifts){
        $dataBase = conectionDataBase::conection();
        $insert = $dataBase -> prepare("INSERT INTO workshifts VALUES(NULL,:shiftsName,:schedule)");
        $insert -> bindValue('shiftsName',$shifts->getShiftsName());
        $insert -> bindValue('schedule',$shifts->getSchedule());
        $insert -> execute();
    }
    //method to show all shifts
    public function showAllShifts(){
        $dataBase=conectionDataBase::conection();
            $shiftsList = [];
            $select = $dataBase -> query('SELECT * FROM workshifts');
            
            foreach($select -> fetchAll() as $shift){
                $shiftsList = new Shifts();
                $shiftsList -> setId($shift['id']);
                $shiftsList -> setShiftsName($shift['shiftsName']);
                $shiftsList -> setSchedule($shift['schedule']);
                $shiftsLists[] = $shiftsList;
            }
            return $shiftsLists;
    }
    //method to show a shift by id
    public function showShiftById($id){
        $dataBase=conectionDataBase::conection();
        $shifts = [];
        $select = $dataBase -> prepare('SELECT * FROM workshifts WHERE id = :id');
        $select -> bindValue('id',$id);
        $select -> execute();
        $shifts = $select->fetchAll();

        return $shifts;
        
    }
    //method to update a shift
    public function updateShifts($shifts){
        $dataBase=conectionDataBase::conection();
        $update = $dataBase -> prepare("UPDATE workshifts SET schedule = :schedule WHERE id = :id");
        $update -> bindValue('schedule',$shifts->getSchedule());
        $update -> bindValue('id',$shifts->getId());
        $update -> execute();
    }

    //method to get the last shift
    public function getLastShift(){
        $dataBase=conectionDataBase::conection();
        $shifts = [];
        $select = $dataBase -> prepare('SELECT MAX(id) FROM workshifts');
        $select -> execute();
        $shifts = $select->fetchAll();
        return $shifts;
    }
}