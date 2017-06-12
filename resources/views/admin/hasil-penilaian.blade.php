@include('template/header')
<body class="bg-soft-brown">
	<div canvas="container" class="bg-soft-brown row">
		<div class="col-xs-10 col-xs-offset-1">
			<div id="header" class="row">
				<div class="col-xs-8 col-xs-offset-2 text-center">
					<h6 class="title text-brown">Hasil Penilaian</h6>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 konten with-title">
					<div class="title text-center bg-brown-3">
						Nilai Mutu
					</div>
					<table>
						<thead>
							<th class="left">Data Sampel</th>
							<th width="100px">Hasil</th>
						</thead>
						<tbody>
							<? $no = 0; ?>
							@foreach (Session::get('mutu') as $no=>$mutu)
							<tr>
								<td class="left">Data {{ ++$no }}</td>
								<td>{{ $mutu }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<hr>
					<table>
						<thead>
							<th colspan="2">Hasil Perangkingan</th>
						</thead>
						<tbody>
							@foreach (Session::get('sortdmutu') as $no=>$sortdmutu)
							<tr>
								<td class="left">Mutu {{ ++$no }}</td>
								<td>{{ $sortdmutu }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>						
			<div class="row">
				<div class="col-xs-12 text-center">
					<!-- <div class="xs-divider"></div> -->
					<a href="/admin/penilaian">
						<button class="btn btn-center bg-brown-2 btn-rounded">Ok</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	@include('admin/template/menu')
	@include('template/footer')