<x-app-layout>
  <div class="flex-column bg-white">
    <div>
      Data Opname Meter Induk
      <select name="" id="tahun">
        @foreach ($data['tahun'] as $tahun)
          <option value="{{ $tahun }}">{{ $tahun }}</option>
        @endforeach
      </select>
      <select name="" id="bulan">
        @foreach ($data['bulan'] as $bulan => $namaBulan)
          <option value="{{ $bulan }}">{{ $namaBulan }}</option>
        @endforeach
      </select>
    </div>
    <div>
      images
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="col-1">Nomor</th>
          <th class="col-1">Nama</th>
          <th class="col-1">Stan Awal</th>
          <th class="col-1">Stan Akhir</th>
          <th class="col-1">Pakai</th>
          <th class="col-1">Meter Atasnya</th>
          <th class="col-1">Merek</th>
          <th class="col-1">Jml. Plg.</th>
          <th class="col-1">Kubikai Plg.</th>
          <th class="col-1">NRW Jar. Pembawa</th>
          <th class="col-1">NRW Area</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $data['nomor'] }}</td>
          <td>{{ $data['nama'] }}</td>
          <td id="stan-awal">
            {{-- {{$data['total_stan_awal']}} --}}
          </td>
          <td id="stan-akhir">
            {{-- {{$data['total_stan_akhir']}} --}}
          </td>
          <td id="pakai">
            {{-- {{$data['pakai']}} --}}
          </td>
          <td>{{ $data['meter_atasnya'] }}</td>
          <td>Merek</td>
          <td id="pelanggan">
            {{-- {{ $data['jumlah_pelanggan'] }} --}}
          </td>
          <td id="kubik">
            {{-- {{$data['total_kubik']}} --}}
          </td>
          <td>{{ $data['nrw_jaringan'] }}</td>
          <td>{{ $data['nrw_area'] }}</td>
        </tr>
      </tbody>
    </table>
    <div>
      <button class="btn btn-primary">Unggah Data</button>
    </div>
  </div>
</x-app-layout>

<script>
  $(document).ready(function() {
    const nomor = {{ $data['nomor'] }};
    let tahun = $("#tahun").val();
    let bulan = $("#bulan").val();

    function ajaxCall() {
      jQuery.ajax({
        url: '/api/distribusi/' + nomor,
        type: "GET",
        data: {
          "tahun": tahun,
          "bulan": bulan
        },
        dataType: "json",
        beforeSend: function() {
          $("#stan-awal").html('Mengambil data...');
          $("#stan-akhir").html('Mengambil data...');
          $("#pakai").html('Mengambil data...');
          $("#pelanggan").html('Mengambil data...');
          $("#kubik").html('Mengambil data...');
        },
        success: function(response) {
          if (response.total_stan_awal) {
            $("#stan-awal").html(response.total_stan_awal);
          } else {
            $("#stan-awal").html('Data tidak ditemukan');
          }
          if (response.total_stan_akhir) {
            $("#stan-akhir").html(response.total_stan_akhir);
          } else {
            $("#stan-akhir").html('Data tidak ditemukan');
          }
          if (response.pakai) {
            $("#pakai").html(response.pakai);
          } else {
            $("#pakai").html('Data tidak ditemukan');
          }
          if (response.jumlah_pel) {
            $("#pelanggan").html(response.jumlah_pel);
          } else {
            $("#pelanggan").html('Data tidak ditemukan');
          }
          if (response.total_kubik) {
            $("#kubik").html(response.total_kubik);
          } else {
            $("#kubik").html('Data tidak ditemukan');
          }
        },
        error: function() {
          $("#stan-awal").html('Data error');
          $("#stan-akhir").html('Data error');
          $("#pakai").html('Data error');
          $("#kubik").html('Data error');
        }
      })
    }
    $("#tahun").on("change", function() {
      tahun = $(this).val();
      ajaxCall();
    })
    $("#bulan").on("change", function() {
      bulan = $(this).val();
      ajaxCall();
    })
    ajaxCall();
  })
</script>
