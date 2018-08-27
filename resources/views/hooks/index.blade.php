@extends('layouts.app')

@section('content')

<div class="container">
    @forelse ($hooks as $hook)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Hook Url:</strong> {{config('app.url') .'/api/'. $hook->path}}
                </div>

                <div class="panel-body wrap">
                    <p>
                        <strong>Path:</strong> {{$hook->path}}
                    </p>

                    <p>
                        <strong>Method:</strong> {{strtoupper($hook->method)}}
                    </p>
                    @if($hook->ip) 
                        <p>
                            <strong>IP:</strong> {{$hook->ip}}
                        </p>
                    @endif

                    @if($hook->query_string)
                        <p>
                            <strong>Query String:</strong> {{$hook->query_string}}
                        </p>
                    @endif 

                    @if(!empty($hook->headers))
                        <p><strong>Headers:</strong></p>
                        @foreach($hook->headers as $key => $value)
                           
                                <p>
                                    <mark>{{$key}}</mark>: {{($value)}}
                                </p>
                           
                          
                        @endforeach
                    @endif

                    @if(!empty($hook->body))
                        <p>
                            <strong>Body:</strong>
                        </p>
                        <p>
                            {{$hook->body}}
                        </p>
                    @endif

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right">
                                {{--<a href="#" class="btn btn-primary">Go To Route</a>--}}
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$hook->id}}">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
            <div class="modal fade" id="deleteModal-{{$hook->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteModalLabel">Are you sure?</h4>
                  </div>
                  <div class="modal-body">
                     Are you sure you want to delete route {{$hook->path}}?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    
                    <a class="btn btn-danger" href="{{ route('hooks.delete', ['hook' => $hook]) }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-hook-{{$hook->id}}').submit();">
                                            Delete
                                </a>

                                <form id="delete-hook-{{$hook->id}}" action="{{ route('hooks.delete', ['hook' => $hook]) }}" method="POST" style="display: none;">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                </form>
                  </div>
                </div>
              </div>
            </div>

@empty
     <div class="row">
        <div class="col-md-8 col-md-offset-4">
            <p>You have no routes.  <a href="{{route('hooks.create')}}">Create route</a></p>
        </div>
    </div>
@endforelse
</div>

@endsection