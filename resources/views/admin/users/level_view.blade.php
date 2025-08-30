@extends('admin.layout.template')
<style>
ul.tree, ul.tree ul {
    list-style-type: none;
    position: relative;
    padding-left: 1rem;
}

ul.tree ul {
    margin-left: 1.2rem;
}

ul.tree li {
    margin: 0;
    padding: 0 0 0 1.5rem;
    line-height: 1.8rem;
    position: relative;
}

ul.tree li::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    border-left: 1px solid #ccc;
    bottom: 0;
}

ul.tree li::after {
    content: '';
    position: absolute;
    top: 0.9rem;
    left: 0;
    width: 1.5rem;
    border-top: 1px solid #ccc;
}

ul.tree li:last-child::before {
    height: 0.9rem;
}

</style>
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-md">
                <h5 class="mb-2 mb-md-0">Referral Hierarchy</h5>
            </div>
        </div>
    </div>
</div>

<div class="row g-0">
    <div class="card mb-3">
        <div class="card-body pt-0">
            <h5 class="mb-3">
                👤 {{ $rootUser->name }} ({{ $rootUser->email }})
            </h5>
            <p><strong>Referral Code:</strong> {{ $rootUser->referral_code }}</p>

            <ul class="tree">
                @php
                function renderReferralTree($grouped, $referralCode, $level = 1) {
                    if ($level > 3 || !isset($grouped[$referralCode])) return;

                    echo '<ul>';
                    foreach ($grouped[$referralCode] as $user) {
                        echo '<li>';
                        echo '<span>👤 ' . $user->name . ' <small>(' . $user->email . ')</small></span>';
                        renderReferralTree($grouped, $user->referral_code, $level + 1);
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                @endphp

                <li>
                    <span>👤 {{ $rootUser->name }} <small>({{ $rootUser->email }})</small></span>
                    @php renderReferralTree($grouped, $rootUser->referral_code); @endphp
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection