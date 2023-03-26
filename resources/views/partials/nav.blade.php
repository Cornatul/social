<ul class="nav nav-pills mb-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.linked') ? 'active'  : '' }}"
           href="{{ route('social.linkedin.index') }}">{{ __('LinkedIn') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.github') ? 'active'  : '' }}"
           href="{{ route('social.github.index') }}">{{ __('Github') }}</a>
    </li>

</ul>
