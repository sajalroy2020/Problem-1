@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <form action="{{ route('note.search') }}" method="GET">
                <div class="input-group search-box pb-3">
                    <input class="form-control border-end-0 border rounded-pill pe-4" name="search" type="search" placeholder="Search note" id="example-search-input">
                    <span class="input-group-append search-btn">
                        <button type="submit" class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <a class="text-black btn btn-warning" href="{{route('note.list')}}">Note List</a>
        </div>
    </div>
    <div class="row">
        @forelse ($allNotes as $notes)
            <div class="col-md-3 py-2 mt-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{$notes->title}}</h5>
                        <p class="card-text">{{substr($notes->description, 0,  100) }}</p>
                        <a href="{{route('note.view', encrypt($notes->id))}}" class="card-link">See More...</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center">No data Found</div>
        @endforelse

    </div>
</div>
@endsection
