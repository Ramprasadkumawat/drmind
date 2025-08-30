@extends('user.layout.template')
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-md">
                    <h5 class="mb-2 mb-md-0">Create a Broadcast
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                    </h5>
                </div>
                <div class="row g-0">
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="row flex-between-end">
                                <div class="col-auto align-self-center">
                                </div>
                                <div class="col-auto ms-auto">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form id="uploadForm" action="{{ route('user.broadcast.store') }}" onsubmit="return false;"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">

                                    <label for="image" class="form-label">File</label>
                                    <input type="file" name="image" id="image" class="form-control" required>
                                    <progress id="progressBar" value="0" max="100" style="width:100%;"></progress>
                                    <span id="percent">0%</span>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                                    @error('message')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Create Broadcast</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end g-0">
                            <div class="col-auto col-sm-5 mb-3">
                                <form>
                                    <div class="input-group"><input class="form-control form-control-sm shadow-none search"
                                            type="search" placeholder="Search..." aria-label="search" />
                                        <div class="input-group-text bg-transparent"><span
                                                class="fa fa-search fs-10 text-600"></span></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive scrollbar">
                            <table class="table table-bordered table-striped fs-10 mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="f-light f-w-600">S.No</span>
                                        </th>
                                        <th> <span class="f-light f-w-600">Title</span></th>
                                        <th><span class="f-light f-w-600">Image</span></th>
                                        <th> <span class="f-light f-w-600">Message</span></th>
                                        <th> <span class="f-light f-w-600">Created At</span></th>
                                        <th> <span class="f-light f-w-600">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($broadcasts as $index => $broadcast)
                                        <tr class="product-removes">
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <p>{{ $broadcast->title }}</p>
                                            </td>
                                            <td>
                                                @php
                                                    $ext = strtolower(pathinfo($broadcast->image, PATHINFO_EXTENSION));
                                                @endphp
                                                @if ($ext === 'mp4')
                                                    <video width="100" controls>
                                                        <source src="{{ asset($broadcast->image) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    <img src="{{ asset($broadcast->image) }}" width="50px">
                                                @endif
                                            </td>
                                            <td>
                                                <p class="f-light">{{ $broadcast->message }}</p>
                                            </td>
                                            <td>
                                                <p class="f-light">{{ $broadcast->created_at }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.broadcast.delete', $broadcast->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                                @php
                                                    $broadcastUrl = route('broadcast.show', $broadcast->id);
                                                    $shareText = $broadcast->title . ' - ' . $broadcast->message;
                                                @endphp

                                                {{-- Facebook Share --}}
                                                {{-- <a href="{{ $broadcastUrl }}">Test</a> --}}
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($broadcastUrl) }}"
                                                    target="_blank" class="btn btn-primary" title="Share on Facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>

                                                {{-- X (Twitter) Share --}}
                                                <a href="https://twitter.com/intent/tweet?url={{ urlencode($broadcastUrl) }}&text={{ urlencode($shareText) }}"
                                                    target="_blank" class="btn btn-dark" title="Share on X">
                                                    <i class="fab fa-twitter"></i>
                                                </a>

                                                {{-- LinkedIn Share --}}
                                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($broadcastUrl) }}"
                                                    target="_blank" class="btn btn-secondary" title="Share on LinkedIn">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formData = new FormData(this);

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                            $('#progressBar').val(percentComplete);
                            $('#percent').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                url: form.action,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#progressBar').val(0);
                    $('#percent').text('0%');
                    alert("Upload successful!");
                    location.reload();
                },
                error: function() {
                    alert("Upload failed! or file currupted");
                }
            });
        });
    </script>
@endsection
