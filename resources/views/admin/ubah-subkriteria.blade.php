@include('template/header')
<body class="bg-brown-3">
	<div canvas="container" class="bg-brown-3 shadow row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-2 no-padding-left"></div>
				<div class="col-xs-8 text-center">
					<h6 class="title">Ubah Subkriteria</h6>						
				</div>
				<div class="col-xs-2 no-padding-right">
					<a href="/admin/subkriteria/get/{{ $subkriteria->id_kriteria }}"><img class="icon icon-right" src="{{ URL::asset('assets/img/close-2.png') }}"></a>
				</div>
			</div>

			<form method="post" action="/admin/subkriteria/setUpdate/{{ $subkriteria->id_subkriteria }}" autocomplete="off">
				<input type="hidden" name="id_kriteria" value="{{ $subkriteria->id_kriteria }}">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-xs-12 konten">
						<table>
							<tbody>
								<tr class="left-all">
									<td class="text-brown bold">Subkriteria</td>
									<td><input type="text" name="subkriteria" value="{{ $subkriteria->subkriteria }}"></td>
								</tr>
								<tr class="left-all">
									<td class="text-brown bold">Utility</td>
									<td><input type="number" step="0.01" name="utility" value="{{ $subkriteria->utility }}" required=""></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="text-center"><button class="btn btn-center shadow bg-brown-2 btn-rounded" type="submit">Simpan</button></div>
			</form>
		</div>
	</div>
	
	@include('admin/template/menu')
	@include('template/footer')