@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            <div class="pull-left">
                <h2>Show Company</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('company.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $company->name }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <strong>Users current of this company:</strong>

                        @if(count($company->users) > 0)

                            @foreach ($company->users as $user)
                                @if(!isset($flag))

                                    {{ $user->name }}

                                @else

                                    {{ ", " . $user->name }}

                                @endif

                                @php($flag = TRUE)

                            @endforeach

                        @else

                            {{ "No users to show!" }}

                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection