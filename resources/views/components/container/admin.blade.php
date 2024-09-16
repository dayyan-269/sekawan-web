<div class="py-3 d-flex flex-row justify-content-center">
    @if (request()->cookie('role') === 'admin')
        <x-sidebar.admin />
    @else
        <x-sidebar.supervisor/>
    @endif
<div class="py-3 px-3 w-75 container">
        {{ $slot }}
    </div>
</div>