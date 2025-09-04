@extends('admin.layout.template')

@section('content')
<div class="container">
    <h1>Broadcast Analytics</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Email</th>
                    @foreach($platforms as $platform)
                        <th class="text-capitalize">{{ $platform }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php $serial = 1; @endphp
                @foreach($broadcasts as $broadcast)
                    @php
                        // Group clicks by user for this specific broadcast
                        $usersClicks = $broadcast->clicks->groupBy('user_id');
                    @endphp
                    @foreach($usersClicks as $userId => $clicks)
                        <tr>
                            <td>{{ $serial++ }}</td>
                            <td>{{ $broadcast->title }}</td>
                            <td>{{ $clicks->first()->user->name }}</td>
                            <td>{{ $clicks->first()->user->email }}</td>
                            @foreach($platforms as $platform)
                                <td>
                                    {{ $clicks->where('platform', $platform)->sum('clicks') }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach

                @if($serial == 1)
                    <tr>
                        <td colspan="{{ 4 + count($platforms) }}" class="text-center">No broadcast clicks recorded yet.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
