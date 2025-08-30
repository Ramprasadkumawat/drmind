@php
    $level1 = $grouped[$user->referral_code] ?? collect();
    $level2 = $level1->flatMap(fn($u) => $grouped[$u->referral_code] ?? collect());
    $level3 = $level2->flatMap(fn($u) => $grouped[$u->referral_code] ?? collect());
@endphp

<div class="node" data-code="{{ $user->referral_code }}">
    <strong>{{ $user->name }}</strong><br>
    <small>{{ $user->email }}</small><br>
    <small>ID: {{ $user->referral_code }}</small>

    <div class="tooltip-custom">
        Level 1: {{ $level1->count() }}<br>
        Level 2: {{ $level2->count() }}<br>
        Level 3: {{ $level3->count() }}
    </div>

    @if ($level1->count())
        <div class="children">
            @foreach ($level1 as $child)
                @include('admin.users.node', ['user' => $child, 'grouped' => $grouped])
            @endforeach
        </div>
    @endif
</div>
