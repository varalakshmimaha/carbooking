@extends('layouts\frontend')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description)

@section('content')
    @foreach($sectionsData as $section)
        @includeIf('frontend.sections.' . $section['key'], ['settings' => $section['settings'], 'data' => $section['data']])
    @endforeach
@endsection
