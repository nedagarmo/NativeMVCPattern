<div class="row">
            <div class="col-md-12">
                <br>
                <div class="col-sm-12 text-center"><h2 class="text-white">Nueva <b>Tarea</b></h2></div>
                <br>
                <form action="?c=task&a=create" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" id="name" class='form-control border border-success bg-dark text-white' maxlength="200" required placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" name="description" id="description" class='form-control border border-success bg-dark text-white' maxlength="25" required placeholder="Descripción">
                    </div>
                    <div class="form-group">
                        Estado
                         <select name="state" id="state" class="form-control border border-success bg-dark text-white">
                            <option value="1" selected>Creada</option> 
                            <option value="2">En ejecucion</option>
                            <option value="3">Finalizada</option>
                        </select>
                    </div>
                    <div class="form-group">
                       <b> Fecha Inicial</b>
                        <input type="date" name="initDate" id="initDate" class='form-control border border-success bg-dark text-white' maxlength="250" required placeholder="Fecha Inicial">
                    </div>
                    <div class="form-group">
                      <b> Fecha Final</b>
                        <input type="date" name="finishDate" id="finishDate" class='form-control border border-success bg-dark text-white' maxlength="250" required placeholder="Fecha Final">
                    </div>
                    <div class="form-group">
                         <b>Creador</b>
                         <select name="creator" id="creator" class="form-control border border-success bg-dark text-white">
                             <?php foreach ($people as $person) : ?>
                                 <option value="<?= $person[0]?>" selected><?= strtoupper($person[1])?></option> 
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                         <b>Colaboradores</b><br>       
                         <div class="row">                  
                                <?php foreach ($people as $person) : ?>
                                    <div class="col-md-4">
                                        <input type="checkbox" value="<?= $person[0]?>" name="coworkers[]"><?= strtoupper($person[1])?></input> 
                                    </div>
                                <?php endforeach; ?>     
                            </div>                  
                    </div>
                    
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-success">Crear</button>
                    <a href='?c=task' class='btn btn-outline-danger btn-lg btn-block'>Regresar</a>
				</form>
            </div>
        </div>