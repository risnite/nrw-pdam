<x-app-layout>
  <div class="flex-column bg-white">
    <div>
      images
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>NO. URUT</th>
          <th>KD. INSTRUMENT</th>
          <th>NAMA INSTRUMENT</th>
          <th>ALAMAT INSTRUMENT</th>
          <th>INFLOW</th>
          <th>INSTR ATASNYA</th>
          <th>JUM PELANGGAN</th>
          <th>KUBIKASE</th>
          <th>RATA-RATA</th>
          <th>NRW JARINGAN</th>
          <th>NRW AREA</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $entry)
          <tr>
            <td>{{ $entry['no_urut'] }}</td>
            <td>{{ $entry['kode_instrument'] }}</td>
            <td>{{ $entry['nama_instrument'] }}</td>
            <td>{{ $entry['alamat_instrument'] }}</td>
            <td>{{ $entry['inflow'] }}</td>
            <td>{{ $entry['instrument_atasnya'] }}</td>
            <td>{{ $entry['jumlah_pelanggan'] }}</td>
            <td>{{ $entry['kubikase'] }}</td>
            <td>{{ $entry['rata_rata'] }}</td>
            <td>{{ $entry['nrw_jaringan'] }}</td>
            <td>{{ $entry['nrw_area'] }}</td>
            <td>
              <form action="/distribusi/{{ $entry['kode_instrument'] }}" method="GET">
                <input type="hidden" name="nama_instrument" value="{{ $entry['nama_instrument'] }}">
                <input type="hidden" name="nrw_jaringan" value="{{ $entry['nrw_jaringan'] }}">
                <input type="hidden" name="nrw_area" value="{{ $entry['nrw_area'] }}">
                <button type="submit" style="border: none;background:none">
                  <i class="fa-solid fa-database"></i>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div>
      <button class="btn btn-primary">Unggah Data</button>
    </div>
  </div>
</x-app-layout>
