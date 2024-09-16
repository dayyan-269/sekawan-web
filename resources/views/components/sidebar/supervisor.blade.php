<nav class="sidebar bg-primary card d-flex flex-column me-3 shadow-lg">
    <div class="card-body">
        <a href="#" class="h6 text-bold text-white text-center">Supervisor Dashboard</a>
        <hr class="bg-white">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row align-items-center text-white">
                <i class="fas fa-home me-4"></i>
                <a href="{{ route('supervisor.home') }}" class="mb-0 menu">Home</a>
            </div>
            <div class="d-flex flex-row align-items-center text-white mt-3">
                <i class="fas fa-sticky-note me-4"></i>
                <a href="{{ route('supervisor.approval.index') }}" class="mb-0 menu">Pengiriman</a>
            </div>
            <hr class="bg-white">
            <div class="d-flex flex-row align-items-center text-white mt-auto">
                <i class="fas fa-arrow-left me-4"></i>
                <a href="{{ route('auth.logout') }}" class="mb-0 menu">Logout</a>
            </div>
        </div>
    </div>
</nav>