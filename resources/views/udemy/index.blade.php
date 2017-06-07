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

    @if(isset($q))
<hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <p class="text-center">{{$q}}</p>
            </div>
        </div>
    </div>
    @endif
@endsection