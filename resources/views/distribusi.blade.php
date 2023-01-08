<x-app-layout>
  <div class="flex-column bg-white">
    <div>
      images
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nomor</th>
          <th scope="col">Nama</th>
          <th scope="col">Stan Awal</th>
          <th scope="col">Stan Akhir</th>
          <th scope="col">Pakai</th>
          <th scope="col">Meter Atasnya</th>
          <th scope="col">Merek</th>
          <th scope="col">Jml. Plg.</th>
          <th scope="col">Kubikai Plg.</th>
          <th scope="col">NRW Jar. Pembawa</th>
          <th scope="col">NRW Area</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $key => $value)
        <tr>
          <th scope="row">{{$key}}</th>
          <td>Nama</td>
          <td>{{$value['stan_awal']}}</td>
          <td>{{$value['stan_akhir']}}</td>
          <td>{{$value['pakai']}}</td>
          <td>Meter Atasnya</td>
          <td>Merek</td>
          <td>{{$value['jumlah_pelanggan']}}</td>
          <td>Kubikai</td>
          <td>NRW Jar. Pembawa</td>
          <td>NRW Area</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div>
      <button class="btn btn-primary">Unggah Data</button>
    </div>
  </div>
</x-app-layout>