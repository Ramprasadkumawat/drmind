@extends('admin.layout.template')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-md">
                <h5 class="mb-2 mb-md-0">Broadcasts</h5>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive scrollbar">
            <table class="table table-bordered table-striped fs-10 mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Facebook</th>
                        <th>WeChat</th>
                        <th>Instagram</th>
                        <th>WhatsApp</th>
                        <th>TikTok</th>
                        <th>YouTube</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($broadcasts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? 'N/A' }}</td>
                            <td>{{ $item->user->email ?? 'N/A' }}</td>
                            <td>{{ $item->facebook_count }}</td>
                            <td>{{ $item->wechat_count }}</td>
                            <td>{{ $item->instagram_count }}</td>
                            <td>{{ $item->whatsapp_count }}</td>
                            <td>{{ $item->tiktok_count }}</td>
                            <td>{{ $item->youtube_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection