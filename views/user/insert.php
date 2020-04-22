<div class="row">
            <div class="col-md-12">
                <br>
                <div class="col-sm-12 text-center"><h2 class="text-white">Crear <b>Usuario</b></h2></div>
                <br>
                <form action="?c=user&a=create" method="POST">
                    <input type="hidden" id="person_id" name="person_id" value="<?=  $person_id ?>">
                    <div class="form-group">
                        <input type="text" name="username" id="username" class='form-control border border-success bg-dark text-white' maxlength="25" required placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class='form-control border border-success bg-dark text-white' maxlength="100" required placeholder="Contraseña">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-success">Crear</button>
                    <a href='?c=person' class='btn btn-outline-danger btn-lg btn-block'>Regresar</a>
				</form>
            </div>
        </div>