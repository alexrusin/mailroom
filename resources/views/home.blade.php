@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Hi {{auth()->user()->name}}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        <strong>API Key:</strong> {{auth()->user()->api_token}}
                    </p>

                    <p>
                        <strong>Route Prefix:</strong> {{auth()->user()->route_prefix}}
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
