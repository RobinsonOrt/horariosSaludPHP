<?php 
    require_once('conection.php');
    class UserController{
        public function __construct(){}

        // method to register a user
        public function registerUser($user){
            $dataBase=conectionDataBase::conection();
            $insert = $dataBase -> prepare('INSERT INTO users VALUES(NULL,:userName,:userLastName,:specialtyID,:professionalLicenseNumber,:citizenshipID,:phoneNumber,:userEmail,:userAvailability,:userImage,:shiftsID)');
            $insert -> bindValue('userName',$user->getUserName());
            $insert -> bindValue('userLastName',$user->getUserLastName());
            $insert -> bindValue('specialtyID',$user->getSpecialtyID());
            $insert -> bindValue('professionalLicenseNumber',$user->getProfessionalLicenseNumber());
            $insert -> bindValue('citizenshipID',$user->getCitizenshipID());
            $insert -> bindValue('phoneNumber',$user->getPhoneNumber());
            $insert -> bindValue('userEmail',$user->getUserEmail());
            $insert -> bindValue('userAvailability',$user->getUserAvailability());
            $insert -> bindValue('userImage',$user->getUserImage());
            $insert -> bindValue('shiftsID',$user->getShiftsID());
            $res = $insert -> execute();
            return $res;
        }

        // method to show all users
        public function showUsers(){
            $dataBase=conectionDataBase::conection();
            $userList = [];
            $select = $dataBase -> query('SELECT * FROM users WHERE userAvailability = 1');
            
            foreach($select -> fetchAll() as $user){
                $userList = new user();
                
                $userList -> setId($user['id']);
                $userList -> setUserName($user['userName']);
                $userList -> setUserLastName($user['userLastName']);
                $userList -> setSpecialtyID($user['specialtyID']);
                $userList -> setProfessionalLicenseNumber($user['professionalLicenseNumber']);
                $userList -> setCitizenshipID($user['citizenshipID']);
                $userList -> setPhoneNumber($user['phoneNumber']);
                $userList -> setUserEmail($user['userEmail']);
                $userList -> setUserAvailability($user['userAvailability']);
                $userList -> setUserImage($user['userImage']);
                $userList -> setShiftsID($user['shiftsID']);
                $usersList[] = $userList;
            }
            return $usersList;
        }

        public function showAllUsers(){
            $dataBase=conectionDataBase::conection();
            $userList = [];
            $select = $dataBase -> query('SELECT * FROM users');
            
            foreach($select -> fetchAll() as $user){
                $userList = new user();
                
                $userList -> setId($user['id']);
                $userList -> setUserName($user['userName']);
                $userList -> setUserLastName($user['userLastName']);
                $userList -> setSpecialtyID($user['specialtyID']);
                $userList -> setProfessionalLicenseNumber($user['professionalLicenseNumber']);
                $userList -> setCitizenshipID($user['citizenshipID']);
                $userList -> setPhoneNumber($user['phoneNumber']);
                $userList -> setUserEmail($user['userEmail']);
                $userList -> setUserAvailability($user['userAvailability']);
                $userList -> setUserImage($user['userImage']);
                $userList -> setShiftsID($user['shiftsID']);
                
                $usersList[] = $userList;
            }
            return $usersList;
        }
        // method to change user availability
        public function changeAvailability($id, $availability){
            $dataBase=conectionDataBase::conection();
            $update = $dataBase -> prepare('UPDATE users SET userAvailability = :userAvailability WHERE id = :id');
            $update -> bindValue('id',$id);
            $update -> bindValue('userAvailability', $availability);
            $update -> execute();
        }
        // method to change user shift
        public function changeShift($id, $shiftID){
            $dataBase=conectionDataBase::conection();
            $update = $dataBase -> prepare('UPDATE users SET shiftsID = :shiftID WHERE id = :id');
            $update -> bindValue('id',$id);
            $update -> bindValue('shiftID', $shiftID);
            $update -> execute();
        }


        // method to actualize user
        public function actualizeUser($user){
            $dataBase=conectionDataBase::conection();
            $actualize = $dataBase -> prepare('UPDATE users SET userName = :userName, userLastName = :userLastName, specialtyID = :specialtyID, professionalLicenseNumber = :professionalLicenseNumber, citizenshipID = :citizenshipID, phoneNumber = :phoneNumber, userEmail = :userEmail, userAvailability = :userAvailability, shiftsID = :shiftsID WHERE id = :id');
            $actualize -> bindValue('id',$user->getId());
            $actualize -> bindValue('userName',$user->getUserName());
            $actualize -> bindValue('userLastName',$user->getUserLastName());
            $actualize -> bindValue('specialtyID',$user->getSpecialtyID());
            $actualize -> bindValue('professionalLicenseNumber',$user->getProfessionalLicenseNumber());
            $actualize -> bindValue('citizenshipID',$user->getCitizenshipID());
            $actualize -> bindValue('phoneNumber',$user->getPhoneNumber());
            $actualize -> bindValue('userEmail',$user->getUserEmail());
            $actualize -> bindValue('userAvailability',$user->getUserAvailability());
            $actualize -> bindValue('shiftsID',$user->getShiftsID());
            $actualize -> execute();
        }
        //method to search user by citizenShipID, professionalLicenseNumber, or ID
        public function searchUser($citizenShipID, $professionalLicenseNumber, $id){
            $dataBase=conectionDataBase::conection();
            $userList = [];
            $search = $dataBase -> prepare('SELECT * FROM users WHERE  id = :id OR citizenshipID = :citizenshipID OR professionalLicenseNumber = :professionalLicenseNumber AND userAvailability = 1');
            $search -> bindValue('citizenshipID',$citizenShipID);
            $search -> bindValue('professionalLicenseNumber',$professionalLicenseNumber);
            $search -> bindValue('id',$id);
            $search -> execute();
            foreach($search -> fetchAll() as $user){
                $userList = new user();
                
                $userList -> setId($user['id']);
                $userList -> setUserName($user['userName']);
                $userList -> setUserLastName($user['userLastName']);
                $userList -> setSpecialtyID($user['specialtyID']);
                $userList -> setProfessionalLicenseNumber($user['professionalLicenseNumber']);
                $userList -> setCitizenshipID($user['citizenshipID']);
                $userList -> setPhoneNumber($user['phoneNumber']);
                $userList -> setUserEmail($user['userEmail']);
                $userList -> setUserAvailability($user['userAvailability']);
                $userList -> setUserImage($user['userImage']);
                $userList -> setShiftsID($user['shiftsID']);
                $usersList[] = $userList;
            }
            return $usersList;
            
        }
        //method to see the number of users in a specialization
        public function numberUsers($specialtyID){
            $conn = new mysqli("localhost", "root", "", "horariossalud");
            $sql = "SELECT * FROM users WHERE specialtyID = '".$specialtyID ."' AND userAvailability = '1'";
            $result=mysqli_query($conn,$sql);
            $rowCount = mysqli_num_rows($result);
            return $rowCount;
        }
        //method to see user whith the specialtyID
        public function showUserSpecialty($specialtyID){
            $dataBase=conectionDataBase::conection();
            $userList = [];
            $search = $dataBase -> prepare('SELECT * FROM users WHERE specialtyID = :specialtyID AND userAvailability = :userAvailability');
            $search -> bindValue('specialtyID',$specialtyID);
            $search -> bindValue('userAvailability',1);
            $search -> execute();
            foreach($search -> fetchAll() as $user){
                $userList = new user();
                $userList -> setId($user['id']);
                $userList -> setUserName($user['userName']);
                $userList -> setUserLastName($user['userLastName']);
                $userList -> setSpecialtyID($user['specialtyID']);
                $userList -> setProfessionalLicenseNumber($user['professionalLicenseNumber']);
                $userList -> setCitizenshipID($user['citizenshipID']);
                $userList -> setPhoneNumber($user['phoneNumber']);
                $userList -> setUserEmail($user['userEmail']);
                $userList -> setUserAvailability($user['userAvailability']);
                $userList -> setUserImage($user['userImage']);
                $userList -> setShiftsID($user['shiftsID']);
                $usersList[] = $userList;
            }
            return $usersList;
        }
    }
?>

