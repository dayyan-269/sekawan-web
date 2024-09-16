<div class="py-3 d-flex flex-row justify-content-center">
    <div class="d-none d-lg-flex">
        @if (request()->cookie('role') === 'admin')
        <x-sidebar.admin />
        @else
        <x-sidebar.supervisor />
        @endif
    </div>
    <div class="py-3 px-3 w-100 w-lg-75 container">
        {{ $slot }}
    </div>
</div>