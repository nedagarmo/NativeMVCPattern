
<div class="row">
            <div class="col-md-12">
                <br>
                <div class="col-sm-12 text-center"><h2 class="text-white">Eliminar <b>Tarea</b></h2></div>
                <br>
                <form action="?c=task&a=confirm_delete" method="POST">
                    <input type="hidden" id="id" name="id" value="<?=  $task[0] ?>">
                    <div class="form-group">
                        <b>Nombre</b>
                        <input type="text" class='form-control border border-success bg-dark text-white' disabled="disabled" value="<?=  $task[1] ?>">
                    </div>
                    <div class="form-group">
                         <b>Descripción</b>
                        <input type="text" class='form-control border border-success bg-dark text-white'disabled="disabled" value="<?=  $task[2] ?>">
                    </div>
                    <div class="form-group">
                        <b>Estado</b>
                        <input type="text" class='form-control border border-success bg-dark text-white' disabled="disabled" value="<?=  $task[3]=='1'?"CREADA":$task[3]=='2'?"EN EJECUCIÓN":"FINALIZADA" ?>">
                    </div>
                    <div class="form-group">
                        <b>Fecha Inicial</b>
                        <input type="text" class='form-control border border-success bg-dark text-white' disabled="disabled" value="<?=  $task[4] ?>">
                    </div>
                    <div class="form-group">
                        <b>Fecha Final</b>
                        <input type="text" class='form-control border border-success bg-dark text-white' disabled="disabled" value="<?=  $task[5] ?>">
                    </div>
                    <div class="form-group">
                        <b>Creador</b>
                        <input type="text" class='form-control border border-success bg-dark text-white' disabled="disabled" value="<?=  strtoupper($task[7]) ?>">
                    </div>
                    <div class="form-group">
                        <b>Colaboradores</b>
                        
                             <?php
                             if(count($task[8])>0){
                                foreach ($task[8] as $coworker) :
                                    if ($coworker === end($task[8])) {
                                        $cowokers.= strtoupper($coworker[1]);
                                    }else{
                                        
                                    $cowokers.= strtoupper($coworker[1]).', ';
                                    }

                                endforeach;
                             }else{
                                echo 'No tiene colaboradores';
                            }   
                            ?>    
                            <textarea disabled  class="form-control border border-success bg-dark text-white"><?= $cowokers ?></textarea> 
                    </div>
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-danger">Confirmar eliminación</button>
                    <a href='?c=task' class='btn btn-outline-danger btn-lg btn-block'>Regresar</a>
				</form>
            </div>
        </div>