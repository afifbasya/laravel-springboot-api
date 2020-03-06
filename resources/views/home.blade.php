@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-2">
            <a href="{{ url('home/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create Todos</a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Target Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aktif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td> {{ \Carbon\Carbon::parse($data->targetDate)->format('d M Y') }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->description }}</td>
                                <td>
                                    @if($data->status == 0)
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @else
                                    <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    
                                    <form action="{{ url('home') }}/{{ $data->id }}" method="post" class="form-inline">

                                        <a href="{{ url('home') }}/{{ $data->id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o"></i> Edit</a>

                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ?');"><i class="fa fa-trash-o"></i> Delete</a>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection