@php
  $footer_color = get_theme_mod( 'footer_color' );
  $text_color = get_theme_mod( 'footer_text_color' );
@endphp
<footer class="content-info page-footer" role="contentinfo" style="background-color: {{ $footer_color }}">
  <div class="container-wide">
    <div class="footer-content row flex space-between align-center">
      <div class="footer-left col m3 s12">
        @php dynamic_sidebar('footer-left') @endphp
      </div>
      <div class="footer-center col m6 s12">
        @php dynamic_sidebar('footer-center') @endphp
      </div>
      <div class="footer-right col m3 s12">
        @php dynamic_sidebar('footer-right') @endphp
      </div>
    </div>
  </div>

  <div class="footer-copyright">
    <div class="container-wide">
      <div class="row flex space-between">
        <div class="footer-left col m9 s12">
          <p class="copyright">&copy; {!! current_time('Y') !!} NC Early Childhood Foundation. All rights reserved.</p>
        </div>
        <div class="footer-right col m3 s12">
          <p>
            <a href="{{ get_home_url() }}/privacy-policy/">Privacy Policy</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>
