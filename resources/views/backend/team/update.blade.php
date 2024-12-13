@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.teams.index') }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-arrow-left"></i> Back
                            </button>
                        </a>
                        Edit Team Member
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.teams.update', $team->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $team->name) }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="position">Position:</label>
                                <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $team->position) }}" required>
                                @error('position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone_no">Phone Number:</label>
                                <input type="text" name="phone_no" id="phone_no" class="form-control" value="{{ old('phone_no', $team->phone_no) }}" required>
                                @error('phone_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role:</label>
                                <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $team->role) }}">
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $team->email) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $team->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Update Image:</label>
                                <input type="file" name="image" id="image" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <img id="preview" src="{{ asset('uploads/team/' . $team->image) }}" alt="Current Image" style="max-width: 100%; max-height: 200px;">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const previewImage = (event) => {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.onload = () => {
            URL.revokeObjectURL(preview.src);
        };
    };
</script>
@endsection
