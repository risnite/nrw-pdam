<x-app-layout>
  <div class=" bg-white">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">NO. URUT</th>
          <th scope="col">KD. INSTRUMEN</th>
          <th scope="col">NAMA INSTRUMEN</th>
          <th scope="col">TIPE INSTRUMEN</th>
          <th scope="col">ALAMAT INSTRUMEN</th>
          <th scope="col">TAHUN PASANG</th>
          <th scope="col">KODE IPA</th>
          <th scope="col">KD. RAYON</th>
          <th scope="col">KD. DMA</th>
          <th scope="col">LONG</th>
          <th scope="col">LAT</th>
          <th scope="col">LINK</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
          <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['kode_instrumen'] }}</td>
            <td>{{ $item['nama_instrumen'] }}</td>
            <td>{{ $item['tipe_instrumen'] }}</td>
            <td>{{ $item['alamat_instrumen'] }}</td>
            <td>{{ $item['tahun_pasang'] }}</td>
            <td>{{ $item['kode_ipa'] }}</td>
            <td>{{ $item['kode_rayon'] }}</td>
            <td>{{ $item['kode_dma'] }}</td>
            <td>{{ $item['long'] ? $item['long'] : '-' }}</td>
            <td>{{ $item['lat'] ? $item['lat'] : '-' }}</td>
            <td>{{ $item['link'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</x-app-layout>
