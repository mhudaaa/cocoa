@include('template/header')
<body class="bg-soft-brown">
	<div canvas="container" class="bg-soft-brown row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-2 no-padding-left">
					<a href="/penguji/mutu-panen"><img class="icon icon-left" src="{{ URL::asset('assets/img/back.png') }}"></a>
				</div>
				<div class="col-xs-8 text-center">
					<h6 class="title text-brown">Rincian Mutu Panen</h6>						
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 konten with-title">
					<div class="title text-center bg-brown-3">
						{{ date('M, d Y', strtotime($panen->tgl_uji)) }}
					</div>
					<table>
						<tbody>
							<tr>
								<td class="left"><b>Berat</b></td>
								<td class="text-right">{{ $panen->berat }} Kg</td>
							</tr>
						</tbody>
					</table>
					<hr>
					<table>
						<thead>
							<th class="left">Kriteria</th>
							<th class="text-right">Utility</th>
						</thead>
						<tbody>
							@for($i = 0; $i < $jmlKriteria; $i++)
							<tr>
								<td class="left">{{ $rincian[$i]->kriteria->kriteria }}</td>
								<td class="text-right">{{ $rincian[$i]->utility }}</td>
							</tr>
							@endfor
						</tbody>
					</table>
					<hr>
					<table>
						<tbody>
							<tr>
								<td class="left"><b>Hasil Pengujian :</b></td>
								<td class="text-right"><b>Mutu {{ $panen->mutu }}</b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<br>
			<a href="/penguji/mutu-panen/hapus/{{ $panen->id_panen }}">
				<button class="btn btn-danger">Hapus Data</button>
			</a>
		</div>
	</div>
	@include('penguji/template/menu')
	@include('template/footer')