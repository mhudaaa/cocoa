@include('template/header')
<body class="bg-soft-brown">
	<div canvas="container" class="bg-soft-brown row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-2 no-padding-left">
					<img class="icon icon-left js-toggle-left-slidebar" src="{{ URL::asset('assets/img/menu.png') }}">
				</div>
				<div class="col-xs-8 text-center">
					<h6 class="title text-brown">Beranda</h6>						
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 konten with-title">
					<div class="title text-center bg-brown-3">
						Kriteria
					</div>
					<table>
						<thead>
							<th class="left">Kriteria</th>
							<th>Nilai</th>
							<th class="text-right">Bobot</th>
						</thead>
						<tbody>
							<? $no = 0 ?>
							@foreach($kriterias as $no=>$kriteria)
							<tr>
								<td class="left">{{ $kriteria->kriteria }}</td>
								<td>{{ $kriteria->nilai }}</td>
								<td class="text-right">{{ substr($kriteria->bobot, 0, 6) }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<a href="/admin/kriteria"><p class="text-right">Lihat semua</p></a>
			</div>

			<div class="md-divider"></div>

			<div class="row">
				<div class="col-xs-12 konten with-title">
					<div class="title text-center bg-brown-3">
						Penilaian Mutu
					</div>
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
							<tr>
								<td>{{ ++$no }}</td>
								<td>{{ date('M, d Y', strtotime($panen->tgl_uji)) }}</td>
								<td>{{ $panen->berat }}kg</td>
								<td>{{ $panen->mutu }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<a href="/admin/mutu-panen"><p class="text-right">Lihat semua</p></a>
			</div>
		</div>
	</div>

	@include('admin/template/menu')
	@include('template/footer')
