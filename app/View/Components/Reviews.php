<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Reviews extends Component
{

    public $reviews;

    /**
     * Create a new component instance.
     */
    public function __construct($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.reviews');
    }
}
