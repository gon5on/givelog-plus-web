<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Routing\Router;
use Cake\Http\ServerRequest;
use Cake\Utility\Hash;
use App\Model\Entity\Gift;

class AppHelper extends Helper {
    public $helpers = ['Url'];

    public function menu(string $title, array $uri, string $icon_class): string {
        $parsed_url = Router::parseRequest(new ServerRequest(Router::url()));
        $parsed_controller_action = Hash::get($parsed_url, 'controller') . Hash::get($parsed_url, 'action');
        $target_controller_action = Hash::get($uri, 'controller') . Hash::get($uri, 'action');

        $active = ($parsed_controller_action == $target_controller_action) ? 'active' : '';

        $tag = '<li class="nav-item ' . $active . '">';
        $tag .= '<a class="nav-link" href="' . Router::url($uri) . '"><i class="fas fa-fw ' . $icon_class . '"></i>';
        $tag .= '<span>' . $title . '</span></a>';
        $tag .= '</li>';

        return $tag;
    }

    public function giftFromTo(Gift $gift): string {
        foreach ($gift->fromPersons as $person) {
            $from[] = '<a href="' . $this->Url->build(['controller' => 'Person', 'action' => 'view', $person->id]) . '">' . $person->name . '</a>';
        }

        foreach ($gift->toPersons as $person) {
            $to[] = '<a href="' . $this->Url->build(['controller' => 'Person', 'action' => 'view', $person->id]) . '">' . $person->name . '</a>';
        }

        return implode($from, '、') . '&nbsp;から&nbsp;' . implode($to, '、') . '&nbsp;へ';
    }

    public function giftPersonCategoryLabel(Gift $gift): string {
        $persons = ($gift->type == GIVE) ? $gift->toPersons : $gift->fromPersons;
        $personCategories = Hash::combine($persons, '{n}.personCategory.id', '{n}.personCategory');

        if (!$personCategories) {
            return '';
        }

        $tag = '';
        foreach ($personCategories as $personCategory) {
            $tag .= $this->badge($personCategory['labelColor'], $personCategory['name']);
        }

        return $tag;
    }

    public function badge(string $labelColor, string $name): string {
        return '<span class="badge badge-pill" style="background-color:' . $labelColor . '">' . $name . '</span>' . "\n";
    }
}
