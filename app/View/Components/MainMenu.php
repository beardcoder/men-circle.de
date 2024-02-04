<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\UriVoter;
use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\ListRenderer;
use Spatie\Menu\Laravel\Menu;

class MainMenu extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct()
  {
    //
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    $factory = new MenuFactory();
    $menu = $factory->createItem('My menu', [
      'childrenAttributes' => ['class' => 'mt-2 flex space-x-8 text-xl font-bold uppercase md:mr-0 md:mt-0'],
    ]);

    $menu->addChild('Home', ['uri' => '/']);
    $menu->addChild('Anmeldung', ['uri' => '/#contact']);
    $menu->addChild('FAQ\'s', ['uri' => '/#faq']);

    $itemMatcher = new Matcher([new UriVoter(str_replace('/index.php', '', $_SERVER['REQUEST_URI']))]);
    $renderer = new ListRenderer($itemMatcher);
    $menu = $renderer->render($menu, ['currentClass' => 'active', '']);

    return view('components.main-menu', ['menu' => $menu]);
  }
}
