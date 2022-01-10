@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ __('Create New Post') }}</div>
                    <div class="float-right">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm" dusk="back_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                            </svg> {{ __('Back') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="title" class="form-label">{{ __('Title') }}</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{ old('title') }}">
                                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="form-group mt-4">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea name="description" id="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                                @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="form-group mt-4">
                                <label for="published_at" class="form-label">{{ __('Publication Date') }}</label>
                                <input name="published_at" type="datetime-local" class="form-control" id="published_at" value="{{ old('published_at') }}">
                                @error('published_at')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">{{ __('Submit') }}</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection