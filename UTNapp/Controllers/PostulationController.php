<?php
     namespace Controllers;

     use Models\Postulation as Postulation;
     use DAO\PostulationDAO as PostulationDAO;
     use DAO\JobOfferDAO as JobOfferDAO;
     use DAO\CareerDAO as CareerDAO;
     use DAO\CompanyDAO as CompanyDAO;
     use DAO\JobPositionDAO as JobPositionDAO;
     use DAO\StudentDAO as StudentDAO;
     use DAO\ImageDAO as ImageDAO;

class PostulationController{
 
         private $PostulationDAO;
         private $JobOfferDAO;
         private $CareerDAO;
         private $JobPositionDAO;
         private $CompanyDAO;
         private $StudentDAO;
         private $ImageDAO;
 
         public function __construct(){
 
             $this->PostulationDAO = new PostulationDAO;
             $this-> JobOfferDAO = new JobOfferDAO;
             $this->CareerDAO = new CareerDAO;
             $this->JobPositionDAO = new JobPositionDAO;
             $this->CompanyDAO = new CompanyDAO;
             $this->StudentDAO = new StudentDAO;
             $this->ImageDAO = new ImageDAO;
         }

         public function ShowPostulateView()
         {
             $JobOffersList =  $this->JobOfferDAO->GetAll();
             $CareersList =  $this->CareerDAO->GetALL();
             $JobPositionsList =  $this->JobPositionDAO->GetAll();
             $CompanyList =  $this->CompanyDAO->GetAll();
 
             require_once(VIEWS_PATH . "postulateView.php");
         }

         public function ShowAddView(){ // NO ESTA IMPLEMENTADO PORQUE NO ES PARTE DE LOS REQUERIMIENTOS.

            require_once(VIEWS_PATH . "");
         }

         public function ShowModifView($studentId,  $JobOfferId, $postulationDate){ // NO ESTA IMPLEMENTADO PORQUE NO ES PARTE DE LOS REQUERIMIENTOS.
            $ModifPostulation = new Postulation();
            $ModifPostulation->setStudentId($studentId);
            $ModifPostulation->setJobOfferId($JobOfferId);
            $ModifPostulation->setPostulationDate($postulationDate);

            require_once(VIEWS_PATH . "");
        }

        public function ShowUploadView(){
            
            require_once(VIEWS_PATH."addImage.php");
        }

        public function Add($studentId,  $JobOfferId, $postulationDate)
        {
            $result =  $this->PostulationDAO->GetByStudent(intval($studentId));
            $student = $this->StudentDAO->GetById($studentId);
            $JobOffer = $this->JobOfferDAO->GetById($JobOfferId);

            foreach($this->JobPositionDAO->GetAll() as $JobPosition)
            {
                if ($JobPosition->getJobPositionId() == $JobOffer->getJobPositionId())
                {
                    $careerId = $JobPosition->getCareerId();
                }
            }

            if ($result == null)
            {
                if ($careerId == $student->GetCareerID())
                {
                    $newPostulation = new Postulation;
            
                    $newPostulation->setStudentId($studentId);
                    $newPostulation->setJobOfferId($JobOfferId);
                    $newPostulation->setPostulationDate($postulationDate);
                
                    $this->PostulationDAO->Add($newPostulation);

                    $this->ShowUploadView();
                }
                else
                {
                    echo "<script>alert('Usted no pertenece a la carrera requerida para postularse en la Oferta Laboral.')</script>";
                    $this->ShowPostulateView();
                }
            }
            else
            {
                echo "<script>alert('Usted ya esta postulado en una Oferta Laboral')</script>";
                $this->ShowPostulateView();
            }
            
            
        }

        public function showPostulationHistoryView()
        {
             $JobOffersList =  $this->JobOfferDAO->GetAll();
             $CareersList =  $this->CareerDAO->GetALL();
             $JobPositionsList =  $this->JobPositionDAO->GetAll();
             $CompanyList =  $this->CompanyDAO->GetAll();

             if ($_SESSION["loggedUser"]->getAdmin() == 0)
             {
                $PostulationHistory = $this->PostulationDAO->GetAllHistoryByStudent($_SESSION["loggedUser"]);

                $PostulacionVigente = $this->PostulationDAO->GetByStudent($_SESSION["loggedUser"]->getStudentId());

                require_once(VIEWS_PATH . "postulationHistoryList.php");
             }
             else
             {

                $PostulationHistory = $this->PostulationDAO->GetAllHistory();

                require_once(VIEWS_PATH . "postulationHistoryListAdmin.php");
             }

        }

        public function Remove($StudentId)
        {
            $RemovePostulation = new Postulation();
            $RemovePostulation->setStudentId($StudentId);
            $this->PostulationDAO->Remove($RemovePostulation);

            $this->showPostulationHistoryView();
        }

         public function GetAll(){
 
             return $this->PostulationDAO->GetAll();
         }

         public function GetByStudent($StudentId){
 
            return $this->PostulationDAO->GetByStudent($StudentId);
        }

        public function GetByJobOffer($JobOfferId){
 
            return $this->PostulationDAO->GetByJobOffer($JobOfferId);
        }
     }


?>