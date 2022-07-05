<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SidebarMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $menuLabel = null)
    {
        $this->menuLabel = Auth::user()->user_role->route_limiter->sidebar_menu_label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
