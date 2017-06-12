@include('template/header')
<body class="bg-soft-brown">
	<div canvas="container" class="bg-soft-brown row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-3 no-padding-left">
					<img class="icon icon-left js-toggle-left-slidebar" src="{{ URL::asset('assets/img/menu.png') }}">
				</div>
				<div class="col-xs-6 text-center">
					<h6 class="title text-brown">Mutu</h6>						
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 konten with-title">
					<div class="title text-center bg-brown-3">
						Penilaian Mutu
					</div>
					@if(Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
					  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  	<small>{{ Session::get('message') }}</small>
					</div>
					@endif
					<table>
						<thead>
							<th>Nilai</th>
							<th>Mutu</th>
							<th></th>
						</thead>
						<tbody>
							@foreach($mutus as $mutu)
							<tr>
								<td>{{ $mutu->nilaimutu }}</td>
								<td>{{ $mutu->mutu }}</td>
								<td class="text-right">
									<a href="/admin/penilaian/ubah/{{ $mutu->id_mutu }}">
										<b>ubah</b>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@include('admin/template/menu')
	@include('template/footer')