@props([
    'title' => ''
])

<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <hr>
        <div class="table-responsive">
            {{ $slot }}
        </div>
    </div>
</div>