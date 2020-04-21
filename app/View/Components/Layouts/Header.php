<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Header extends Component
{
    public $provider;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($provider = 'users')
    {
        $this->provider = $provider;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.layouts.header');
    }
}
