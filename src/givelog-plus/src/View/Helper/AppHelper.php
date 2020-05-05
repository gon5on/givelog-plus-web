<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Routing\Router;
use Cake\Http\ServerRequest;
use Cake\Utility\Hash;
use App\Model\Entity\Gift;

class AppHelper extends Helper {
    public $helpers = ['Url'];

    public function menu(string $title, array $uri, string $iconClass): string {
        $parsedUrl = Router::parseRequest(new ServerRequest(Router::url()));
        $parsedControllerAction = Hash::get($parsedUrl, 'controller') . Hash::get($parsedUrl, 'action');
        $targetControllerAction = Hash::get($uri, 'controller') . Hash::get($uri, 'action');

        $active = ($parsedControllerAction == $targetControllerAction) ? 'active' : '';

        $tag = '<li class="nav-item ' . $active . '">';
        $tag .= '<a class="nav-link" href="' . Router::url($uri) . '"><i class="fas fa-fw ' . $iconClass . '"></i>';
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
        $toPersonCategories = Hash::combine($gift->toPersons, '{n}.personCategory.id', '{n}.personCategory');
        $fromPersonCategories = Hash::combine($gift->fromPersons, '{n}.personCategory.id', '{n}.personCategory');
        $personCategories = $toPersonCategories + $fromPersonCategories;

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

    public function autoLink(string $text): string {
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" target="_blank">$1</a>';

        return preg_replace($pattern, $replace, $text);
    }
}
