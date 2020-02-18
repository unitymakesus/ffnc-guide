@if ($categories)
  <div class="dropdown">
    @if ($label)
      <span class="dropdown__label">{{ $label }}</span>
    @endif
    <a class="dropdown__toggle" href="#" role="button" aria-expanded="false">
      {{ __('Categories', 'sage') }}
      <i class="material-icons" aria-hidden="true">arrow_drop_down</i>
    </a>
    <ul class="dropdown__list">
      @foreach ($categories as $category)
        <li>
          <a href="{{ get_category_link($category) }}">{!! ($category->name) !!}</a>
        </li>
      @endforeach
    </ul>
  </div>
@endif
