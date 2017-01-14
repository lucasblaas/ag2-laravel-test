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

    {!! Form::open(array('route' => 'user.store','method'=>'POST')) !!}

    <div class="row">

        <div class="container">

            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::text('email', null, array('placeholder' => 'E-mail','class' => 'form-control')) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}
                        {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('password_confirmation', 'Confirm Password') }}
                        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>

            @if(count($companies) > 0)
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        {{ Form::label('company', 'Company') }}
                        {{ Form::select('company_id', $companies, null, ['id' => 'companies', 'class' => 'form-control', 'placeholder'=>'Choose a value...']) }}
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        {{ Form::label('groups', 'Groups') }}
                        {{ Form::select('groups[]', $groups, null, ['id' => 'groups', 'multiple' => 'multiple', 'class' => 'form-control']) }}
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        {{ Form::checkbox('active', '1', true) }}
                        {{ Form::label('active', 'Active') }}
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