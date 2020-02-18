@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @if (is_home())
    <div class="archive-filters">
      <div class="archive-filters__type">
        <span style="font-weight:bold;">View:</span>
        @php $active_filter = array_key_exists('filter', $_GET); @endphp
        <a href="{{ get_post_type_archive_link('post') }}" class="{{ $active_filter ? '' : 'active' }}">All</a>
        <a href="{{ get_post_type_archive_link('post') . '?filter=post' }}"  class="{{ $active_filter && $_GET['filter'] === 'post' ? 'active' : '' }}">Posts</a>
        <a href="{{ get_post_type_archive_link('post') . '?filter=ff-case-study' }}" class="{{ $active_filter && $_GET['filter'] === 'ff-case-study' ? 'active' : '' }}">Case Studies</a>
      </div>
      <div class="archive-filters__cat">
        @include('partials.category-dropdown', [
          'categories' => get_categories([
            // 'exclude'    => 1,
            // 'hide_empty' => true,
          ]),
          'label' => 'Filter by category:'
        ])
      </div>
    </div>
  @endif

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif
  <div class="grid">
    @while (have_posts()) @php the_post() @endphp
      @include('partials.content-'.get_post_type())
    @endwhile
  </div>

  @php
    the_posts_pagination([
      'prev_text' => '&laquo; Previous <span class="screen-reader-text">page</span>',
      'next_text' => 'Next <span class="screen-reader-text">page</span> &raquo;',
      'before_page_number' => '<span class="meta-nav screen-reader-text">Page</span>',
    ]);
  @endphp
@endsection
