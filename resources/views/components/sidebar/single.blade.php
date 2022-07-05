@php
    if(Auth::guard('web')->check()){
        $permissionAvailable = Auth::guard('web')->user()->user_role->route_limiter->pluck('route');
    }
@endphp
@if (Auth::guard('admin')->check() || $permissionAvailable->contains($route))
<li>
    <a href="{{$link}}">
        <div class="parent-icon"><i class='{{$icon}}'></i>
        </div>
        <div class="menu-title">{{$name}}</div>
    </a>
</li>
@endif
