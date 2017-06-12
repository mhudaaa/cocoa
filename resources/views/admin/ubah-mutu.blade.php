@include('template/header')
<body class="bg-brown-5">
	<div canvas="container" class="bg-brown-5 row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-2 no-padding-left"></div>
				<div class="col-xs-8 text-center">
					<h6 class="title">Ubah Nilai Mutu</h6>						
				</div>
				<div class="col-xs-2 no-padding-right">
					<a href="/admin/penilaian"><img class="icon icon-right" src="{{ URL::asset('assets/img/close-3.png') }}"></a>
				</div>
			</div>

			<form method="post" action="/admin/penilaian/set/{{ $mutu->id_mutu }}" autocomplete="off">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-xs-12 konten">
						<table>
							<tbody>
								<tr class="left-all">
									<td class="text-brown bold">Mutu</td>
									<td>{{ $mutu->mutu }}</td>
								</tr>
								<tr class="left-all">
									<td class="text-brown bold">Nilai</td>
									<td><input type="number" name="nilaimutu" step=0.01 value="{{ $mutu->nilaimutu }}" required=""></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="text-center"><button class="btn btn-center bg-brown-3 btn-rounded" type="submit">Simpan</button></div>
			</form>
		</div>
	</div>
	
	@include('admin/template/menu')
	@include('template/footer')