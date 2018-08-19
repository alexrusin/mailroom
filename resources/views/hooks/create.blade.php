@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Route</div>

                <div class="panel-body">
                   <form method="POST" action="{{route('hooks.store')}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="method">Choose a method</label>
                            <select name="method" id="method" class="form-control" required>
                                <option value="">Choose one...</option>
                                <option value="get">GET</option>
                                <option value="post">POST</option>
                                <option value="put">PUT</option>
                                <option value="patch">PATCH</option>
                                <option value="delete">DELETE</option>
                                <option value="head">HEAD</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="path">Path:</label>
                            <input type="text" class="form-control" id="path" name="path" value="{{old('path')}}" required>
                        </div>
                        <div class="form-group">
                             <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                       
                        @if(count($errors))
                         <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                         </ul>
                       @endif
                   </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection