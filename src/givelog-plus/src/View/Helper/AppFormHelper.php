<?php
namespace App\View\Helper;

use BootstrapUI\View\Helper\FormHelper;
use Cake\Core\Configure;
use Cake\Utility\Hash;

class AppFormHelper extends FormHelper {

    public function segmentedControl($name, $options) {
        $addOptions = [
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

        return $this->control($name, array_merge($options, $addOptions));
    }
}