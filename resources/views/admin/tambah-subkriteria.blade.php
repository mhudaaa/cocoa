@include('template/header')
<body class="bg-brown-5">
	<div canvas="container" class="bg-brown-5 row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-2 no-padding-left"></div>
				<div class="col-xs-8 text-center">
					<h6 class="title">Tambah Subriteria</h6>						
				</div>
				<div class="col-xs-2 no-padding-right">
					<a href="/admin/subkriteria/get/{{ $kriteria->id_kriteria }}"><img class="icon icon-right" src="{{ URL::asset('assets/img/close-3.png') }}"></a>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 no-padding-left">
					<small>Kriteria : {{ $kriteria->kriteria }}</small>
				</div>
			</div>
			<div class="xs-divider"></div>

			<form method="post" action="/admin/subkriteria/set" autocomplete="off">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-xs-12 konten">
						<table>
							<tbody>
								<tr>
									<td class="left text-brown bold">Subkriteria</td>
									<input type="hidden" name="id_kriteria" value="{{ $kriteria->id_kriteria }}">
									<td class="text-right"><input type="text" name="subkriteria" required=""></td>
								</tr>
								<tr>
									<td class="left text-brown bold">Utility</td>
									<td class="text-right"><input type="number" min="0" name="utility" required=""></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<input type="hidden" name="id_kriteria" value="{{ $kriteria->id_kriteria}}">
				<div class="text-center"><button class="btn btn-center bg-brown-3 btn-rounded" type="submit">Tambah</button></div>
			</form>
		</div>
	</div>
	
	@include('admin/template/menu')
	@include('template/footer')