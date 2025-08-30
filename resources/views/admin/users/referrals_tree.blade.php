@extends('admin.layout.template')
@section('content')
<style>
    .node {
        display: inline-block;
        padding: 10px;
        border: 1px solid #ccc;
        margin: 5px;
        border-radius: 10px;
        cursor: pointer;
        position: relative;
    }
    .children {
        margin-left: 40px;
        display: none;
    }
    .tooltip-custom {
        position: absolute;
        background: #f7f7f7;
        border: 1px solid #999;
        padding: 8px;
        font-size: 12px;
        border-radius: 5px;
        top: 100%;
        left: 0;
        z-index: 100;
        display: none;
    }
</style>
<div class="card mb-3">
    <div class="card-body">
      <div class="row flex-between-center">
        <div class="col-md">
          <h5 class="mb-2 mb-md-0">Tree Structure</h5>
        </div>
        
      </div>
    </div>
</div>
<div class="row g-0">
    <div class="card mb-3">
        <div class="card-body pt-0">
            <input type="text" id="searchCode" placeholder="Enter referral code..." />

            <div id="treeContainer">
                @foreach ($users->whereNull('referral_by') as $user)
                    @include('admin.users.node', ['user' => $user, 'grouped' => $grouped])
                @endforeach
            </div>

        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.node').forEach(node => {
        node.addEventListener('click', function (e) {
            e.stopPropagation();
            const child = this.querySelector('.children');
            if (child) child.style.display = (child.style.display === 'block') ? 'none' : 'block';
        });

        node.addEventListener('mouseover', function () {
            const tooltip = this.querySelector('.tooltip-custom');
            if (tooltip) tooltip.style.display = 'block';
        });

        node.addEventListener('mouseout', function () {
            const tooltip = this.querySelector('.tooltip-custom');
            if (tooltip) tooltip.style.display = 'none';
        });
    });

    document.getElementById('searchCode').addEventListener('input', function () {
        let code = this.value.trim();
        if (code === '') return;
        document.querySelectorAll('.node').forEach(node => {
            let userCode = node.dataset.code;
            if (userCode === code) {
                node.scrollIntoView({ behavior: 'smooth', block: 'center' });
                node.style.border = '2px solid red';
                setTimeout(() => node.style.border = '', 2000);
            }
        });
    });
</script>
@endsection