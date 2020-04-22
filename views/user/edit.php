<div class="row">
            <div class="col-md-12">
                <br>
                <div class="col-sm-12 text-center"><h2 class="text-white">Editar <b>Usuario</b></h2></div>
                <br>
                <form action="?c=user&a=update" method="POST">
                    <input type="hidden" id="person_id" name="person_id" value="<?=  $user[2] ?>">
                    <input type="hidden" id="password" name="password" value="<?=  $user[1] ?>">
                    <div class="form-group">
                        <input type="text" name="username" id="username" class='form-control border border-success bg-dark text-white' maxlength="25" required placeholder="Usuario" value="<?=  $user[0] ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" name="old_password" id="old_password" class='form-control border border-success bg-dark text-white' maxlength="100" required placeholder="Contraseña actual">
                    </div>
                    <div class="form-group">
                        <input type="password" name="new_password" id="new_password" class='form-control border border-success bg-dark text-white' maxlength="100" required placeholder="Nueva contraseña">
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" id="confirm_password" class='form-control border border-success bg-dark text-white' maxlength="100" required placeholder="Confirme nueva contraseña">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-success">Guardar</button>
                    <a href='?c=person' class='btn btn-outline-danger btn-lg btn-block'>Regresar</a>
				</form>
            </div>
        </div>