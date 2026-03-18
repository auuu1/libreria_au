@if(session('success'))
    <div id="alert" class="alert alert-success alert-dismissible d-flex align-items-center fade show">

        <i class="fa-solid fa-circle-check"></i>
        <!-- Obtener mensaje desde la sesión -->
        <strong class= "mx-2">¡Éxito!</strong> {{ session('success') }}

        <button type="button" class="btn-close" data-bs-dimiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            // Obtener el elemento por el ID
            let alerta = document.getElementById('alert');

            if(alert){
                // Obtener clase que permite ver la alerta
                alerta.classList.remove('show');
                // Añadir animación Fade
                alerta.classList.add('fade');

                setTimeout(() => alerta.remove(), 500);
            }

        }, 3000) // Desaparecer después de tres segundos
    </script>

@endif