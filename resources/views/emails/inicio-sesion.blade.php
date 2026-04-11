<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        .container {
            font-family: Arial;
            background: #f4f4f4;
            padding: 30px;
        }
        .content {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            border-top: 6px solid #e63946;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .titulo {
            color: #e63946;
            font-size: 26px;
            margin: 0;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .subtitulo {
            color: #f5a623;
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 5px;
        }
        .linea {
            border: none;
            border-top: 2px solid #f5a623;
            margin: 20px 0;
        }
        .mensaje {
            color: #333333;
            line-height: 1.8;
            font-size: 15px;
        }
        .nombre {
            color: #e63946;
            font-weight: bold;
        }
        .alerta {
            background: #fff8e1;
            border-left: 4px solid #f5a623;
            padding: 12px 15px;
            border-radius: 4px;
            color: #555555;
            font-size: 14px;
            margin: 20px 0;
        }
        .btn {
            display: block;
            background: #e63946;
            color: #ffffff;
            padding: 14px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            margin: 25px auto;
            width: 200px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 13px;
        }
        .footer {
            color: #999999;
            text-align: center;
            font-size: 11px;
            margin-top: 25px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">

            <div class="header">
                <h1 class="titulo">WALL-E</h1>
                <p class="subtitulo">Sistema de Emergencias</p>
            </div>

            <hr class="linea">

           <center>
             <p class="mensaje">
                Estimado/a <span class="nombre">{{ $user->name }}</span>,
                Se ha detectado un nuevo inicio de sesión en tu cuenta <br>
                del sistema WALL-E.
            </p>

           </center>


            <div class="alerta">
                Si no reconoces esta actividad, contacta al administrador del sistema inmediatamente para solicitar un cambio de contraseña.
            </div>

            <a href="{{ route('acceso') }}" class="btn">
                Verificar Actividad
            </a>

            <hr class="linea">

            <p class="footer">
                Este es un mensaje automático del sistema WALL-E. <br>
            </p>

        </div>
    </div>
</body>
</html>