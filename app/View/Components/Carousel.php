<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Carousel extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $slides = [
            'img/slide1.jpg',
            'img/slide2.jpg',
            'img/slide3.jpg',
            'img/slide4.jpg',
            'img/slide5.jpg',
            'img/slide6.jpg',
            'img/slide7.jpg',
        ];
        return view('components.carousel',[
            'slides' => $slides 
        ]);
    }
}
