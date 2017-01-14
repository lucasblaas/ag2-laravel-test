@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            <div class="pull-left">
                <h2>Show User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('user.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                </div>
            </div>

            @if(!empty($user->company->name))
            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <strong>Company:</strong>
                        {{ $user->company->name }}
                    </div>
                </div>
            </div>
            @endif
            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <strong>Status:</strong>
                        @if($user->active == 0)
                        {{ "Not Active" }}
                        @else
                        {{ "Active" }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <strong>Groups current of this user:</strong>

                        @if(count($user->groups) > 0)

                            @foreach ($user->groups as $group)
                                @if(!isset($flag))

                                {{ $group->name }}

                                @else

                                    {{ ", " . $group->name }}

                                @endif

                                @php($flag = TRUE)

                            @endforeach

                        @else

                            {{ "No groups to show!" }}

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection