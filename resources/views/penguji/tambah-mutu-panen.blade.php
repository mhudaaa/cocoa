@include('template/header')
<body class="bg-soft-brown">
	<div canvas="container" class="bg-soft-brown row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-2 no-padding-left"></div>
				<div class="col-xs-8 text-center">
					<h6 class="title text-brown">Tambah Mutu Panen</h6>						
				</div>
				<div class="col-xs-2 no-padding-right">
					<a href="/penguji/mutu-panen "><img class="icon icon-right" src="{{ URL::asset('assets/img/close.png') }}"></a>
				</div>
			</div>

			<form method="post" action="/penguji/mutu-panen/set" autocomplete="off">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-xs-12 konten with-title">
						<div class="title text-center bg-brown-3">
							{{ date('M, d Y') }}
						</div>
						<table>
							<tbody>
								<tr class="left-all">
									<td>Berat</td>
									<td width="80px"><input type="number" name="berat" required=""> Kg</td>
								</tr>
							</tbody>
						</table>
						<br>
						<table>
							<thead>
								<th class="left">Kriteria</th>
								<th width="100px">Hasil</th>
							</thead>
							<tbody>
								@foreach($kriterias as $kriteria)
								<tr class="left-all">
									<td>{{ $kriteria->kriteria }}</td>
									<td>
										<select name="{{ $kriteria->id_kriteria }}" required="">
											<option value="" disabled="" selected="">Pilih Nilai</option>
											@foreach($subs as $sub)
											@if($kriteria->id_kriteria == $sub->id_kriteria)
											<option value="{{ $sub->utility }}">{{ $sub->subkriteria }}</option>
											@endif
											@endforeach
										</select>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="text-center"><button class="btn btn-center bg-brown-2 btn-rounded" type="submit">Simpan</button></div>
			</form>
		</div>
	</div>
	@include('penguji/template/menu')
	@include('template/footer')