@extends('layouts.app')

@section('content')
    <div class="text-right">
        @isset($showback)
            <a href="/users" class="btn btn-outline-info float-left ">Back</a>
        @endisset
        
        @if(auth()->user()->isAdmin())
            <a href="/sensors/create" class="btn btn-info"><i class="fas fa-plus mr-1"></i> Add Sensors</a>
        @endif
    </div>
    @if(count($sensors) > 0)
        <h2 class="mt-3">Sensors list</h2>
        
        <div class="table-responsive">
            <table class="table mt-4">   
                <tr class="table-info">
                    @if(auth()->user()->isAdmin())
                        <th>Owner</th>
                    @endif
                    <th>Name</th>
                    <th>Location</th>
                    <th>Last data read</th>
                </tr>  
                @foreach ($sensors as $sensor)
                    <tr>
                        @if(auth()->user()->isAdmin())
                            @if($sensor->user->isAdmin())
                                <td>None</td>
                            @else
                                <td>{{$sensor->user->name}}</td>
                            @endif
                        @endif
                        <td>{{$sensor->name}}</td>
                        <td>{{$sensor->location}}</td>
                        <td>
                            @if($sensor->datas->last() !== NULL)
                                {{$sensor->datas->last()->created_at}}
                            @else
                                There was no incoming data.
                            @endif
                            <a href="/sensors/{{$sensor->id}}" class="btn btn-outline-info float-right"><i class="fas fa-eye mr-1"></i> View Details</a>
                        </td>
                    </tr>                        
                @endforeach 
            </table>  
        </div>
    @else
        <h3>You have no available sensors</h3>
    @endif
@endsection
