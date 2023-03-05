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
      {{-- pie chart --}}
      <div class="border border-dark py-2" style="background-image: linear-gradient(white, silver); height:180px">
        <canvas id="pieChart"></canvas>
      </div>
      <div class="my-5">
        <div class="bg-info mb-1 px-2 py-1 border border-dark fs-5">
          <i class="fa-solid fa-location-dot text-success"></i>
          : FLOW & PRESSURE
        </div>
        <div class="bg-info mb-1 px-2 py-1 border border-dark fs-5">
          <i class="fa-solid fa-location-dot text-danger"></i>
          : PRESSURE
        </div>
      </div>
      {{-- bar chart --}}
      <div class="border border-dark px-2" style="background-image: linear-gradient(white, silver); height:200px">
        <canvas id="barChart"></canvas>
      </div>
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
  {{-- script chartjs --}}
  <script>
    // get data
    var ipa = [];
    var rayon = [];
    var pc = [];
    var dma = [];
    data.forEach(instrumen => {
      // filter ipa
      if (instrumen['kode_rayon'] == null) {
        ipa.push(instrumen);
      }
      // filter rayon
      if (instrumen['kode_rayon'] && instrumen['kode_pc'] == null) {
        rayon.push(instrumen);
      }
      // filter pc
      if (instrumen['kode_pc'] && instrumen['kode_dma'] == null) {
        pc.push(instrumen);
      }
      // filter dma
      if (instrumen['kode_dma']) {
        dma.push(instrumen);
      }
    });
    // chartjs global
    Chart.defaults.font.size = 10;
    Chart.defaults.plugins.tooltip.enabled = false;
    Chart.register(ChartDataLabels);
    // pie chart vars
    let pieMP = 0;
    let pieP = 0;
    data.forEach(instrumen => {
      if (instrumen['tipe_instrumen'] == 'Meter & Pressure') {
        pieMP += 1;
      }
      if (instrumen['tipe_instrumen'] == 'Pressure') {
        pieP += 1;
      }
    });
    // pie chart
    const pieChart = document.getElementById('pieChart');
    new Chart(pieChart, {
      type: 'pie',
      options: {
        maintainAspectRatio: false,
        borderWidth: 0,
        plugins: {
          legend: {
            position: 'right',
            labels: {
              boxWidth: 8,
              boxHeight: 8
            }
          },
          datalabels: {
            backgroundColor: 'dimgray',
            color: 'white'
          }
        }
      },
      data: {
        labels: [
          'Meter & Pressure',
          'Pressure'
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [pieMP, pieP],
          backgroundColor: [
            'royalblue',
            'darkorange'
          ],
          hoverOffset: 4
        }],
      }
    })
    // bar chart
    const barChart = document.getElementById('barChart');
    let rayonName = [];
    let barMP = [];
    let barP = [];
    let i = 0;
    rayon.forEach(rayon => {
      rayonName.push(rayon['nama_instrumen']);
      barMP[i] = 0;
      barP[i] = 0;
      data.forEach(instrumen => {
        if (instrumen['kode_rayon'] == rayon['kode_rayon']) {
          if (instrumen['tipe_instrumen'] == 'Meter & Pressure') {
            barMP[i] += 1;
          }
          if (instrumen['tipe_instrumen'] == 'Pressure') {
            barP[i] += 1;
          }
        }
      });
      console.log(barMP[i]);
      console.log(barP[i]);
      i++
    });
    const barLabels = rayonName.map(function(label) {
      return label.split(" ");
    });
    console.log(rayon);
    console.log(barLabels);
    console.log(barMP);
    console.log(barP);
    new Chart(barChart, {
      type: 'bar',
      data: {
        labels: barLabels,
        datasets: [{
            label: 'Meter & Pressure',
            data: barMP,
            borderWidth: 1,
            backgroundColor: 'royalblue'
          },
          {
            label: 'Pressure',
            data: barP,
            borderWidth: 1,
            backgroundColor: 'darkorange'

          }
        ]
      },
      options: {
        layout: {
          padding: {
            top: 5
          }
        },
        maintainAspectRatio: false,
        plugins: {
          datalabels: {
            color: 'white'
          },
          legend: {
            position: 'bottom',
            labels: {
              boxWidth: 8,
              boxHeight: 8
            }
          }
        },
        scales: {
          y: {
            display: false
          }
        }
      }
    });
  </script>
</x-app-layout>
