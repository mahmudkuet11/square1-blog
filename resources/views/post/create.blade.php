@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ __('Create New Post') }}</div>
                </div>

                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{ old('title') }}">
                                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="form-group mt-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                                @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="form-group mt-4">
                                <label for="published_at" class="form-label">Publication Date</label>
                                <input name="published_at" type="date" class="form-control" id="published_at" value="{{ old('published_at') }}">
                                @error('published_at')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection