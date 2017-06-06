@extends('layouts.app')

@section('content')
    <form action="{{route('pdf.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file" name="attachment[]" multiple>
        <input type="submit">

    </form>
@endsection