<?php
session_start();
        $_SESSION['Titulo']= $_POST['Titulo'];
        $_SESSION['Precio'] = $_POST['Precio'];
        $Cantidad = $_POST['Cantidad'];
        echo $Titulo;
        echo $Precio;
        echo $Cantidad;
#if(isset($_SESSION['Carrito'])){
    #$Carrito = $_SESSION['Carrito'];
/*     if(isset($Titulo)){
        $Num = 0;
        $_SESSION['Carrito'] = array('Titulo' => $Titulo, 'Precio' => $Precio, 'Cantidad' => $Cantidad);

      /*   foreach ($_SESSION['Carrito'] as $Clave => $Valor) 
            echo $Clave . ": " . $Valor . "<br>";
        } */
/*         echo $_SESSION['Carrito']['Cantidad'];
        echo $_SESSION['Carrito']['Titulo'];
        echo $_SESSION['Carrito']['Precio']; 
            
} */

/* else{
/*      $Titulo = $_POST['Titulo'];
    $Precio = $_POST['Precio'];
    $Cantidad = $_POST['Cantidad'];
    $Carrito[]=array("Titulo" => $Titulo, "Precio" => $Precio, "Cantidad" => $Cantidad);  
} */
#$_SESSION['Carrito'] = $Carrito;

#header("Location: ".$_SERVER['HTTP_REFERER']."");
/*
<div class="modal fade" id="modal_cart" tabindex="-1" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-tittle" id="ModalLabel">titulo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <div>
                    <div class="p-2">
                        <ul class="list-group mb-3">
                            <?
                            if(isset($_SESSION['Carrito'])){
                                $Total =0;
                                for($i=0;$i<=count($Carrito)-1;$i ++){
                                    if($Carrito[$i]!=NULL){
                            
                            ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">

                            <div class="row col-12">
                                <div class="col-6 p-0" style="text-align:left;color;#0000;"><h5 class="my-0">Cantidad: <?php echo $Carrito[$i]['Cantidad']?>:<? echo $Carrito[$i]['Titulo'];?></h5></div>
                            <div class="col-6 p-0" style="text-align:right; color:#0000;">
                            <span class="text-muted" style="text-align:right; color:#0000;"><? echo $Carrito[$i]['Precio'] * $Carrito[i]['Cantidad']; ?> $</span>
                            </div>                          
                           
                            </div>
                            </li>  
                            <? 
                            $Total = $Total + ($Carrito[$i]['Precio'] * $Carrito[$i]['Cantidad']);         
                                    }
                                }
                            }
                            ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span style="text-align: left; color:#0000;">Total(Pesos)</span>
                                <strong style="text-align:left; color:#0000;"><?php
                                if(isset($_SESSION['Carrito'])){
                                    $Total = 0;
                                    for($i = 0; $i <= count($Carrito)-1;$i++){
                                        if($Carrito[$i]!=NULL){
                                            $Total = $Total + ($Carrito[$i]['Precio'] * $Carrito[$i]['Cantidad']);
                                        }
                                    }
                                }
                                echo $Total; ?>
                            </strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <a href="Vaciar.php" class="btn btn-primary" type="button">Vaciar</a>
        </div>
    </div>
</div>
</div>

*/
?>