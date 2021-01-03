@extends('layouts.recHumLay')
@section('head1')
@endsection
@section('refUbi')
    <ol class="breadcrumb">
        <li><a href="#">Recepcion</a></li>
        <li class="active">Inicio</li>
    </ol>
    <div id="content">

        <div class="row">

            <div class="col-lg-8">

                <section class="panel">
                    <header class="panel-heading no-borders">
                        <h2><strong>Cumpleañeros</strong> del Mez </h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" >
                                <thead>
                                <tr>
                                    <th> Nombre </th>
                                    <th> Area</th>
                                    <th> fecha</th>
                                    <th>  -//-</th>
                                </tr>
                                </thead>
                                <tbody align="center">
                                <tr >
                                    <td> Mark Nilson </td>
                                    <td> makr124 </td>
                                    <td><span class="label label-sm bg-theme-inverse"> 14-07-2019 </span></td>
                                    <td><a class="btn btn-inverse btn-sm" href="#"><i class="fa fa-pencil"></i></a></td>
                                </tr>
                                <tr>
                                    <td> Filip Rolton </td>
                                    <td> jac123 </td>
                                    <td><span class="label label-sm bg-darkorange"> 12-05-2019   </span></td>
                                    <td><a class="btn btn-inverse btn-sm" href="#"><i class="fa fa-pencil"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <section hidden class="panel corner-flip">
                    <header class="panel-heading no-borders">
                        <h2><strong>LINE</strong> Chart </h2>
                        <label class="color">Plugin <strong> Morris chart</strong></label>
                    </header>
                    <div class="widget-chart">
                        <div id="morrisLine"></div>
                    </div><!-- // widget-chart -->
                </section>


                <section hidden class="panel corner-flip">
                    <header class="panel-heading no-borders">
                        <h2><strong>Area</strong> Chart </h2>
                        <label class="color">Plugin <strong>Morris chart</strong></label>
                    </header>
                    <div class="widget-chart chart-dark">
                        <div id="morrisArea"></div>
                    </div>
                </section>


                <section hidden class="panel corner-flip">
                    <header class="panel-heading no-borders">
                        <h2><strong>Bar</strong> Chart </h2>
                        <label class="color">Plugin <strong> Morris</strong></label>
                    </header>
                    <div class="widget-chart chart-dark">
                        <div id="morrisBar"></div>
                    </div>
                </section>

            </div>
            <!-- //content > row > col-lg-8 -->

            <div class="col-lg-4">

                <section class="panel corner-flip">
                    <header class="panel-heading no-borders">
                        <h2><strong>pie</strong> Chart </h2>
                        <label class="color">Donut Hole</label>
                    </header>
                    <div class="widget-chart" style=" padding-bottom:30px;">
                        <div id="morrisDonut"></div>
                    </div><!-- // widget-chart -->

                </section>

            </div>
            <!-- //content > row > col-lg-4 -->

        </div>
        <!-- //content > row-->

    </div>
    <!-- //content-->
@endsection
@section('content')

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/asincrono/recHum.js') }}"></script>
@endsection
