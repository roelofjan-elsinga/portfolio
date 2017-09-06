@extends('dashboard')

@section('content')
    <a href="{{ route('work.create') }}" class="btn btn-success pull-right">Add work</a>
    <table class="table table-bordered table-condensed table-hover table-responsive">
        <thead>
        <tr>
            <th style="width:30px;"></th>
            <th style="width:30px;"></th>
            <th>Title</th>
        </tr>
        </thead>
        <tbody>
        @if(count($works) == 0)
            <tr>
                <td></td>
                <td></td>
                <td>No work found!</td>
            </tr>
        @else
            @foreach($works as $work)
                <tr>
                    <td><a class="btn btn-danger btn-sm" href="{{ route('work.destroy', $work->id) }}"><i class="fa fa-times"></i></a></td>
                    <td><a class="btn btn-warning btn-sm" href="{{ route('work.edit', $work->id) }}"><i class="fa fa-pencil"></i></a></td>
                    <td>{{ $work->title }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection