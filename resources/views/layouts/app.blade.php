<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--Boostrap CSS-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/2eea58f571.js" crossorigin="anonymous"></script>

</head>
<body>
    
    <div class= "container p-5 my-5 border">
    <!--uso de blade para definir la plantilla-->
        @yield('content') 

    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const alertas = document.querySelectorAll('.alert');

        alertas.forEach(function(alerta) {
            setTimeout(function() {
                const closeButton = alerta.querySelector('.btn-close');
                if (closeButton) {
                    closeButton.click();
                }
            }, 10000); 
        });
    });
</script>

</body>
</html>