@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            <div class="pull-left">
                <h2>Users CRUD</h2>
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
                <a class="btn btn-success" href="{{ route('user.create') }}"> Create New User</a>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th width="50">Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th width="230">Action</th>
                </tr>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!empty($user->company->name))
                            {{ $user->company->name }}
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

@endsection