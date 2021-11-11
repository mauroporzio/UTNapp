<?php
    namespace Controllers;

    use Controllers\StudentController as StudentController;

    class LoginController{

        public function Login($user_email, $user_password){

           $CareerController = new CareerController;
           $JobPositionController = new JobPositionController;
           $StudentController = new StudentController;
           
           $CareerController->CheckApi();
           $JobPositionController->CheckApi();
           $StudentController->CheckApi();
        
           $studentList = $StudentController->GetAll();

           $found = false;

           foreach($studentList as $student){

                if($user_email == $student->getEmail()){

                    $found = true;
                        
                    if($user_password == $student->getPassword()){
                        
                        $careerController = new CareerController;
                        $_SESSION["loggedUser"] = $student;
                        $_SESSION["loggedUserCareer"] = $careerController->GetById($_SESSION["loggedUser"]->getCareerId());
                        ///Por ahora te manda a home.php. Deberia agregar en esta pagina todas las funciones de navAdmin
                        require_once(VIEWS_PATH."validate-session.php");
                        require(VIEWS_PATH . "home.php");

                    }else{
                        echo "<script>alert('Contraseña invalida.')</script>";
                        require_once(VIEWS_PATH . "index.php");
                    }
                
              }
            }
            if($found == false){
                echo "<script>alert('E-Mail invalido')</script>";
                require_once(VIEWS_PATH . "index.php");
        }
      }
    }
?>
