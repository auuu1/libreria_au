@if(session('success'))

    <div id="alert" class="alert alert-success alert-dismissible d-flex align-items-center fade show">
    <i class="fa-solid fa-circle-check"></i>
    <!-- Obtener mensaje desde la sesión -->
    <strong class="mx-2">¡Exito!</strong> {{ session('success')}}  
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            // Obtener el elemento por el Id
            let alerta = document.getElementById('alert');

            if(alert){
                // Quitar clase que permite ver la alerta
                alerta.classList.remove('show');
                // Añadir animación Fade
                alert.classList.add('fade');

                setTimeout(() => alerta, 500);
            }
            
        }, 3000); // Desaparecer después de 3 segundos
    </script>

@endif