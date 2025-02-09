<?php

namespace App\View\Components;

use App\Models\ExItem;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReviewModal extends Component
{


    /**
     * Create a new component instance.
     */
    public function __construct(public ExItem $product)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.review-modal');
    }
}
