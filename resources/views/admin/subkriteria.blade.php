@include('template/header')
<body class="bg-brown-5">
	<div canvas="container" class="bg-brown-5 row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-2 no-padding-left">
					<a href="/admin/kriteria"><img class="icon icon-left" src="{{ URL::asset('assets/img/back-2.png') }}"></a>
				</div>
				<div class="col-xs-8 text-center">
					<h6 class="title">{{ $kriteria->kriteria }}</h6>						
				</div>
				<div class="col-xs-2 no-padding-right">
					<a href="/admin/subkriteria/tambah/{{ $kriteria->id_kriteria }}"><img class="icon icon-right" src="{{ URL::asset('assets/img/plus-3.png') }}"></a>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-8 no-padding-left">
					<small>Nilai Normalisasi :</small>
				</div>
				<div class="col-xs-4 text-right no-padding-right">
					<small>{{ substr($kriteria->normalisasi, 0, 6) }}</small>
				</div>
			</div>
			<div class="xs-divider"></div>
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
							<th class="left">Subkriteria</th>
							<th>Nilai</th>
							<th width="40px"></th>
							<th width="25px"></th>
						</thead>
						<tbody>

							@foreach($subs as $sub)
							<tr>
								<td class="left">{{ $sub->subkriteria }}</td>
								<td>{{ $sub->utility }}</td>
								<td class="text-right">
									<a href="/admin/subkriteria/ubah/{{ $sub->id_subkriteria }}">
										<img src="{{ URL::asset('assets/img/edit.png') }}">
									</a>
								</td>
								<td class="text-right">
									<a href="/admin/subkriteria/hapus/{{ $sub->id_kriteria }}/{{ $sub->id_subkriteria }}">
										<img src="{{ URL::asset('assets/img/delete.png') }}">
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="text-center">
					<a href="/admin/kriteria/hapus/{{ $kriteria->id_kriteria }}">
						<button class="btn btn-center bg-brown-3 btn-rounded">Hapus Kriteria</button>
					</a>
				</div>
			</div>
		</div>
	</div>

	@include('admin/template/menu')
	@include('template/footer')