<ul class="nav nav-pills mb-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.linked') ? 'active'  : '' }}"
           href="{{ route('social.linkedin.index') }}">{{ __('LinkedIn') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.twitter') ? 'active'  : '' }}"
           href="{{ route('social.twitter.index') }}">{{ __('Twitter') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.github') ? 'active'  : '' }}"
           href="{{ route('social.github.index') }}">{{ __('Github') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.twitter') ? 'active'  : '' }}"
           href="#">{{ __('Dev.to') }}</a>
    </li>

</ul>
