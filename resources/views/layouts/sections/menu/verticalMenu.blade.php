<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{ url('/management/dashboard') }}" class="app-brand-link">
            <img style='width:200px;' src='/img/logo_horizontal.png' alt="App Logo">
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach ($menuData[0]['menu'] as $menu)
            {{-- menu headers --}}
            @if (isset($menu['menuHeader']))
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{ __($menu['menuHeader']) }}</span>
                </li>
            @else
                @php
                    $activeClass = '';
                    $currentRouteName = Route::currentRouteName();

                    if ($currentRouteName === $menu['slug']) {
                        $activeClass = 'active';
                    } elseif (isset($menu['submenu'])) {
                        if (is_array($menu['slug'])) {
                            foreach ($menu['slug'] as $slug) {
                                if (str_contains($currentRouteName, $slug) && strpos($currentRouteName, $slug) === 0) {
                                    $activeClass = 'active open';
                                    break; // Exit loop once a match is found
                                }
                            }
                        } else {
                            if (str_contains($currentRouteName, $menu['slug']) && strpos($currentRouteName, $menu['slug']) === 0) {
                                $activeClass = 'active open';
                            }
                        }
                    }
                @endphp

                <li class="menu-item {{ $activeClass }}">
                    <a href="{{ isset($menu['url']) ? url($menu['url']) : 'javascript:void(0);' }}" class="{{ isset($menu['submenu']) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu['target']) && !empty($menu['target'])) target="{{ $menu['target'] }}" @endif>
                        @isset($menu['icon'])
                            <i class="{{ $menu['icon'] }}"></i>
                        @endisset
                        <div>{{ isset($menu['name']) ? __($menu['name']) : '' }}</div>

                        @isset($menu['badge'])
                            <div class="badge bg-{{ $menu['badge'][0] }} rounded-pill ms-auto">{{ $menu['badge'][1] }}</div>
                        @endisset
                    </a>

                    {{-- Submenu --}}
                    @isset($menu['submenu'])
                        @include('layouts.sections.menu.submenu', ['menu' => $menu['submenu']])
                    @endisset
                </li>
            @endif
        @endforeach
    </ul>
</aside>