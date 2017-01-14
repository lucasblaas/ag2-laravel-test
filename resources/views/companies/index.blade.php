@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            <div class="pull-left">
                <h2>Company CRUD</h2>
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
                <a class="btn btn-success" href="{{ route('company.create') }}"> Create New Company</a>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th width="50">Id</th>
                    <th>Name</th>
                    <th width="230">Action</th>
                </tr>
                @foreach ($companies as $key => $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('company.show',$company->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('company.edit',$company->id) }}">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['company.destroy', $company->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>

    </div>

@endsection