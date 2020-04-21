<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis tareas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>
<body class="bg-dark text-white" >
    <div class="container ">
        <div class="row">
            <div class="col-md-4">
                <br>
                <div class="col-sm-12 text-center"><h2 class="text-white">Nueva <b>Tarea</b></h2></div>
                <br>
                <form id="crearTarea" action="logica/CrearTarea.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre" class='form-control border border-success bg-dark text-white' maxlength="100" required placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <textarea  name="descripcion" id="descripcion" class='form-control border border-success bg-dark text-white' maxlength="255" required placeholder="descripción"></textarea>
                    </div>
                    <div class="form-group">
                        <input placeholder="Fecha de Inicio" class="form-control border border-success bg-dark text-white" type="text" onfocus="(this.type='date')" name="fechaInicio" id="fechaInicio"> 
                    </div>
                    <div class="form-group">
                    <input placeholder="Fecha de finalización" class="form-control border border-success bg-dark text-white" type="text" onfocus="(this.type='date')" name="fechaFin" id="fechaFin"> 
                    </div>
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-success">Crear Tarea</button>
				</form>
            </div>
            <div class="col-md-8">
                <br>
                    <div class="col-sm-12 text-center"><h2 class="text-white">Listado de <b>Tarea</b></h2></div>
                <br>
                <div class="row" id="divTareas">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mensajeModal" tabindex="-1" role="dialog" aria-labelledby="mensajeModalTitulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark text-white">
        <div class="modal-header">
            <h5 class="modal-title" id="mensajeModalTitulo">Mensaje</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="mensaje"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>

            function listarTareas()
            {                
                $.ajax({
                    type: 'GET',
                    url: "logica/ListarTareas.php",
                    success: function(data){
                    if(data){
                        $('#divTareas').empty();
                        $('#divTareas').append(data);
                    }
                    else{
                        $('#mensaje').empty();
                        $('#mensaje').append("<label>Error al listar tareas</label>");
                        $('#mensajeModal').modal('show');
                    }
                    },
                    error: function(data){
                        $('#mensaje').empty();
                        $('#mensaje').append("<label>Error al listar tareas</label>");
                    }
                });
            }

            function removerTarea(codigo)
            {
                $.ajax({
                    type: 'POST',
                    url: "logica/EliminarTarea.php",
                    data: {"codigo" : codigo},
                    success: function(data){
                    if(data){
                        $('#mensaje').empty();
                        $('#mensaje').append(data);
                        $('#mensajeModal').modal('show');
                        listarTareas();
                    }
                    else{
                        $('#mensaje').empty();
                        $('#mensaje').append("<label>Error al remover tarea</label>");
                        $('#mensajeModal').modal('show');
                    }
                    },
                    error: function(data){
                        $('#mensaje').empty();
                        $('#mensaje').append("<label>Error al remover tarea</label>");
                    }
                });
            }

        $(document).ready(function(){

            listarTareas();

            $('#crearTarea').submit(function(event){
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(data){
                   if(data){
                    $('#mensaje').empty();
                    $('#mensaje').append(data);
                    $('#mensajeModal').modal('show');
                    listarTareas();
                   }
                   else{
                    $('#mensaje').empty();
                    $('#mensaje').append("<label>Error al crear tarea</label>");
                    $('#mensajeModal').modal('show');
                   }
                },
                error: function(data){
                    $('#mensaje').empty();
                    $('#mensaje').append("<label>Error al crear tarea</label>");
                }
            });
        });
    });
    </script>
</body>
</html>