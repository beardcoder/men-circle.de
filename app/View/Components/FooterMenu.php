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

class FooterMenu extends Component
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
      'childrenAttributes' => [
        'class' => 'mb-6 flex flex-wrap items-center justify-center dark:text-white space-x-8 uppercase',
      ],
    ]);

    $menu->addChild('Home', ['uri' => '/']);
    $menu->addChild('Kontakt', ['uri' => 'mailto:markus@mens-circle.de']);
    $menu->addChild('Impressum', ['uri' => '/impressum']);
    $menu->addChild('Instagram', ['uri' => 'https://www.instagram.com/markus.sommer/']);

    $itemMatcher = new Matcher([new UriVoter(str_replace('/index.php', '', $_SERVER['REQUEST_URI']))]);
    $renderer = new ListRenderer($itemMatcher);
    $menu = $renderer->render($menu, ['currentClass' => 'active', '']);

    return view('components.footer-menu', ['menu' => $menu]);
  }
}
