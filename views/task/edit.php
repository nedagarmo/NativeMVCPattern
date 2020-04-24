<div class="row">
    <div class="col-md-12">
        <br>
        <div class="col-sm-12 text-center"><h2 class="text-white">Nueva <b>Tarea</b></h2></div>
        <br>
        <form action="?c=task&a=update" method="POST">
        <input type="hidden" id="id" name="id" value="<?=  $task[0] ?>">
            <div class="form-group">
                <input type="text" name="name" id="name" class='form-control border border-success bg-dark text-white' maxlength="200" required placeholder="Nombre" value="<?=  $task[1] ?>">
            </div>
            <div class="form-group">
                <input type="text" name="description" id="description" class='form-control border border-success bg-dark text-white' maxlength="25" required placeholder="Descripción" value="<?=  $task[2] ?>">
            </div>
            <div class="form-group">
                Estado
                    <select name="state" id="state" class="form-control border border-success bg-dark text-white">
                    <option value="1" <?=  $task[3]=='1' ?"selected":"" ?>>Creada</option> 
                    <option value="2" <?=  $task[3]=='2' ?"selected":"" ?>>En ejecucion</option>
                    <option value="3" <?=  $task[3]=='3' ?"selected":"" ?>>Finalizada</option>
                </select>
            </div>
            <div class="form-group">
                <b> Fecha Inicial</b>
                <input type="date" name="initDate" id="initDate" class='form-control border border-success bg-dark text-white' maxlength="250" required placeholder="Fecha Inicial" value="<?=  $task[4] ?>">
            </div>
            <div class="form-group">
                <b> Fecha Final</b>
                <input type="date" name="finishDate" id="finishDate" class='form-control border border-success bg-dark text-white' maxlength="250" required placeholder="Fecha Final" value="<?=  $task[5] ?>">
            </div>
            <div class="form-group">
                <b>Creador</b>
                <select name="creator" id="creator" class="form-control border border-success bg-dark text-white">
                    <?php foreach ($users as $user) : ?>
                        <option value="<?= $user[0]?>" <?=$task[6]==$user[0]?"selected":"" ?>><?= strtoupper($user[1])?></option> 
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                    <b>Colaboradores</b><br>      
                    <div class="row">                  
                        <?php                            
                            foreach ($people as $person) :
                                if(count($task[8])>0){
                                    foreach ($task[8] as $coworker) :
                                        if($coworker[0]==$person[0]){
                                            $selected= true;
                                            break;
                                        }else{
                                            $selected= false;
                                        }
                                    endforeach;                                                                                    

                        ?>                                        
                                    <div class="col-md-4">
                                        <input type="checkbox" value="<?= $person[0]?>" name="coworkers[]" <?=$selected==true?"checked":""?>   class="form-check-input"><?= strtoupper($person[1])?></input> 
                                    </div>
                        <?php                                                                                            
                                }                                                                                                                    
                                endforeach;
                                
                        
                        ?>     
                    </div>                  
            </div>
            
            <br>
            <button type="submit" class="btn btn-lg btn-block btn-success">Guardar</button>
            <a href='?c=task' class='btn btn-outline-danger btn-lg btn-block'>Regresar</a>
        </form>
    </div>
</div>