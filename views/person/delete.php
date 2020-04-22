<div class="row">
            <div class="col-md-12">
                <br>
                <div class="col-sm-12 text-center"><h2 class="text-white">Eliminar <b>Persona</b></h2></div>
                <br>
                <form action="?c=person&a=confirm_delete" method="POST">
                    <input type="hidden" id="id" name="id" value="<?=  $person[0] ?>">
                    <div class="form-group">
                        <input type="text" class='form-control border border-success bg-dark text-white' disabled="disabled" value="<?=  $person[1] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class='form-control border border-success bg-dark text-white'disabled="disabled" value="<?=  $person[2] ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class='form-control border border-success bg-dark text-white' disabled="disabled" value="<?=  $person[3] ?>">
                    </div>
                    <div class="form-group">
                        <input type="tel" class='form-control border border-success bg-dark text-white' disabled="disabled" value="<?=  $person[4] ?>">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-danger">Confirmar eliminación</button>
                    <a href='?c=person' class='btn btn-outline-danger btn-lg btn-block'>Regresar</a>
				</form>
            </div>
        </div>