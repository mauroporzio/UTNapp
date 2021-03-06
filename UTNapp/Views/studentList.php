<?php
    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRol() == 1)
    {
        $rol = 'admin';
        require_once("nav-barAdmin.php");
    }
    else
    {
        $rol = 'student';
        require_once("nav-barStudent.php");
    }
?>
<br>
<div style="margin:left;padding-left:10px">
               <form action="<?php echo FRONT_ROOT?> Home/Home" method="POST">
                    <button type="submit" class='btn'>Volver</button>
               </form>
               </div>
<h2 style="text-align:center; color: white">Estudiantes</h2>

    <table style="text-align:center;">
        <thead>
        <tr>
            <th style="width: 3%;">Nombre y apellido</th>
            <?php
                    if ($rol == 'admin')
                    { 
                        echo "<th style=".'"width: 1%;"'.">ID</th>";
                    }
            ?>
            <th style="width: 20%;">DNI</th>
            <th style="width: 1%;">Genero</th>
            <th style="width: 1%;">Email</th>
            <th style="width: 25%;">Carrera</th>
            <th style="width: 15%;">Fecha de Nacimiento</th>
            <th style="width: 10%;">Numero de telefono</th>
            <?php
                if ($rol == 'admin')
                { 
                    echo "<th style=".'"width: 1%;"'.">Activo</th>";
                }
            ?>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($studentList as $student)
                {
                    foreach($careerList as $career)
                    {
                        if ($career->getCareerId() == $student->getCareer()->getCareerId())
                        {
                            
                            ?>
                                <tr>
                                <td style="color:black"><?php echo $student->getLastName() ?>, <?php echo $student->getFirstName() ?></td>
                            <?php
                                if ($rol == 'admin')
                                {   
                                    echo "<td style=".'"color:black">'. $student->getStudentId() . "</td>";
                                }
                            ?>
                                <td style="color:black"><?php echo $student->getDNI() ?></td>
                                <td style="color:black"><?php echo $student->getGender() ?></td>
                                <td style="color:black"><?php echo $student->getEmail() ?></td>
                                <td style="color:black"><?php echo $career->getDescription() ?></td>
                            </td>
                                <?php $date=date_create($student->getBirthDate())?>
                                <td style="color:black"><?php echo date_format($date, "Y/m/d") ?></td>
                                <td style="color:black"><?php echo $student->getPhoneNumber() ?></td>
                            <?php  
                                if ($rol == 'admin')
                                {
                                    echo "<td style=".'"color:black"'.">";
                                        if($student->getActive())
                                        {
                                            echo "Si </td>";
                                        }else 
                                        {
                                            echo "No </td>";
                                        }  
                                ?>
                                </tr>
                            <?php
                            }
                        }
                    }
                }
                ?>
        </tbody> 