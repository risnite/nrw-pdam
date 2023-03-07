<nav class="nav flex-column col-auto bg-success">
  <a class="nav-link d-flex align-items-center mt-5" aria-current="page" href="/dashboard">
    <i class="fa-solid fa-house fa-xl text-black col-3"></i>
    <div class="text-white">DASHBOARD</div>
  </a>
  <a class="nav-link d-flex align-items-center" href="/sebaran">
    <i class="fa-solid fa-map-location-dot fa-xl text-black col-3"></i>
    <div class="text-white">SEBARAN INSTRUMEN</div>
  </a>
  <a class="nav-link d-flex align-items-center" href="/instrumen">
    <i class="fa-solid fa-rectangle-list fa-xl text-black col-3"></i>
    <div class="text-white">DAFTAR INSTRUMEN</div>
  </a>
  <a class="nav-link d-flex align-items-center" href="/distribusi">
    <i class="fa-solid fa-sitemap fa-xl text-black col-3"></i>
    <div class="text-white">SISTEM DISTRIBUSI</div>
  </a>
  <a class="nav-link d-flex align-items-center" href="/tekanan">
    <i class="fa-solid fa-magnifying-glass fa-xl text-black col-3"></i>
    <div class="text-white">PANTAU TEKANAN</div>
  </a>
  {{-- <div class="nav-link">
    <button class="accordion-button d-flex justify-content-center mb-3" type="button" data-bs-toggle="collapse"
      data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <i class="fa-solid fa-map fa-xl text-black col-3"></i>
      <div class="text-white">PETA</div>
    </button>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
      data-bs-parent="#accordionExample">
      <div class="flex-column">
        <a href="/peta/ipa" class="nav-link text-white">IPA</a>
        <a href="/peta/pc" class="nav-link text-white">PC</a>
        <a href="/peta/dma" class="nav-link text-white">DMA</a>
      </div>
    </div>
  </div> --}}
  @if (Auth::check())
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <div class="d-grid">
        <button type="submit" class="btn btn-danger text-warning mx-4">Keluar</a>
      </div>
    </form>
  @endif
</nav>
