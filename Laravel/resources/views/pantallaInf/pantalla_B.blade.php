<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        body {
            background-color: #91ced4;
            /* background-color: #FAE9D2; */
        }

        body * {
            box-sizing: border-box;
        }

        .header {
            background-color: #327a81;
            color: white;
            font-size: 1.5em;
            padding: 0.1rem;
            text-align: center;
            text-transform: uppercase;
        }

        img {
            border-radius: 50%;
            height: 50px;
            width: 50px;
        }

        .table-users {
            border: 1px solid #327a81;
            border-radius: 10px;
            box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
            max-width: calc(100% - 2em);
            margin: 1em auto;
            overflow: hidden;
            width: 800px;
        }

        table {
            width: 100%;
        }

        table td,
        table th {
            color: #2b686e;
            padding: 5px;
            size: 10px;
            font-size: larger;
            font-weight: 800;
        }

        table td {
            text-align: center;
            vertical-align: middle;
            font-size: 11;
        }

        table td:last-child {
            font-size: 0.95em;
            line-height: 1.4;
            text-align: left;
        }

        table th {
            background-color: #daeff1;
            font-weight: 300;
        }

        table tr:nth-child(2n) {
            background-color: white;

        }

        table tr:nth-child(2n + 1) {
            background-color: #edf7f8;
        }

        @media screen and (max-width: 700px) {

            table,
            tr,
            td {
                display: block;
                size: 15;
            }

            td:first-child {
                position: absolute;
                top: 50%;
                -webkit-transform: translateY(-50%);
                transform: translateY(-50%);
                width: 100px;
            }

            td:not(:first-child) {
                clear: both;
                margin-left: 100px;
                padding: 4px 20px 4px 90px;
                position: relative;
                text-align: left;
            }

            td:not(:first-child):before {
                color: #91ced4;
                content: "";
                display: block;
                left: 0;
                position: absolute;
            }

            td:nth-child(2):before {
                content: "Name:";
            }

            td:nth-child(3):before {
                content: "Email:";
            }

            td:nth-child(4):before {
                content: "Phone:";
            }

            td:nth-child(5):before {
                content: "Comments:";
            }

            tr {
                padding: 10px 0;
                position: relative;
            }

            tr:first-child {
                display: none;
            }
        }

        @media screen and (max-width: 500px) {
            .header {
                background-color: transparent;
                color: white;
                font-size: 2em;
                font-weight: 700;
                padding: 0;
                text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.1);
            }

            img {
                border: 3px solid;
                border-color: #daeff1;
                height: 100px;
                margin: 0.5rem 0;
                width: 100px;
            }

            td:first-child {
                background-color: #c8e7ea;
                border-bottom: 1px solid #91ced4;
                border-radius: 10px 10px 0 0;
                position: relative;
                top: 0;
                -webkit-transform: translateY(0);
                transform: translateY(0);
                width: 100%;
            }

            td:not(:first-child) {
                margin: 0;
                padding: 5px 1em;
                width: 100%;
            }

            td:not(:first-child):before {
                font-size: 0.8em;
                padding-top: 0.3em;
                position: relative;
            }

            td:last-child {
                padding-bottom: 1rem !important;
            }

            tr {
                background-color: white !important;
                border: 1px solid #6cbec6;
                border-radius: 10px;
                box-shadow: 2px 2px 0 rgba(0, 0, 0, 0.1);
                margin: 0.5rem 0;
                padding: 0;
            }

            .table-users {
                border: none;
                box-shadow: none;
                overflow: visible;
            }

            .logo1 {
                float: right;
                background-color: pink;
                color: red;
                font-family: monospace;
                font-size: 400%;
            }
        }
    </style>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Nunito:400,600,700");

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Nunito", sans-serif;
            color: rgba(0, 0, 0, 0.7);
        }

        .container {
            height: 200vh;
            background-image: url(https://images.unsplash.com/photo-1538137524007-21e48fa42f3f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=ac9fa0975bd2ebad7afd906c5a3a15ab&auto=format&fit=crop&w=1834&q=80);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .modal {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 20px;
            background: rgba(51, 51, 51, 0.5);
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }

        .modal-container {
            display: -webkit-box;
            display: flex;
            max-width: 720px;
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
            position: absolute;
            opacity: 0;
            pointer-events: none;
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            background: #fff;
            -webkit-transform: translateY(100px) scale(0.4);
            transform: translateY(100px) scale(0.4);
        }

        .modal-title {
            font-size: 26px;
            margin: 0;
            font-weight: 400;
            color: #55311c;
        }

        .modal-desc {
            margin: 6px 0 30px 0;
        }

        .modal-left {
            padding: 60px 30px 20px;
            background: #fff;
            -webkit-box-flex: 1.5;
            flex: 1.5;
            -webkit-transition-duration: 0.5s;
            transition-duration: 0.5s;
            -webkit-transform: translateY(80px);
            transform: translateY(80px);
            opacity: 0;
        }

        .modal-button {
            color: #7d695e;
            font-family: "Nunito", sans-serif;
            font-size: 18px;
            cursor: pointer;
            border: 0;
            outline: 0;
            padding: 10px 40px;
            border-radius: 30px;
            background: white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.16);
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .modal-button:hover {
            border-color: rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.8);
        }

        .modal-right {
            -webkit-box-flex: 2;
            flex: 2;
            font-size: 0;
            -webkit-transition: 0.3s;
            transition: 0.3s;
            overflow: hidden;
        }

        .modal-right img {
            width: 100%;
            height: 100%;
            -webkit-transform: scale(2);
            transform: scale(2);
            -o-object-fit: cover;
            object-fit: cover;
            -webkit-transition-duration: 1.2s;
            transition-duration: 1.2s;
        }

        .modal.is-open {
            height: 100%;
            background: rgba(51, 51, 51, 0.85);
        }

        .modal.is-open .modal-button {
            opacity: 0;
        }

        .modal.is-open .modal-container {
            opacity: 1;
            -webkit-transition-duration: 0.6s;
            transition-duration: 0.6s;
            pointer-events: auto;
            -webkit-transform: translateY(0) scale(1);
            transform: translateY(0) scale(1);
        }

        .modal.is-open .modal-right img {
            -webkit-transform: scale(1);
            transform: scale(1);
        }

        .modal.is-open .modal-left {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            opacity: 1;
            -webkit-transition-delay: 0.1s;
            transition-delay: 0.1s;
        }

        .modal-buttons {
            display: -webkit-box;
            display: flex;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
        }

        .modal-buttons a {
            color: rgba(51, 51, 51, 0.6);
            font-size: 14px;
        }

        .sign-up {
            margin: 60px 0 0;
            font-size: 14px;
            text-align: center;
        }

        .sign-up a {
            color: #8c7569;
        }

        .input-button {
            padding: 8px 12px;
            outline: none;
            border: 0;
            color: #fff;
            border-radius: 4px;
            background: #8c7569;
            font-family: "Nunito", sans-serif;
            -webkit-transition: 0.3s;
            transition: 0.3s;
            cursor: pointer;
        }

        .input-button:hover {
            background: #55311c;
        }

        .input-label {
            font-size: 11px;
            text-transform: uppercase;
            font-family: "Nunito", sans-serif;
            font-weight: 600;
            letter-spacing: 0.7px;
            color: #8c7569;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .input-block {
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            padding: 10px 10px 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .input-block input {
            outline: 0;
            border: 0;
            padding: 4px 0 0;
            font-size: 14px;
            font-family: "Nunito", sans-serif;
        }

        .input-block input::-webkit-input-placeholder {
            color: #ccc;
            opacity: 1;
        }

        .input-block input::-moz-placeholder {
            color: #ccc;
            opacity: 1;
        }

        .input-block input:-ms-input-placeholder {
            color: #ccc;
            opacity: 1;
        }

        .input-block input::-ms-input-placeholder {
            color: #ccc;
            opacity: 1;
        }

        .input-block input::placeholder {
            color: #ccc;
            opacity: 1;
        }

        .input-block:focus-within {
            border-color: #8c7569;
        }

        .input-block:focus-within .input-label {
            color: rgba(140, 117, 105, 0.8);
        }

        .icon-button {
            outline: 0;
            position: absolute;
            right: 10px;
            top: 12px;
            width: 32px;
            height: 32px;
            border: 0;
            background: 0;
            padding: 0;
            cursor: pointer;
        }

        .scroll-down {
            position: fixed;
            top: 50%;
            left: 50%;
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            -webkit-box-align: center;
            align-items: center;
            text-align: center;
            color: #7d695e;
            font-size: 32px;
            font-weight: 800;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .scroll-down svg {
            margin-top: 16px;
            width: 52px;
            fill: currentColor;
        }

        @media (max-width: 750px) {
            .modal-container {
                width: 90%;
            }

            .modal-right {
                display: none;
            }
        }
    </style>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }

        /* FONDO VIDEO */
        .contenido__video {
            background: #7DD174;
            overflow: hidden;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        /* Estilos para la etiqueta "video" con la calse (.video)  */
        .video {
            position: absolute;
            max-width: 300%;
            width: 100%;
        }

        /* media queries (personalizarlo a su antojo)*/
        @media(max-width: 900px) {
            .video {
                width: 150%;
            }
        }

        @media(max-width: 650px) {
            .video {
                width: 280%;
            }
        }

        @media(max-width: 480px) {
            .video {
                width: 300%;
            }
        }

        .presentacion,
        footer {
            background: rgba(255, 255, 255, .3);
            padding: 15px;
        }

        .presentacion {
            height: 100vh;
        }

        .contenido {
            max-width: 1024px;
            margin: 0 auto;
        }

        .titulo {
            color: #357DA2;
            font-size: 5vw;
            text-align: center;
        }

        .informacion {
            font-size: 2vw;
        }

        .autor {
            display: block;
            color: inherit;
            text-decoration: none;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('plantillaPantalla/modal/css/reset.cs')}}s"> <!-- CSS reset -->
    <link rel="stylesheet" href="{{ asset('plantillaPantalla/modal/css/style.css')}}"> <!-- Resource style -->
</head>

<body class="clones-transition">
    <br><br>
    <div class="row">
        <div class="col-lg-11" align="center">
            <h1 style="color: white;"> <strong> CENTRO DE SALUD JESUS OBRERO - HORARIOS DE ATENCIÓN</strong></h1>

        </div>
        <div class="col-lg-1">
            <img class="logo1" src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="">
        </div>


        <div class="col-lg-4">
            <div class="table-users">
                <div class="header">Medina Familiar</div>
                <table cellspacing="0" cellpading="0" class="table ">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Montecinos</td>
                        <td>Lunes, Martes, Jueves y Viernes / Miercoles 14:30 - 20:00 </td>
                        <td>Hrs 9:30am - 13:30</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dra. Mollinedo</td>
                        <td>Lunes a Sabado </td>
                        <td>Hrs 9:00 - 14:00</td>
                    </tr>
                </table>
            </div>
            <div class="table-users">
                <div class="header">Ginecologia</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dra. Galvez</td>
                        <td>Lunes, Miercoles y Viernes </td>
                        <td>Hrs 9:00 - 14:00</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dra. Pinaya</td>
                        <td>Martes y Jueves</td>
                        <td>9:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dra. Romero</td>
                        <td>Martes a Viernes</td>
                        <td>14:00 - 18:00</td>
                    </tr>
                </table>
            </div>
            <div class="table-users">
                <div class="header">Traumatologia</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Quispe</td>
                        <td>Lunes, Martes, Miercoles, Viernes, Sabado </td>
                        <td>Hrs 8:00 - 12:00</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Guzman</td>
                        <td>Martes, Miercoles, Viernes </td>
                        <td>Hrs 15:00 / Jueves 9:00</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Huchani</td>
                        <td>Martes, Jueves </td>
                        <td>Hrs 15:00</td>
                    </tr>
                </table>
            </div>


        </div>
        <div class="col-lg-4">
            <div class="table-users">
                <div class="header">Medicina General</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Huallani</td>
                        <td>Lunes A Viernes </td>
                        <td>Hrs 14:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dra. Villalobos</td>
                        <td>Miercoles,Sabado </td>
                        <td>Hrs 8:00 - 12:00</td>
                    </tr>
                </table>
            </div>
            <div class="table-users">
                <div class="header">Gastroenterologia</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Flores</td>
                        <td>Martes, Jueves </td>
                        <td>Hrs 9:00 - 12:00</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Morochi</td>
                        <td>Lunes Miercoles</td>
                        <td>Hrs 9:00 </td>
                    </tr>
                </table>
            </div>
            <div class="table-users">
                <div class="header">Otorrinolaringologia</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dra. LLanos</td>
                        <td>Lunes </td>
                        <td>Hrs 9:00 - 11:00</td>
                    </tr>
                </table>
            </div>
            <div class="table-users">
                <div class="header">Fisioterapia</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Lic. Irma Rojas</td>
                        <td>Lunes a Viernes </td>
                        <td>Hrs 9:00 - 13:00</td>
                    </tr>
                </table>
            </div>
            <div class="table-users">
                <div class="header">Dermatologia</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Salazar</td>
                        <td>Miercoles </td>
                        <td>Hrs 10:30 - 12:00</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="table-users">
                <div class="header">Pediatria</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dra. Cortez</td>
                        <td>Lunes a Viernes </td>
                        <td>Hrs 8:00 a 12:00</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dra. Mamani</td>
                        <td>Martes a Viernes </td>
                        <td>Hrs 12:30 - 15:30</td>
                    </tr>
                </table>
            </div>
            <div class="table-users">
                <div class="header">Cirugia</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Lazo</td>
                        <td>Lunes a Viernes </td>
                        <td>Hrs 9:30</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Santander</td>
                        <td>Lunes, Martes, Miercoles y Viernes</td>
                        <td>Hrs 12:00 17:00</td>
                    </tr>
                </table>
            </div>

            <div class="table-users">
                <div class="header">Urologia</div>
                <table cellspacing="0">
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Henning</td>
                        <td>Martes y Jueves </td>
                        <td>Hrs 8:00 </td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" alt="" /></td>
                        <td>Dr. Candia</td>
                        <td> Lunes y Viernes </td>
                        <td>Hrs 9:00</td>
                    </tr>
                </table>
            </div>
            <div class="table-users">
                <div class="header" style="background-color: #D2F72C; color:black">Precio Bs.-</div>
                <table cellspacing="0">
                    <tr>
                        <td>Consulta medica</td>
                        <td>60 Bs.- </td>
                    </tr>
                    <tr>
                        <td>Control Medico Programado</td>
                        <td> 40 Bs.- </td>
                    </tr>
                </table>
            </div>
            <div class="table-users">
                <table cellspacing="0">
                    <tr>
                        <td>Servicio de emergencias las 24 Horas</td>
                        <td> </td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="col-lg-12">
            <div style="text-align:right;padding:1em 0;">
                <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=America%2FLa_Paz" width="100%" height="540" frameborder="0" seamless></iframe>
            </div>

        </div>
        <!-- <div class="col-lg-12">
            <br>
            <div style="text-align:center;">
                <img style="width:'100%' ;height:'200px'" src="{{ asset('plantillaPantalla/images/fotoMedico.png') }}"  alt="">
            </div>
            <br>
        </div> -->


    </div>


    <div class="contenido__video">
        <!-- 
    autoplay: propiedad para que se reproduzca una ves que carga la página
    loop: propiedad para el vídeo se repita infinitamente
    muted: propiedad para que el vídeo no emita sonido
    poster: propiedad que muestra una imagen hasta que cargue el vídeo 
  -->
        <video class="video" autoplay="autoplay" loop="loop" muted="muted" poster="images/artesano.png">
            <source src="{{ asset('plantillaPantalla/mod1/video/nuves.mp4') }}" type="video/mp4" />
            <!-- <source src="{{ asset('plantillaPantalla/mod1/video/video2.mp4') }}" type="video/mp4" /> -->
            <!-- <source src="{{ asset('plantillaPantalla/mod1/video/artesano-1920x1080.webm') }}" type="video/webm" /> -->
        </video>
    </div>
    <!-- <div class="scroll-down">SCROLL DOWN
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
            <path d="M16 3C8.832031 3 3 8.832031 3 16s5.832031 13 13 13 13-5.832031 13-13S23.167969 3 16 3zm0 2c6.085938 0 11 4.914063 11 11 0 6.085938-4.914062 11-11 11-6.085937 0-11-4.914062-11-11C5 9.914063 9.914063 5 16 5zm-1 4v10.28125l-4-4-1.40625 1.4375L16 23.125l6.40625-6.40625L21 15.28125l-4 4V9z" />
        </svg>
    </div> -->
    <!-- <div class="container"></div> -->
    <div class="modal">
        <div class="modal-container">
            <div class="modal-left">
                <h1 class="modal-title">Welcome!</h1>
                <p class="modal-desc">Fanny pack hexagon food truck, street art waistcoat kitsch.</p>
                <div class="input-block">
                    <label for="email" class="input-label">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="input-block">
                    <label for="password" class="input-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="modal-buttons">
                    <a href="" class="">Forgot your password?</a>
                    <button class="input-button">Login</button>
                </div>
                <p class="sign-up">Don't have an account? <a href="#">Sign up now</a></p>
            </div>
            <div class="modal-right">
                <img src="https://images.unsplash.com/photo-1512486130939-2c4f79935e4f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=dfd2ec5a01006fd8c4d7592a381d3776&auto=format&fit=crop&w=1000&q=80" alt="">
            </div>
            <button class="icon-button close-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                    <path d="M 25 3 C 12.86158 3 3 12.86158 3 25 C 3 37.13842 12.86158 47 25 47 C 37.13842 47 47 37.13842 47 25 C 47 12.86158 37.13842 3 25 3 z M 25 5 C 36.05754 5 45 13.94246 45 25 C 45 36.05754 36.05754 45 25 45 C 13.94246 45 5 36.05754 5 25 C 5 13.94246 13.94246 5 25 5 z M 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.980469 15.990234 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 z"></path>
                </svg>
            </button>
        </div>
        <!-- <button class="modal-button">Click here to login</button> -->
    </div>

    <!-- modal  -->
    <main class="cd-main-content">
        <div class="center">
            <h1>Clones</h1>
            <a href="#modal-1" class="cd-btn cd-modal-trigger">Start Effect</a>
        </div>
    </main> <!-- .cd-main-content -->

    <div class="cd-modal" id="modal-1">
        <div class="modal-content">
            <h1 style="color: black;" align="center"> Medicina familiar</h1>
            <table>

                <tr>
                    <td>
                        <img style=" border-radius: 10%;
                                        height: 300px;
                                        width: 300px;" src="{{ asset('plantillaPantalla/images/medicinaFamiliar1.jpg') }}">
                    </td>

                    <td>
                        <p style="color: black; font-size:15">
                            La Medicina Familiar es una especialidad del ámbito clínico ambulatorio que se ocupa de la atención integral del paciente y su familia.
                            Por tratarse de una disciplina integradora, su campo de acción no se limita a un órgano o sistema en particular sino a la globalidad
                            y contexto de las diferentes situaciones de salud /enfermedad que pueden ocurrir a lo largo de la vida de una persona.

                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img style=" border-radius: 10%;
                                        height: 300px;
                                        width: 300px;" src="{{ asset('plantillaPantalla/images/med1.png') }}">
                    </td>

                    <td>
                        <p style="color: black; font-size: 18px">
                            Doctor: Montecinos <br>
                            Lunes, Martes, Jueves y Viernes Hrs 9:30am - 13:30 <br>
                            Miercoles 14:30 - 20:00 <br>
                            Costo de la consulta 60 Bs.- <br>
                            Costo de Control medico 40 Bs.-
                        </p>
                    </td>
                </tr>
            </table>
        </div> <!-- .modal-content -->

        <a href="#0" id="closeModal" class="modal-close" hidden>Close</a>
    </div> <!-- .cd-modal -->

    <div class="cd-transition-layer" data-frame="25">
        <div class="bg-layer"></div>
    </div> <!-- .cd-transition-layer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script>
        if (!window.jQuery) document.write('<script src="js/jquery-2.2.1-min.js"><\/script>');
    </script>
    <script>
        const body = document.querySelector("body");
        const modal = document.querySelector(".modal");
        const modalButton = document.querySelector(".modal-button");
        const closeButton = document.querySelector(".close-button");
        const scrollDown = document.querySelector(".scroll-down");
        let isOpened = false;

        const openModal = () => {
            modal.classList.add("is-open");
            body.style.overflow = "hidden";
        };

        const closeModal = () => {
            modal.classList.remove("is-open");
            body.style.overflow = "initial";
        };

        window.addEventListener("scroll", () => {
            if (window.scrollY > window.innerHeight / 3 && !isOpened) {
                isOpened = true;
                scrollDown.style.display = "none";
                openModal();
            }
        });

        modalButton.addEventListener("click", openModal);
        closeButton.addEventListener("click", closeModal);

        document.onkeydown = (evt) => {
            evt = evt || window.event;
            evt.keyCode === 27 ? closeModal() : false;
        };

        setInterval(() => {
            openModal();

        }, 5000);
    </script>
    <script>
        var anio = new Date();
        document.getElementById('anio').innerHTML = anio.getFullYear();
    </script>
    <script src="{{ asset('plantillaPantalla/modal/js/modernizr.js')}}"></script> <!-- Modernizr -->
    <script src="{{ asset('plantillaPantalla/modal/js/main.js')}}"></script> <!-- Resource jQuery -->
    <script>
        setInterval(() => {
            $('.cd-modal-trigger').click();
            setTimeout(() => {
                $('#closeModal').click();
            }, 20000);
        }, 900000);
    </script>
</body>

</html>