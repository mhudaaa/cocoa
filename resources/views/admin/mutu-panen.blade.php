@include('template/header')
<body class="bg-soft-brown">
	<div canvas="container" class="bg-soft-brown row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-3 no-padding-left">
					<img class="icon icon-left js-toggle-left-slidebar" src="{{ URL::asset('assets/img/menu.png') }}">
				</div>
				<div class="col-xs-6 text-center">
					<h6 class="title text-brown">Mutu Panen</h6>						
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 konten with-title">
					<div class="title text-center bg-brown-3">
						Mutu Panen
					</div>
					@if(Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
					  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  	<small>{{ Session::get('message') }}</small>
					</div>
					@endif
					<table>
						<thead>
							<th>No.</th>
							<th>Tanggal Uji</th>
							<th>Berat</th>
							<th>Mutu</th>
						</thead>
						<tbody>
							<? $no = 0 ?>
							@foreach($panens as $no=>$panen)
							<tr class="clickable-row" data-href="/admin/mutu-panen/rincian/{{ $panen->id_panen }}">
								<td>{{ ++$no }}</td>
								<td>{{ date('M, d Y', strtotime($panen->tgl_uji)) }}</td>
								<td>{{ $panen->berat }} kg</td>
								<td>{{ $panen->mutu }}</td>
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