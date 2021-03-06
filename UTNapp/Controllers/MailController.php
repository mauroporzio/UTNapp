<?php
     namespace Controllers;

     use Models\Mail as Mail;
     use Models\User as User;
     use DAO\MailDAO as MailDAO;
     use DAO\PostulationDAO as PostulationDAO;
     use DAO\StudentDAO as StudentDAO;
     use DAO\UserDAO as UserDAO;

class MailController
{
    private $MailDAO;

    public function __construct()
    {
        $this->MailDAO = new MailDAO;
        $this->PostulationDAO = new PostulationDAO;
        $this->StudentDAO = new StudentDAO;
        $this->UserDAO = new UserDAO;
    }

    private function GetAllByUser(User $user)
    {
        return $this->MailDAO->GetAllByUser($user);
    }

    public function Delete($MailId)
    {
        $this->MailDAO->Delete($MailId);
        $this->ShowMailListView();
    }

    public function SendWelcomeMail($JobOffer)
    {
        $newMail = new Mail;

        $header = "Confirmacion: " . $JobOffer->getJobPosition()->getDescription() . " - " . $JobOffer->getCompany()->getName();

        $message = "Gracias por postularte a nuestra oferta laboral: " . $JobOffer->getJobPosition()->getDescription() . ". 
        Pronto nos pondremos en contacto para darte mas informacion acerca de tu postulacion.
        Muchas gracias!
        ". $JobOffer->getCompany()->getName();

        $newMail->setUser($_SESSION["loggedUser"]);
        $newMail->setCompany($JobOffer->getCompany());
        $newMail->setMessage($message);
        $newMail->setHeader($header);

        $this->Add($newMail);
    }

    public function SendEndMail($JobOffer)
    {
        $postulationsList = $this->PostulationDAO->GetAllHistoryByJobOffer($JobOffer);
        $studentList = $this->StudentDAO->GetAll();

        $header = "Fin oferta: " . $JobOffer->getJobPosition()->getDescription() . " - " . $JobOffer->getCompany()->getName();
            
        $message = "La oferta laboral: " . $JobOffer->getJobPosition()->getDescription() . ". 
        a la cual, estabas posutalodo/a, ya no esta disponible.
        Muchas gracias!
        ". $JobOffer->getCompany()->getName();

        foreach ($studentList as $student)
        {
            foreach($postulationsList as $postulation)
            {
                if ($postulation->getStudent()->getStudentId() == $student->GetStudentId())
                {
                    $newMail = new Mail;
                    $newMail->setUser($this->UserDAO->GetByEmail($student->getEmail()));
                    $newMail->setCompany($JobOffer->getCompany());
                    $newMail->setMessage($message);
                    $newMail->setHeader($header);
            
                    $this->Add($newMail);
                }
            }
        }   
    }

    public function SendRejectedPostulationMail($postulation)
    {

        $header = "Postulacion Rechazada: " . $postulation->getJobOffer()->getJobPosition()->getDescription() . " - " . $postulation->getJobOffer()->getCompany()->getName();
            
        $message = "Lamentamos informarle que su postulacion la oferta laboral: " . $postulation->getJobOffer()->getJobPosition()->getDescription() . ". 
        fue rechazada.
        Muchas gracias por su interes en nuestra oferta.
        Saludos.
        ". $postulation->getJobOffer()->getCompany()->getName();

        $newMail = new Mail;
        $newMail->setUser($this->UserDAO->GetByEmail($postulation->getStudent()->getEmail()));
        $newMail->setCompany($postulation->getJobOffer()->getCompany());
        $newMail->setMessage($message);
        $newMail->setHeader($header);

        $this->Add($newMail);  
    }

    private function Add(Mail $mail)
    {
        $this->MailDAO->Add($mail);
    }

    public function ShowMailListView()
    {
        $mailList = $this->GetAllByUser($_SESSION["loggedUser"]);
        require_once(VIEWS_PATH . "mailList.php");
    }

    public function ViewMailDetails($mailId)
    {
        $mail = $this->MailDAO->GetByid($mailId);
        require_once(VIEWS_PATH . "mailDetails.php");
    }
}