<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Routing\Router;
use Cake\Http\ServerRequest;
use Cake\Utility\Hash;

/**
 * AppHelper
 */
class AppHelper extends Helper
{
    /**
     * menu
     *
     * @param string $title
     * @param array $uri
     * @param string $icon_class
     * @return string $tag
     */
    public function menu($title, $uri, $icon_class)
    {
        $parsed_url = Router::parseRequest(new ServerRequest(Router::url()));
        $parsed_controller = Hash::get($parsed_url, 'controller');
        $target_controller = Hash::get($uri, 'controller');

        $active = ($parsed_controller == $target_controller) ? 'active' : '';

        $tag = '<li class="nav-item ' . $active . '">';
        $tag .= '<a class="nav-link" href="' . Router::url($uri) . '"><i class="fas fa-fw ' . $icon_class . '"></i>';
        $tag .= '<span>' . $title . '</span></a>';
        $tag .= '</li>';

        return $tag;
    }
}
