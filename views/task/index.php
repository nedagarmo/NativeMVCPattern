<div class="row">
            <div class="col-md-12">
                <br>
                    <div class="col-sm-12 text-center"><h2 class="text-white">Listado de <b>Tareas</b></h2></div>
                <br>
                <div class="row">
                <div class="col-sm-6 text-center"><a href='?c=task&a=insert' class='btn btn-success btn-lg btn-block'>Crear Tarea</a></div>
                <br>
                <div class="col-sm-6 text-center"><a href='?c=home' class='btn btn-outline-danger btn-lg btn-block'>Regresar</a></div>
                </div>
                
                <br>
                <div class="row" id="divTareas">
                <?php 
                    if(isset($tasks)){                     
                    foreach ($tasks as $task) : ?>
                        <div class='col-md-4'>
                            <div class='card  bg-dark text-white border-success'>
                                <div class='card-header border-success'>
                                    <h4><?= $task[1] ?></h4>
                                </div>
                                <div class='card-body'>
                                    <h5 class='card-title'>Descripción : <?= $task[2]?></h5>
                                    <p class='card-text'>Estado: 
                                    <?php
                                        if($task[3]=='1'){
                                            echo 'CREADA';
                                        }else if($task[3]=='2'){
                                            echo 'EN EJECUCIÓN';
                                        }else{
                                            echo 'FINALIZADA';    
                                        }
                                    ?>
                                    </p>
                                    <p class='card-text'>Fecha Inicial: <?= $task[4]?></p>  
                                    <p class='card-text'>Fecha Final: <?= $task[5]?></p>    
                                    <p class='card-text'>Creador: <?=strtoupper($task[7])?></p> 
                                    <p class='card-text'>Colaboradores: 
                                    <?php        
                                    if(count($task[8])>0){
                                        foreach ($task[8] as $coworkers) :                                            
                                            echo '<br>-'.strtoupper($coworkers[1]);                                           
                                         endforeach;  
                                    }else{
                                        echo 'No tiene colaboradores';
                                    }                                                             
                                                                                                             
                                    ?>
                                    </p>      
                                    <a href='?c=task&a=edit&id=<?= $task[0]?>' class='btn btn-warning btn-lg btn-block'>Editar</a>                                                                                                                                      
                                    <a href='?c=task&a=delete&id=<?= $task[0]?>' class='btn btn-danger btn-lg btn-block'>Eliminar</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; 
                    }else{?>
                         <div class='col-md-12'>
                            <div class='card  bg-dark text-white border-success'>
                                <div class='card-header border-success'>
                                    <h4>Nota</h4>
                                </div>
                                <div class='card-body'>
                                    No hay tareas para mostrar                                                                                                                                                
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>