@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            <div class="pull-left">
                <h2>Show Group</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('group.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $group->name }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <strong>Users current in this group:</strong>

                        @if(count($group->users) > 0)

                            @foreach ($group->users as $user)
                                @if(!isset($flag))

                                    {{ $user->name }}

                                @else

                                    {{ ", " . $user->name }}

                                @endif

                                @php($flag = TRUE)

                            @endforeach

                        @else
                            {{ "Without users!" }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection