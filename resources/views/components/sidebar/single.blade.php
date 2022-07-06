@php
    if(Auth::guard('web')->check()){
        $permissionAvailable = Auth::guard('web')->user()->user_role->route_limiter->pluck('route');
    }
    $routeProfile = Auth::guard('web')->check() ? ['user.profile.edit', 'user.password.edit'] : ['admin.profile.edit', 'admin.password.edit'];
@endphp
@if (Auth::guard('admin')->check() || $permissionAvailable->contains($route) || in_array($route, $routeProfile))
<li>
    <a href="{{$link}}">
        <div class="parent-icon"><i class='{{$icon}}'></i>
        </div>
        <div class="menu-title">{{$name}}</div>
    </a>
</li>
@endif
