<li class="treeview-list-item">
    <a data-bs-toggle="collapse" href="#treeviewExample-{{ $node['id'] }}" role="button" aria-expanded="false">
        <p class="treeview-text">
            <span class="me-2 fas fa-folder text-primary"></span>
            {{ $node['name'] }}
        </p>
    </a>

    <ul class="collapse treeview-list" id="treeviewExample-{{ $node['id'] }}" data-show="false">
        <li class="treeview-list-item">
            <div class="treeview-item">
                <p class="treeview-text">
                    <span class="me-2 fas fa-user text-info"></span>
                    <strong>Name:</strong> {{ $node['name'] }}
                </p>
            </div>
        </li>
        <li class="treeview-list-item">
            <div class="treeview-item">
                <p class="treeview-text">
                    <span class="me-2 fas fa-link text-success"></span>
                    <strong>Referral Code:</strong> {{ $node['referral_code'] }}
                </p>
            </div>
        </li>
        <li class="treeview-list-item">
            <div class="treeview-item">
                <p class="treeview-text">
                    <span class="me-2 fas fa-users text-warning"></span>
                    <strong>Total Referrals:</strong> {{ $node['level1_count'] }}
                </p>
            </div>
        </li>
        <li class="treeview-list-item">
            <div class="treeview-item">
                <p class="treeview-text">
                    <span class="me-2 fas fa-sitemap text-danger"></span>
                    <strong>Level 2 Count:</strong> {{ $node['level2_count'] }}
                </p>
            </div>
        </li>

        {{-- Recursive rendering of children --}}
        @if (!empty($node['children']))
            @foreach ($node['children'] as $child)
                @include('user.level_member.tree_node', ['node' => $child])
            @endforeach
        @endif
    </ul>
</li>
