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
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="d-grid">
            <button type="submit" class="btn btn-danger text-warning mx-4">Keluar</a>
        </div>
    </form>
</nav>