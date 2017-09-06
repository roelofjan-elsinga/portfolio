@extends('dashboard')

@section('content')
    <table class="table table-bordered table-condensed table-hover table-responsive">
        <thead>
        <tr>
            <th style="width:30px;"></th>
            <th>Title</th>
        </tr>
        </thead>
        <tbody>
        @if(count($pages) == 0)
            <tr>
                <td></td>
                <td>No pages found!</td>
            </tr>
        @else
            @foreach($pages as $page)
                <tr>
                    <td><a class="btn btn-warning btn-sm" href="{{ route('page.edit', $page->id) }}"><i class="fa fa-pencil"></i></a></td>
                    <td>{{ $page->title }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection