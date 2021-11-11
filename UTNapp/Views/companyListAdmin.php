<?php
    require_once("nav-barAdmin.php");
?>
<br>
<h2 style="text-align:center;">Empresas Cargadas</h2>

    <table style="text-align:center;">
        <thead>
        <tr>
            <th style="width: 15%;">Code</th>
            <th style="width: 30%;">CUIT</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($companyList as $company)
                {
                ?>
                    <tr>
                    <td style="color:black"><?php echo $company->getName() ?></td>
                    <td style="color:black"><?php echo $company->getCuit() ?></td>
                        <td>
                            <form action="<?php echo FRONT_ROOT ?>Company/Remove" method="POST">
                                <button type="submit" class="btn" name="remove" value="<?php echo $company->getCuit() ?>"> Remove </button>
                            </form>
                        </td>
                        <td style="color:black">
                            <form action="<?php echo FRONT_ROOT ?>Company/ShowModifView" method="POST">
                                <input type="hidden" name="Cuit" value="<?php echo $company->getCuit() ?>">
                                <input type="hidden" name="Name" value="<?php echo $company->getName() ?>">
                                <button type="submit" class="btn" name="modify"> Modify </button>
                            </form>

                        </td>
                    </tr>
                <?php
               }
               
                ?>
        </tbody>        