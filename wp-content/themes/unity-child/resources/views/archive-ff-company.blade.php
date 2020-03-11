@extends('layouts.directory')

@php
  $upload_dir = wp_upload_dir();
  $field_region = get_field_object('field_5c75cc91664bd');
  $regions = $field_region['choices'];
  $field_industry = get_field_object('field_5c75ccac664bf');
  $industries = $field_industry['choices'];
  $field_employees = get_field_object('field_5c75cc9b664be');
  $employeess = $field_employees['choices'];
@endphp

@section('content')
  <header class="page-header" style="background-image:url({{ $upload_dir['baseurl'] }}/2019/02/iStock-803284710-1.jpg);">
    <div class="header-row">
      <div class="header-card">
        <div>Directory</div>
        <h1 class="header-card-title">Family Friendly Workplaces</h1>
      </div>
    </div>
  </header>

  <div class="magic-list" id="directory-list">
    <div class="filter-wrap">
      <div class="container">
        <div class="row">
          <div class="input-field">
            <input id="search_keyword" type="text" class="search"  />
            <label for="search_keyword">Search by Keyword</label>
          </div>
        </div>

        <div class="row">
          <span class="label">Filter by:</span>

          <select class="filter browser-default" id="filter_region" data-filter="region">
            <option value="" disabled selected>Region</option>
            <option value="all">All Regions</option>
            @foreach ($regions as $region)
              <option value="{{ $region }}">{{ $region }}</option>
            @endforeach
          </select>

          <select class="filter browser-default" id="filter_industry" data-filter="industry">
            <option value="" disabled selected>Industry</option>
            <option value="all">All Industries</option>
            @foreach ($industries as $industry)
              <option value="{{ $industry }}">{{ $industry }}</option>
            @endforeach
          </select>

          <select class="filter browser-default" id="filter_employees" data-filter="employees">
            <option value="" disabled selected>Number of Employees</option>
            <option value="all">All Sizes</option>
            @foreach ($employeess as $employees)
              <option value="{{ $employees }}">{{ $employees }}</option>
            @endforeach
          </select>

          <input id="reset_filter" type="button" class="btn-small" value="Reset" />
        </div>
      </div>
    </div>

    <div class="container">
      <ul class="list expandable">
        @while (have_posts()) @php the_post() @endphp
          <li class="expandable-body z-depth-1 closed">
            <div class="expandable-body-inner">
              <h2 class="h3 name"><a href="{{ the_field('link_to_website') }}" target="_blank" rel="noopener nofollow">{{ the_title() }}</a></h2>
              <div class="meta">
                <strong>Location:</strong> <em class="city">{{ the_field('city') }}</em>
                <span class="spacer">&bull;</span>
                <strong>Region:</strong> <em class="region">{{ the_field('region') }}</em>
                <br />
                <strong>Industry:</strong> <em class="industry">{{ the_field('industry') }}</em>
                <span class="spacer">&bull;</span>
                <strong>Number of Employees:</strong> <em class="employees"> {{ the_field('number_of_employees') }}</em>
              </div>
              <div class="row">
                <div class="col xl7ß s12">
                  <div class="policies entry-content">
                    <h3 class="h4">Policies</h3>
                    {!! the_field('policies') !!}
                  </div>
                </div>
                @if ($case_studies = get_field('related_case_study'))
                  <div class="col xl5 s12">
                    <div class="related-case-study">
                      <h3 class="h4 screen-reader-text">Case Study</h3>
                      @foreach ($case_studies as $case_study)
                        <a href="{{ get_the_permalink($case_study) }}">
                          @if (has_post_thumbnail($case_study))
                            <div class="related-case-study__image">
                              {!! get_the_post_thumbnail($case_study, 'card') !!}
                            </div>
                          @endif
                          {!! sprintf('View <span class="screen-reader-text">%s</span> case study', $case_study->post_title) !!}
                        </a>
                      @endforeach
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </li>
        @endwhile
      </ul>
    </div>
  </div>

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

@endsection
