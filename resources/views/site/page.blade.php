@extends('site.layouts.page')
@section('content')
  <main>
    {!! $item->renderBlocks() !!}
  </main>
@stop
