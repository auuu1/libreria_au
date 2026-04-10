@if(session('success'))

    <div id="alert" class="alert alert-success alert-dismissible d-flex align-items-center fade show">
    <i class="fa-solid fa-circle-check"></i>
    <strong class="mx-2">¡Exito!</strong> {{ session('success')}}  
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            let alerta = document.getElementById('alert');
            if(alert){
                alerta.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alerta, 500);
            }
        }, 3000);
    </script>

@endif

@if(session('error'))

    <div id="alert-error" class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
    <i class="fa-solid fa-circle-exclamation"></i>
    <strong class="mx-2">¡Error!</strong> {{ session('error')}}  
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            let alerta = document.getElementById('alert-error');
            if(alerta){
                alerta.classList.remove('show');
                alerta.classList.add('fade');
                setTimeout(() => alerta, 500);
            }
        }, 3000);
    </script>

@endif


@if(session('warning'))

    <div id="alert-warning" class="alert alert-warning alert-dismissible d-flex align-items-center fade show">
    <i class="fa-solid fa-triangle-exclamation"></i>
    <strong class="mx-2">¡Advertencia!</strong> {{ session('warning')}}  
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            let alerta = document.getElementById('alert-warning');
            if(alerta){
                alerta.classList.remove('show');
                alerta.classList.add('fade');
                setTimeout(() => alerta, 500);
            }
        }, 3000);
    </script>

@endif