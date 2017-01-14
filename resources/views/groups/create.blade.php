@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            <div class="pull-left">
                <h2>Create New Group</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('group.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="row">
            <div class="container">
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {!! Form::open(array('route' => 'group.store','method'=>'POST')) !!}

    <div class="row">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="name">Name</label>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        {{ Form::label('users', 'Users') }}
                        {{ Form::select('users[]', $users, null, ['id' => 'users', 'multiple' => 'multiple', 'class' => 'form-control']) }}
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {!! Form::close() !!}

@endsection