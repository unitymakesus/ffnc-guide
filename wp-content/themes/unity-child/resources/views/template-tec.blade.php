{{--
  Template Name: The Events Calendar
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @if (tribe_is_view('list') || tribe_is_view('month'))
      @include ('partials.page-header')
    @endif
    <article class="full-container" {!! post_class() !!}>
      @include('partials.content-page')
    </article>
  @endwhile
@endsection
