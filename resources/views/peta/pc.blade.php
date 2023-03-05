<x-app-layout>
  <a href="/peta/pc" class="nav-link fw-bold">PC</a>
  <div class="row">
    <div class="col-3">
      <div class="row">
        <form class="row g-3 mb-4">
          <div class="col-12">
            <label for="kode-pc" class="form-label">Kode PC</label>
            <input type="email" class="form-control" id="kode-pc">
          </div>
          <div class="col-12">
            <label for="nama-instrumen" class="form-label">Nama Instrumen</label>
            <input type="text" class="form-control" id="nama-instrumen">
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
        <table class="table table-striped table-sm fs-6">
          <thead>
            <tr style="pointer-events: none">
              <th>Kode Instrumen</th>
              <th>Nama Instrumen</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pagination as $item)
              <tr style="cursor: pointer">
                <td>{{ $item['kode_instrumen'] }}</td>
                <td class="nama-instrumen">{{ $item['nama_instrumen'] }}</td>
                <td class="kode-pc" hidden>{{ $item['kode_pc'] }}</td>
                <td class="polygon" hidden>{{ $item['polygon'] }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $pagination->links() }}
      </div>
    </div>
    <div class="col-9">
      <div id="map-home" style="height:80vh">
        MAP
      </div>
    </div>
  </div>
  <script src="{{ asset('assets') }}/js/map.js"></script>
</x-app-layout>
<script>
  var pc26070 = [
    [{
        "lat": -6.194843,
        "lng": 106.972441
      },
      {
        "lat": -6.190149,
        "lng": 106.964976
      },
      {
        "lat": -6.187845,
        "lng": 106.955452
      },
      {
        "lat": -6.184518,
        "lng": 106.946615
      },
      {
        "lat": -6.180166,
        "lng": 106.947816
      },
      {
        "lat": -6.165403,
        "lng": 106.944384
      },
      {
        "lat": -6.152517,
        "lng": 106.942325
      },
      {
        "lat": -6.151493,
        "lng": 106.950562
      },
      {
        "lat": -6.144496,
        "lng": 106.956568
      },
      {
        "lat": -6.144581,
        "lng": 106.962231
      },
      {
        "lat": -6.163184,
        "lng": 106.969524
      },
      {
        "lat": -6.17991,
        "lng": 106.972956
      }
    ]
  ];
  console.log(JSON.stringify(pc26070));
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

  // draw event
  map.on('draw:created', function(e) {
    var type = e.layerType,
      layer = e.layer;
    // Do whatever else you need to. (save to db; add to map etc)
    let latLng = layer.getLatLngs();
    console.log(JSON.stringify(latLng));
    drawnItems.addLayer(layer);
  });
  // draw all polygons
  var multiPolygon = [];
  var data = {!! $data !!};
  data.forEach(function(pc) {
    // console.log(pc['polygon']);
    if (pc['polygon'] != null) {
      // draw polygon
      let latlngs = JSON.parse(pc['polygon']);
      multiPolygon.push(latlngs);
    }
  });
  var polygon = L.polygon(multiPolygon).addTo(drawnItems);
  map.fitBounds(polygon.getBounds());

  $(document).ready(function() {


    // fn for each click
    $("tr").click(function() {
      drawnItems.clearLayers();
      $("tr").removeClass("selected");
      console.log($(this).html());
      $("#kode-pc").val($(this).children(".kode-pc").html());
      $("#nama-instrumen").val($(this).children(".nama-instrumen").html());
      // draw polygon
      let latlngs = JSON.parse($(this).children(".polygon").html());
      let polygon = L.polygon(latlngs).addTo(drawnItems);
      map.fitBounds(polygon.getBounds());
      $(this).addClass("selected");
    });
  });
</script>
