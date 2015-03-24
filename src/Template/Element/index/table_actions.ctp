<?php
use Cake\Utility\Inflector;

$actionIcons = \Cake\Core\Configure::read('ActionIcons');
echo '<div class="" role="group" aria-label="...">';
foreach ($tableActions as $action) {
    echo $this->Html->link(
        '<i class="fa fa-' . $actionIcons[$action]['fa'] . '"></i>',
        ['action' => $action, $singularVar->id],
        [
            'class' => 'btn btn-xs ' . $actionIcons[$action]['class'],
            'style' => 'margin-right: 5px;',
            'escape' => false
        ]
    );
}
echo '</div>';
