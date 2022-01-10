@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ __('All Posts') }}</div>
                    <div class="float-right">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm" dusk="create_new_post_btn">Create New Post</a>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <x-table.sort title="Publication Date" key="published_at"></x-table.sort>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($posts as $index => $post)
                                <tr>
                                    <td>{{ ($posts->currentPage() - 1) * $posts->perPage() + $index + 1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->published_at->toDayDateTimeString() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No post found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {!! $posts->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
