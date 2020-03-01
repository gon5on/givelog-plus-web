<?php
namespace App\View\Helper;

use BootstrapUI\View\Helper\FormHelper;
use Cake\Core\Configure;
use Cake\Utility\Hash;

/**
 * AppForm helper
 */
class AppFormHelper extends FormHelper
{
    /**
     * セグメントコントロール
     *
     * @param string $title
     * @param array $uri
     * @param string $icon_class
     * @return string $tag
     */
    public function segmentedControl($name, $options)
    {
        $add_options = [
            'type' => 'radio',
            'hiddenField' => false,
            'templates' => [
                'radioContainer' => '
                    <div class="form-group">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    {{content}}{{help}}
                    </div>
                    </div>',
                'radioContainerError' => '
                    <div class="form-group">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    {{content}}{{error}}{{help}}
                    </div>
                    </div>',
               'radioWrapper' => '
                   <label class="btn btn-secondary">{{hidden}}{{label}}</label>',
            ]
        ];

        return $this->control($name, array_merge($options, $add_options));
    }
}