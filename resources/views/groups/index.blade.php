@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            <div class="pull-left">
                <h2>Groups CRUD</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="row">
            <div class="container">

                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif


    <div class="row">
        <div class="container">

            <div class="pull-left">
                <a class="btn btn-success" href="{{ route('group.create') }}"> Create New Group</a>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th width="50">Id</th>
                    <th>Name</th>
                    <th width="230">Action</th>
                </tr>
                @foreach ($groups as $key => $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->name }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('group.show',$group->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('group.edit',$group->id) }}">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['group.destroy', $group->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>

    </div>

@endsection