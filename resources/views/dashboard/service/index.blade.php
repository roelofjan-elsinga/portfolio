@extends('dashboard')

@section('content')
    <a href="{{ route('service.create') }}" class="btn btn-success pull-right">Add service</a>
    <table class="table table-bordered table-condensed table-hover table-responsive">
        <thead>
        <tr>
            <th style="width:30px;"></th>
            <th style="width:30px;"></th>
            <th>Title</th>
        </tr>
        </thead>
        <tbody>
        @if(count($services) == 0)
            <tr>
                <td></td>
                <td></td>
                <td>No service found!</td>
            </tr>
        @else
            @foreach($services as $service)
                <tr>
                    <td><a class="btn btn-danger btn-sm" href="{{ route('service.destroy', $service->id) }}"><i class="fa fa-times"></i></a></td>
                    <td><a class="btn btn-warning btn-sm" href="{{ route('service.edit', $service->id) }}"><i class="fa fa-pencil"></i></a></td>
                    <td>{{ $service->title }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection