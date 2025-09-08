@extends('admin.layout.template')

@section('content')
<div class="container">
    <h1>Manage Pages</h1>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary mb-3">Create New Page</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Published</th>
                <th>Homepage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>
                        @if($page->categories())
                            @foreach($page->categories() as $category)
                                <span class="badge bg-primary">{{ $category->name }}</span>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $page->name }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>
                        @if($page->is_published)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        @if($page->is_homepage)
                            <span class="badge bg-info">Yes</span>
                        @else
                            <span class="badge bg-light">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.pages.show', $page->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.pages.publish', $page->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-{{ $page->is_published ? 'danger' : 'success' }} btn-sm" onclick="return confirm('Are you sure you want to {{ $page->is_published ? 'unpublish' : 'publish' }} this page?');">
                                {{ $page->is_published ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this page?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No pages found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
