<x-app-layout>
  <div class="d-flex me-3">
    {{-- left-side --}}
    <div class="flex-grow-1">
      <h1 class="bg-primary text-white text-center"> SISTEM DISTRIBUSI TERBANGUN
      </h1>
      <div id="map-home" style="min-height: 540px">
        MAP
      </div>
    </div>
    {{-- right-side --}}
    <div class="ms-3">
      {{-- pie chart --}}
      <div class="border border-dark mb-3 py-2" style="background-image: linear-gradient(white, silver); height:180px">
        <canvas id="pieChart"></canvas>
      </div>
      {{-- bar chart --}}
      <div class="border border-dark px-2 mb-3" style="background-image: linear-gradient(white, silver); height:200px">
        <canvas id="barChart"></canvas>
      </div>
      {{-- instruments icon --}}
      <div class="fw-semibold">
        <div class="border border-dark p-2 mb-1 bg-info"><i
            class="fa-solid fa-hand-holding-droplet fa-fw text-warning"></i> :
          DMA
        </div>
        <div class="border border-dark p-2 mb-1 bg-info"><i class="fa-solid fa-droplet fa-fw text-success"></i> :
          PRIMARY CELLS
        </div>
        <div class="border border-dark p-2 mb-1 bg-info"><i class="fa-solid fa-location-dot fa-fw text-danger"></i> :
          RAYON
        </div>
        <div class="border border-dark p-2 mb-1 bg-info"><i class="fa-regular fa-circle-dot fa-fw text-primary"></i> :
          IPA</div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets') }}/js/map.js"></script>
  {{-- script leafletjs --}}
  <script>
    var data = {!! $data !!}
    // create map
    var map = L.map('map-home', {
      gestureHandling: true,
    }).setView([-6.181236, 106.905979], 13);
    // add map url
    L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    }).addTo(map);
    // put markers
    data.forEach(instrumen => {
      if (instrumen['lat'] && instrumen['long']) {
        if (instrumen['kode_dma']) {
          // set marker icon for dma
          var myIcon = L.divIcon({
            className: 'fa-solid fa-hand-holding-droplet text-warning'
          });
          // add marker
          L.marker([instrumen['lat'], instrumen['long']], {
            icon: myIcon
          }).addTo(map);
        }
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
