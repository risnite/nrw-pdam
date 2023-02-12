<x-app-layout>
  <div class="d-flex">
    <div class="flex-grow-1">
      <h1 class="bg-primary text-white text-center"> SISTEM DISTRIBUSI TERBANGUN
      </h1>
      <div id="map-home" style="height: 480px">
        MAP
      </div>
    </div>
    <div class="ms-3">
      <div>Graph</div>
      <div class="bg-info mb-1 px-2 py-1 border border-dark fs-5">
        <i class="fa-solid fa-location-dot text-success"></i>
        : FLOW & PRESSURE
      </div>
      <div class="bg-info mb-1 px-2 py-1 border border-dark fs-5">
        <i class="fa-solid fa-location-dot text-danger"></i>
        : PRESSURE
      </div>
      <div>Another graph</div>
    </div>
  </div>
  <script>
    // create map
    var map = L.map('map-home', {
      gestureHandling: true,
    }).setView([-6.181236, 106.905979], 13);
    // add map url
    L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    }).addTo(map);
    // get data
    const data = {!! $data !!};
    data.forEach(instrument => {
      if (instrument['lat'] && instrument['long']) {
        // set marker icon
        if (instrument['tipe_instrumen'] == 'Meter & Pressure') {
          var myIcon = L.divIcon({
            className: 'fa-solid fa-location-dot text-success fs-5'
          });
        }
        if (instrument['tipe_instrumen'] == 'Pressure') {
          var myIcon = L.divIcon({
            className: 'fa-solid fa-location-dot text-danger fs-5'
          });
        }
        // add marker
        L.marker([instrument['lat'], instrument['long']], {
          icon: myIcon
        }).addTo(map);
      }
    });
  </script>
</x-app-layout>
