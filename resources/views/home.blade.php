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
        <i class="fa-solid fa-hand-holding-droplet text-warning"></i>
        : DMA
      </div>
      <div>Another graph</div>
    </div>
  </div>
  <script src="{{ asset('assets') }}/js/map.js"></script>
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
</x-app-layout>
