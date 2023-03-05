<x-app-layout>
  <div class="row">
    <div class="col-3">
      <div class="row">
        <form class="row g-3">
          <div>Peta IPA</div>
          <div class="col-12">
            <label for="inputEmail4" class="form-label">Kode Instrumen</label>
            <input type="email" class="form-control" id="kode-instrumen">
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label">Nama Instrumen</label>
            <input type="text" class="form-control" id="nama-instrumen">
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label">Tipe Instrumen</label>
            <select name="" id="" class="form-select">
              <option value="Pressure">Pressure</option>
              <option value="Meter & Pressure">Meter & Pressure</option>
            </select>
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label">Alamat Instrumen</label>
            <textarea type="text" class="form-control" id="alamat-instrumen" style="height: 100px"></textarea>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Kode Instrumen</th>
              <th scope="col">Nama Instrumen</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
              <tr id="table-instrumen">
                <td id="table-kode">{{ $item['kode_instrumen'] }}</td>
                <td id="table-nama">{{ $item['nama_instrumen'] }}</td>
                <td id="table-polygon" hidden>{{ $item['polygon'] }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-9">
      <div id="map-home" class="h-100" style="height:80vh">
        MAP
      </div>
    </div>
  </div>
  <script src="{{ asset('assets') }}/js/map.js"></script>
</x-app-layout>
<script>
  // create map
  var map = L.map('map-home', {
    gestureHandling: true,
  }).setView([-6.181236, 106.905979], 13);
  // add map url
  L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
  }).addTo(map);
  // draw
  var drawnItems = new L.FeatureGroup();
  map.addLayer(drawnItems);
  var drawControl = new L.Control.Draw({
    draw: {
      polyline: false,
      rectangle: false,
      circle: false,
      marker: false,
      circlemarker: false,
    },
    edit: {
      featureGroup: drawnItems
    }
  });
  map.addControl(drawControl);
  // draw polygon
  var latlngs = JSON.parse($("#table-polygon").html());
  var polygon = L.polygon(latlngs).addTo(drawnItems);
  // draw event
  map.on('draw:created', function(e) {
    var type = e.layerType,
      layer = e.layer;
    // Do whatever else you need to. (save to db; add to map etc)
    let latLng = layer.getLatLngs();
    console.log(JSON.stringify(latLng));
    drawnItems.addLayer(layer);
  });

  // get data
  const data = {!! $data !!};
  data.forEach(instrument => {
    console.log(instrument);
    if (instrument['lat'] && instrument['long']) {
      if (instrument['nama_instrumen'].includes("PC") && instrument['nama_instrumen'].includes("DMA")) {
        // set marker icon
        var myIcon = L.divIcon({
          className: 'fa-solid fa-hand-holding-droplet text-warning'
        });
        // add marker
        L.marker([instrument['lat'], instrument['long']], {
          icon: myIcon
        }).addTo(map);
      }
    }
  });
</script>
<script>
  $(document).ready(function() {
    $("#table-kode").click(function() {
      console.log($(this).html());
      $("#kode-instrumen").val($(this).html());
      $("#nama-instrumen").val($("#table-nama").html());
    });
    $("#table-nama").click(function() {
      console.log($(this).html());
      $("#kode-instrumen").val($("#table-kode").html());
      $("#nama-instrumen").val($(this).html());
    });
  });
</script>
