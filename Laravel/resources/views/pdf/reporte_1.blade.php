<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.ico') }}">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap-I.min.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap-themes-o.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />



</head>
<body>
<div id="content">
		<div class="row">
			<section class="panel corner-flip">
				<div class="panel-body">
					<div class="invoice">
						<div class="row">
							<div class="col-sm-6">
								<a href="#"><img src="{{ asset('assets/img/logo_invice.png')}}"></a>
							</div>
							<div class="col-sm-6 align-lg-right">
									<h3>INVOICE NO. #572307</h3>
									<span>25 january 2014</span>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-12">
									<h4>From :ssssssssssssssssssssssssssssssssssssssssssssssssssssss</h4>
									John Doe <br>
									Mr Nilson Otto <br>
									FoodMaster Ltd </div>
							<div class="col-sm-3">
									<h4>To :</h4>
									1982 OOP <br>
									Madrid, Spain <br>
									+1 (151) 225-4183 </div>
							<div class="col-md-6 align-lg-right">
									<h4>Payment Details :</h4>
									<strong>V.A.T Reg #:</strong> 542554(DEMO)78 <br>
									<strong>Account Name:</strong> FoodMaster Ltd <br>
									<strong>SWIFT code:</strong> 45454DEMO545DEMO
							</div>
						</div>
						<br>
						<br>
						<table class="table table-bordered">
							<thead>
									<tr>
											<th>#</th>
											<th width="60%" class="text-left">Product</th>
											<th>Quantity</th>
											<th class="text-right">Price</th>
											<th>#</th>
											<th width="60%" class="text-left">Product</th>
											<th>Quantity</th>
											<th class="text-right">Price</th>
											<th>#</th>
											<th width="60%" class="text-left">Product</th>
											<th>Quantity</th>
											<th class="text-right">Price</th>

									</tr>
							</thead>
							<tbody>
									<tr>
											<td class="text-center">1</td>
											<td>Lorem Ipsum</td>
											<td class="text-center">1</td>
											<td class="text-right">$852</td>
											<td class="text-center">1</td>
											<td>Lorem Ipsum</td>
											<td class="text-center">1</td>
											<td class="text-right">$852</td>
											<td class="text-center">1</td>
											<td>Lorem Ipsum</td>
											<td class="text-center">1</td>
											<td class="text-right">$852</td>
									</tr>
									<tr>
											<td class="text-center">2</td>
											<td>Nulla pellentesque</td>
											<td class="text-center">1</td>
											<td class="text-right">$785</td>
											<td class="text-center">1</td>
											<td>Lorem Ipsum</td>
											<td class="text-center">1</td>
											<td class="text-right">$852</td>
									</tr>
									<tr>
											<td class="text-center">4</td>
											<td>Leo ornare lacinia</td>
											<td class="text-center">1</td>
											<td class="text-right">$1524</td>
											<td class="text-center">1</td>
											<td>Lorem Ipsum</td>
											<td class="text-center">1</td>
											<td class="text-right">$852</td>
									</tr>
									<tr>
											<td class="text-center">5</td>
											<td>Est arcu integer consectetuer</td>
											<td class="text-center">1</td>
											<td class="text-right">$74</td>
											<td class="text-center">1</td>
											<td>Lorem Ipsum</td>
											<td class="text-center">1</td>
											<td class="text-right">$852</td>
									</tr>
							</tbody>
						</table>
						<br><br>
						<div class="row">
							<div class="col-sm-6">
								<div class="align-lg-left"> 795 Park Ave, Suite 120 <br>
										San Francisco, CA 94107 <br>
										P: (234) 145-1810 <br>
										Full Name <br>
										first.last@email.com
								</div>
							</div>
							<div class="col-sm-6">
								<div class="align-lg-right">
									<ul>
										<li> Sub - Total amount: <strong>$3,235</strong> </li>
										<li> VAT: <strong>7.7%</strong> </li>
										<li> Discount: ----- </li>
										<li> Grand Total: <strong>$3,485</strong> </li>
									</ul>
									<br>
									<a href="javascript:window.print();" class="btn btn-theme hidden-print"><i class="fa fa-print"></i> </a>
									<a href="#" class="btn btn-theme-inverse hidden-print"> SAVE </a>
								</div>
							</div>
						</div>
					</div>
					<!-- //invoice -->
				</div>
			</section>
		</div>
		<!-- //content > row-->
		
</div>
<!-- //content-->



<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
		
<!-- Jquery Library -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="{{ asset('assets/js/modernizr/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/mmenu/jquery.mmenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/styleswitch.js') }}"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="{{ asset('assets/plugins/form/form.js') }}"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="{{ asset('assets/plugins/datetime/datetime.js') }}"></script>
<!-- Library Chart-->
<script type="text/javascript" src="{{ asset('assets/plugins/chart/chart.js') }}"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="{{ asset('assets/plugins/pluginsForBS/pluginsForBS.js') }}"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="{{ asset('assets/plugins/miscellaneous/miscellaneous.js') }}"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="{{ asset('assets/js/caplet.custom.js') }}"></script>
<!-- Library datable -->
<script type="text/javascript" src="{{ asset('assets/plugins/datable/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datable/dataTables.bootstrap.js') }}"></script>
</body>
</html>