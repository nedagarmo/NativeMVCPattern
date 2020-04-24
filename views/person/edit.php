<div class="row">
    <div class="col-md-12">
        <br>
        <div class="col-sm-12 text-center"><h2 class="text-white">Editar <b>Persona</b></h2></div>
        <br>
        <form id="crearTarea" action="?c=person&a=update" method="POST">
            <input type="hidden" id="id" name="id" value="<?=  $person[0] ?>">
            <div class="form-group">
                <input type="text" name="name" id="name" class='form-control border border-success bg-dark text-white' maxlength="200"  placeholder="Nombre" value="<?=  $person[1] ?>">
            </div>
            <div class="form-group">
                <input type="text" name="identification" id="identification" class='form-control border border-success bg-dark text-white' maxlength="25" required placeholder="Identificación" value="<?=  $person[2] ?>">
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" class='form-control border border-success bg-dark text-white' maxlength="250" required placeholder="Correo electrónico" value="<?=  $person[3] ?>">
            </div>
            <div class="form-group">
                <input type="tel" name="phone" id="phone" class='form-control border border-success bg-dark text-white' maxlength="250" required placeholder="Celular" value="<?=  $person[4] ?>">
            </div>
            <br>
            <button type="submit" class="btn btn-lg btn-block btn-success">Guardar</button>
            <a href='?c=person' class='btn btn-outline-danger btn-lg btn-block'>Regresar</a>
        </form>
    </div>
</div>