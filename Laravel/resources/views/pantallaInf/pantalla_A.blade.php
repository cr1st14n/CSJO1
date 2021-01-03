<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .parent {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(5, 1fr);
            grid-column-gap: 0px;
            grid-row-gap: 0px;
            padding: 10px;
            background-color: #F3E9DA;


        }

        .div1 {
            grid-area: 1 / 4 / 2 / 6;
        }

        .div2 {
            grid-area: 2 / 4 / 4 / 6;
        }

        .div3 {
            grid-area: 1 / 1 / 4 / 4;
        }

        .div4 {
            grid-area: 4 / 1 / 5 / 6;
        }

        .grid-container {
            display: grid;
            /* grid-template-columns: auto auto auto auto; */
            grid-gap: 10px;
            background-color: #F3E9DA;
            padding: 10px;
        }

        .titulo {
            text-align: center;
            background-color: #F3E9DA;

        }
    </style>
</head>

<body>
    <div class="">
        <h1 id="titulo" align="center">Centro de Salud Jesus Obrero Horarios de Antención</h1>
        <div class="parent">
            <div class="div1">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('plantillaPantalla/images/hot_img1.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('plantillaPantalla/images/hot_img1.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div2">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('plantillaPantalla/images/hot_img1.jpg') }}" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card titlwwwwwwwwes</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- seccion horarios -->
            <div class="div3">
                <div class="row">
                    <!-- SECCION 1  -->
                    <div class="col-md-4">
                    <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">Medicina Familiar</h4>
                                        <p class="card-text"> <strong>Dr. Montecinos</strong><br>LUNES, MARTES, JUEVES, VIRNES 9:00 AM <br>
                                                              <strong>Dra. Mollinedo</strong><br>LUNES A SABADO 08:30 AM</p>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">Ginecologia</h4>
                                        <p class="card-text"> <strong>Dra. Galvez</strong><br>LUNES, Miercoles, Viernes, 9:00 - 14:00 <br>
                                                                <strong>Dra. Pinalla</strong><br>MARTES, JUEVES 09:00 - 13:00  </p>
                                                                <strong>Dra. Gutierres</strong><br>LUNES 09:00 - 13:00  </p>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">TRAUMATOLOGIA</h4>
                                        <p class="card-text"> <strong>Dr. QUISPE</strong><br>LUNES,MARTES, MIERCOLES, Viernes, SABADO 8:30 - 12:30 <br>
                                                                <strong>Dr. GUZMAN</strong><br>MARTES, MIERCOLES, VIERNES 15:00 / JUEVES 9:00  </p>
                                                                <strong>Dr. HUCHANI</strong><br>MARTES, JUEVES 15:00  </p>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- SEC 2 -->
                    <div class="col-md-4">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">MEDICINA GENERAL</h4>
                                        <p class="card-text"> <strong>Dr. HUALLANI</strong><br>LUNES A VIERNES 14:00-20:00 <br>
                                                            <strong>Dra. VILLALOBOS</strong><br>MIERCOLES, SABADO 08:00</p>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">GASTROENTEROLOGIA</h4>
                                        <p class="card-text"> <strong>Dr. FLORES</strong><br>MARTES, JUEVES 9:00 <br>
                                                                <strong>Dr. MOROCHI</strong><br>LUNES, MIERCOLES 9:00 </p>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">OTORRINOLARINGOLOGIA</h4>
                                        <p class="card-text"> <strong>Dr. LLANOS</strong><br>LUNES 9:00 <br>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">PEDIATRIA</h4>
                                        <p class="card-text"> <strong>Dr. CORTEZ</strong><br>LUNES A VIERNES 8:00 - 12:00 <br>
                                            <strong>Dr. MAMANI</strong><br>MARTES A VIERNES Hrs 12:30 - 15:30</p>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">DERMATOLOGIA</h4>
                                        <p class="card-text"> <strong>Dr. SALAZAR</strong><br>MIERCOLES Hrs 9:00<br>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">CIRUGIA</h4>
                                        <p class="card-text"> <strong>Dr. LAZO</strong><br>LUNES A VIERNES Hrs 9:00 <br>
                                                                <strong>Dr. SANTANDER</strong><br>LUNES A VEIRNES Hrs 12:00 </p>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{ asset('plantillaPantalla/images/logo_csjo.jpg') }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4 class="card-title">UROLOGIA</h4>
                                        <p class="card-text"> <strong>Dr. HENNING</strong><br>MARTES Y JUEVES Hrs 8:00 <br>
                                                                <strong>Dr. CANDIA</strong><br>LUNES Y VIERNES Hrs 9:00 </p>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('plantillaPantalla/images/hot_img1.jpg') }}" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>