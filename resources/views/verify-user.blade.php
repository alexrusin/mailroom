@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Verify Account</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->verified) 
                        <p>Your account has been verified! <span class="glyphicon glyphicon-ok-circle" style="color:green;"></span></p>
                    @else 
                        <p>Verification email has been sent to {{auth()->user()->email}}.</p>
                    
                        @if(auth()->user()->updated_at->addHours(1)->lt(\Carbon\Carbon::now()))
                            <send-verification-email></send-verification-email>

                        @endif

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection