<div class="row">
            <div class="col-md-12">
                <br>
                <div class="col-sm-12 text-center"><h2 class="text-white">Nueva <b>Persona</b></h2></div>
                <br>
                <form action="?c=person&a=create" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" id="name" class='form-control border border-success bg-dark text-white' maxlength="200" required placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" name="identification" id="identification" class='form-control border border-success bg-dark text-white' maxlength="25" required placeholder="Identificación">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class='form-control border border-success bg-dark text-white' maxlength="250" required placeholder="Correo electrónico">
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" id="phone" class='form-control border border-success bg-dark text-white' maxlength="250" required placeholder="Celular">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-success">Crear</button>
                    <a href='?c=person' class='btn btn-outline-danger btn-lg btn-block'>Regresar</a>
				</form>
            </div>
        </div>