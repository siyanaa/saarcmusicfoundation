@extends('backend.layouts.master')

@section('content')
    <!-- Success and error messages -->
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <!-- Add video button -->
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ route('admin.video-galleries.create') }}">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Add
                </button>
            </a>
            <a href="{{ url('admin') }}">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </button>
            </a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <!-- Table for displaying videos -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Link</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $serialNumber = ($videos->currentPage() - 1) * $videos->perPage() + 1;
        @endphp
            @foreach ($videos as $video)
                <tr>
                    <td width="5%">{{ $serialNumber }}</td>
                    <td>{{ $video->title ?? '' }}</td>
                    <td>
                        <iframe width="100" height="100" src="https://www.youtube.com/embed/{{ $video->url }}"
                            title="{{ $video->title }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </td>
                    <td>
                        <div style="display: flex; flex-direction: row;">
                            <button onclick="editVideo({{ $video->id }})" class="btn btn-warning btn-sm"
                                style="margin-right: 5px;">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button onclick="deleteVideo({{ $video->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @php
        $serialNumber++;
    @endphp

            @endforeach
        </tbody>
    </table>

    <!-- Edit Video Modal -->
    <div class="modal fade" id="editVideoModal" tabindex="-1" role="dialog" aria-labelledby="editVideoModalLabel"
        aria-hidden="true">
        <!-- Modal content for editing video -->
    </div>

    <!-- Delete Video Modal -->
    <div class="modal fade" id="deleteVideoModal" tabindex="-1" role="dialog" aria-labelledby="deleteVideoModalLabel"
        aria-hidden="true">
        <!-- Modal content for deleting video -->
    </div>

    <!-- JavaScript functions for modals -->
    <script>
        // Function to open edit video modal and set action URL
        function editVideo(id) {
            var url = "{{ route('admin.video-galleries.edit', ':id') }}";
            url = url.replace(':id', id);
            $('#editVideoModal').load(url, function() {
                $(this).modal('show');
            });
        }

        // Function to open delete video modal and set action URL
        function deleteVideo(id) {
            var url = "{{ route('admin.video-galleries.destroy', ':id') }}";
            url = url.replace(':id', id);
            $('#deleteVideoModal').load(url, function() {
                $(this).modal('show');
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        @if ($videos->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $videos->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        @foreach ($videos->getUrlRange(1, $videos->lastPage()) as $page => $url)
            @if ($page == $videos->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($videos->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $videos->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
</nav>

@endsection
