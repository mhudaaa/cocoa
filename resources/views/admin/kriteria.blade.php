@include('template/header')
<body class="bg-brown-3">
	<div canvas="container" class="bg-brown-3 row shadow">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-2 no-padding-left">
					<img class="icon icon-left js-toggle-left-slidebar" src="{{ URL::asset('assets/img/menu-2.png') }}">
				</div>
				<div class="col-xs-8 text-center">
					<h6 class="title">Kriteria Pengujian</h6>						
				</div>
				<div class="col-xs-2 no-padding-right">
					<a href="/admin/kriteria/tambah"><img class="icon icon-right" src="{{ URL::asset('assets/img/plus-2.png') }}"></a>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 konten">
					@if(Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
					  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  	<small>{{ Session::get('message') }}</small>
					</div>
					@endif
					<table>
						<thead class="text-brown">
							<th class="left">Kriteria</th>
							<th>Bobot</th>
							<th>Nilai</th>
							<th></th>
						</thead>
						<tbody>
							@foreach($kriterias as $kriteria)
							<tr class="clickable-row" data-href="/admin/subkriteria/get/{{ $kriteria->id_kriteria }}">
								<td class="left">{{ $kriteria->kriteria }}</td>
								<td>{{ substr($kriteria->bobot, 0, 5) }}</td>
								<td>{{ $kriteria->nilai }}</td>
								<td>
									<a href="/admin/kriteria/ubah/{{ $kriteria->id_kriteria }}">
										<img src="{{ URL::asset('assets/img/edit.png') }}">
									</a>
								</td>
							</tr>
							@endforeach
							<tr>
								<td class="text-right"><hr><b>Jumlah Bobot :</b></td>
								<td><hr><b>{{ $totalBobot }}</b></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- <div class="text-center">
					<a href="/kriteria/ubah">
						<button class="btn btn-center shadow bg-brown-2 btn-rounded" type="submit">Ubah</button>
					</a>
				</div> -->
			</div>
		</div>
	</div>
	
	@include('admin/template/menu')
	@include('template/footer')