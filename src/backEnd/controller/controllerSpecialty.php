<?php
    

    require_once('conection.php');
    class SpecialtyController{
        public function __construct(){}

        // method to insert a new specialty
        public function registerSpecialty($specialty){
            $dataBase=conectionDataBase::conection();
            $insert = $dataBase -> prepare('INSERT INTO specialty VALUES(NULL,:specialtyName,:specialtyAvailability)');
            $insert -> bindValue('specialtyName',$specialty->getSpecialtyName());
            $insert -> bindValue('specialtyAvailability',$specialty->getSpecialtyAvailability());
            $insert -> execute();
        }
        // method to show  specialties
        public function showSpecialties(){
            $dataBase=conectionDataBase::conection();
            $specialtiesList = [];
            $select = $dataBase -> query('SELECT * FROM specialty WHERE specialtyAvailability = 1');
            
            foreach($select -> fetchAll() as $specialty){
                $specialtiesList = new specialty();
                
                $specialtiesList -> setId($specialty['id']);
                $specialtiesList -> setSpecialtyName($specialty['specialtyName']);
                $specialtiesList -> setSpecialtyAvailability($specialty['specialtyAvailability']);
                $specialtiesLists[] = $specialtiesList;
            }
            return $specialtiesLists;
        }
        // method to show all specialties
        public function showAllSpecialties(){
            $dataBase=conectionDataBase::conection();
            $specialtiesList = [];
            $select = $dataBase -> query('SELECT * FROM specialty');
            
            foreach($select -> fetchAll() as $specialty){
                $specialtiesList = new specialty();
                
                $specialtiesList -> setId($specialty['id']);
                $specialtiesList -> setSpecialtyName($specialty['specialtyName']);
                $specialtiesList -> setSpecialtyAvailability($specialty['specialtyAvailability']);
                $specialtiesLists[] = $specialtiesList;
            }
            return $specialtiesLists;
        }
        public function showSpecialtiesWithoutNurses(){
            $dataBase=conectionDataBase::conection();
            $specialtiesList = [];
            $select = $dataBase -> query('SELECT * FROM specialty WHERE id != 3 AND specialtyAvailability = 1');
            
            foreach($select -> fetchAll() as $specialty){
                $specialtiesList = new specialty();
                
                $specialtiesList -> setId($specialty['id']);
                $specialtiesList -> setSpecialtyName($specialty['specialtyName']);
                $specialtiesList -> setSpecialtyAvailability($specialty['specialtyAvailability']);
                $specialtiesLists[] = $specialtiesList;
            }
            return $specialtiesLists;
        }
        //method to verify specialityName
        public function searchSpecialty($specialtyName){
            $dataBase=conectionDataBase::conection();
            $search = $dataBase -> prepare('SELECT * FROM speialty WHERE specialtyName = :specialtyName');
            $search -> bindValue('specialtyName',$specialtyName);
            $search -> execute();
            $specialty = $search -> fetch();
            echo $specialty['specialtyName'];
            if($specialty['specialtyName'] == ""){
                $res = true;
            }else{
                $res = false;
            }
            return $res;
        }
        //method to get a Specialty by id
        public function getSpecialty($id){
            $dataBase=conectionDataBase::conection();
            $specialtiesList = [];
            $select = $dataBase -> query("SELECT * FROM specialty WHERE id = '".$id."'");
            
            foreach($select -> fetchAll() as $specialty){
                $specialtiesList = new specialty();
                
                $specialtiesList -> setId($specialty['id']);
                $specialtiesList -> setSpecialtyName($specialty['specialtyName']);
                $specialtiesList -> setSpecialtyAvailability($specialty['specialtyAvailability']);
                $specialtiesLists[] = $specialtiesList;
            }
            return $specialtiesLists;
        }

    }
?>