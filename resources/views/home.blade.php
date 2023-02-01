<x-app-layout>
  <div class="d-flex">
    <div class="flex-grow-1">
      <h1 class="bg-primary text-white text-center"> SISTEM DISTRIBUSI TERBANGUN
      </h1>
      <div id="map-home" style="height: 480px">
        MAP
      </div>
    </div>
    <div>
      Graph
    </div>
  </div>
  <script>
    var map = L.map('map-home', {      
      gestureHandling: true,
    }).setView([-6.206203832426139, 106.89724677467433], 13);
    L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}',{
      maxZoom: 20,
      subdomains:['mt0','mt1','mt2','mt3'],
    }).addTo(map);
  </script>
</x-app-layout>