@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <form action="{{route('udemy.index')}}" method="get">
                    {{--{{csrf_field()}}--}}
                    <input type="search" name="q" class="form-control"><br><br>
                    <input type="submit" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>

    @if(isset($variables['q']))
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <p class="text-center">Search Term: <em>{{$variables['q']}}</em></p>
                    <p>Displaying: {{$variables['from'] + 1 .' to ' . $variables['to'] . ' of ' . $variables['total']}} </p>
                </div>
            </div>
            <hr>
            @if(!empty($variables['hits']))
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        @foreach($items as $hit)
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    {{$hit['_source']['name']}} - <span class="pull-right">{{$hit['_source']['price']}}</span>
                                </div>
                                <div class="panel panel-body">
                                    {{$hit['_source']['description']}}
                                </div>
                            </div>
                        @endforeach
                        {{ $items->links()  }}
                    </div>
                </div>
            @elseif(isset($variables['hits']))
                <h3>No Results</h3>
            @endif
        </div>
    @endif
@endsection