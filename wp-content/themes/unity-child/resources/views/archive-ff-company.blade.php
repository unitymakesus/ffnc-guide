@extends('layouts.directory')

@php
  $background_img = get_field('directory_hero_image', 'options');
  $field_region = get_field_object('field_5c75cc91664bd');
  $regions = $field_region['choices'];
  $field_industry = get_field_object('field_5c75ccac664bf');
  $industries = $field_industry['choices'];
  $field_employees = get_field_object('field_5c75cc9b664be');
  $employeess = $field_employees['choices'];
@endphp

@section('content')
  <header class="page-header" style="background-image:url({{ $background_img['sizes']['large'] }});">
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
          <fieldset>
            <legend>
              <span class="label">Filter by:</span>
            </legend>
            <label class="sr-only" for="filter_region">Region</label>
            <select class="filter browser-default" id="filter_region" data-filter="region">
              <option value="" disabled selected>Region</option>
              <option value="all">All Regions</option>
              @foreach ($regions as $region)
                <option value="{{ $region }}">{{ $region }}</option>
              @endforeach
            </select>
            <label class="sr-only" for="filter_industry">Industry</label>
            <select class="filter browser-default" id="filter_industry" data-filter="industry">
              <option value="" disabled selected>Industry</option>
              <option value="all">All Industries</option>
              @foreach ($industries as $industry)
                <option value="{{ $industry }}">{{ $industry }}</option>
              @endforeach
            </select>
            <label class="sr-only" for="filter_employees">Number of Employees</label>
            <select class="filter browser-default" id="filter_employees" data-filter="employees">
              <option value="" disabled selected>Number of Employees</option>
              <option value="all">All Sizes</option>
              @foreach ($employeess as $employees)
                <option value="{{ $employees }}">{{ $employees }}</option>
              @endforeach
            </select>
            <input id="reset_filter" type="button" class="btn-small" value="Reset" />
          </fieldset>
        </div>
      </div>
    </div>

    <div class="container">
      <ul class="list">
        @while (have_posts()) @php the_post() @endphp
          <li class="z-depth-1">
            <div class="collapse">
              <h2 class="h3 name">
                <button class="collapse__toggle" aria-expanded="false">
                  {{ the_title() }}
                  <svg aria-hidden="true" focusable="false" viewBox="0 0 10 10">
                    <rect class="vert" height="8" width="2" y="1" x="4"/>
                    <rect height="2" width="8" y="4" x="1"/>
                  </svg>
                </button>
              </h2>
              <div class="collapse__panel" hidden>
                <div class="row meta">
                  <div class="col s12">
                    <div>
                      <strong>Website:</strong> <em class="website"><a href="{{ the_field('link_to_website') }}" target="_blank" rel="noopener nofollow">{{ the_title() }}</a></em>
                    </div>
                    <strong>Location:</strong> <em class="city">{{ the_field('city') }}</em>
                    <span class="spacer">&bull;</span>
                    <strong>Region:</strong> <em class="region">{{ the_field('region') }}</em>
                    <br />
                    <strong>Industry:</strong> <em class="industry">{{ the_field('industry') }}</em>
                    <span class="spacer">&bull;</span>
                    <strong>Number of Employees:</strong> <em class="employees"> {{ the_field('number_of_employees') }}</em>
                  </div>
                </div>
                <div class="row">
                  <div class="col xl7 s12">
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
              {{-- <h2 class="h3 name"><a href="{{ the_field('link_to_website') }}" target="_blank" rel="noopener nofollow">{{ the_title() }}</a></h2> --}}
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
