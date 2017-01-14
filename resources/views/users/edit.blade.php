@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            <div class="pull-left">
                <h2>Edit User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('user.index') }}"> Back</a>
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

    {!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id]]) !!}

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
                        {{ Form::text('email', null, array('placeholder' => 'E-mail','class' => 'form-control', 'disabled' => 'disabled')) }}
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
                            @if(!empty($user->company->id))
                            {{ Form::select('company_id', $companies, $user->company->id, ['id' => 'companies', 'class' => 'form-control', 'placeholder'=>'Choose a value...']) }}
                            @else
                            {{ Form::select('company_id', $companies, null, ['id' => 'companies', 'class' => 'form-control', 'placeholder'=>'Choose a value...']) }}
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        {{ Form::label('groups', 'Groups') }}

                        @if(count($user->groups) > 0)

                            {{ Form::select('groups[]', $groups, $user->groups->pluck('id')->all(), ['id' => 'groups', 'multiple' => 'multiple', 'class' => 'form-control']) }}

                        @else

                            {{ Form::select('groups[]', $groups, null, ['id' => 'groups', 'multiple' => 'multiple', 'class' => 'form-control']) }}

                        @endif
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        @if($user->active == 1)
                        {{ Form::checkbox('active', '1', true) }}
                        @else
                        {{ Form::checkbox('active', '1', false) }}
                        @endif
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