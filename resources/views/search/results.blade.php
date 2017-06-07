@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <form action="{{route('search.index')}}" method="get">
                    {{--{{csrf_field()}}--}}
                    <input type="search" name="q" class="form-control"><br><br>
                    <input type="submit" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>

    @if(isset($q))
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <p class="text-center">Search Term: <em>{{$q}}</em></p>
                </div>
            </div>
            <hr>
            @if(!empty($hits))
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        @foreach($hits as $hit)
                            <div class="panel panel-success">
                                <div class="panel panel-heading">
                                    {{$hit['_source']['name']}} - <span class="pull-right">{{$hit['_source']['price']}}</span>
                                </div>
                                <div class="panel panel-body">
                                    {{$hit['_source']['description']}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif(isset($hits))
                <h3>No Results</h3>
            @endif
        </div>
    @endif
@endsection