<?php
    require_once('nav-barStudent.php');
    $student = $_SESSION['loggedUser'];
?>
<main class="py-5">
     <section id="listado" class="mb-5">
         <h1></h1>
          <div class="container">
               <h2 class="mb-4">Ingrese su Cv para realizar la postulacion</h2>
               <form action="<?php echo FRONT_ROOT ?>Image/Upload" method="POST" enctype="multipart/form-data" class="bg-light-alpha p-5">
                              <label for="file">Imagen:</label>
                              <input type="file" name="file" class="form-control-file" required> 
                              <input type="hidden" name="idStudent" value="<?php echo $student->getStudentId();?>">                                              
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Postularme</button>
               </form>
          </div>
     </section>
</main>