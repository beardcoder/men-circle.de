<?php

namespace App\View\Components\Partials\Content;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Wrapper extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct(public string|null $anchor = '', public bool|null $background = false)
  {
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.partials.content.wrapper');
  }
}
