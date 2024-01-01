<div style="padding-bottom: 1rem;padding-top: 1rem;">
    @php
      $url = url('/profile/'. $getState())
    @endphp
    {!! QrCode::size(100)->generate($url); !!}

</div>
