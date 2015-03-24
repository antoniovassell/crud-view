<?php if (isset($singularHumanName )) : ?>
<?php

$links = [
    __('Add ' . $singularHumanName) => [
        'url' => ['controller' => $pluralVar, 'action' => 'add'],
        'fa' => 'plus',
        'options' => ['escape' => false]
    ]
];

foreach ($associations as $associationType) {
    foreach ($associationType as $assocModelName => $assocModel) {
        $links[__('List ' . \Cake\Utility\Inflector::humanize($assocModelName))] = [
            'url' => ['controller' => $assocModelName, 'action' => 'index'],
            'fa' => 'plus',
            'options' => ['escape' => false]
        ];
    }
}
?>
<div class="btn-group pull-right">
    <button type="button" class="btn btn-danger"><?= __('Menu Actions'); ?></button>
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <?php foreach ($links as $link => $linkConfig): ?>
            <li><?= $this->Html->link('<i class="fa fa-' . $linkConfig['fa'] . '"></i> ' . $link, $linkConfig['url'], $linkConfig['options']); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<ul class="nav nav-pills nav-stacked">
    <?php
    $models = \Cake\ORM\TableRegistry::config();

    ksort($models);

    foreach ($models as $model => $config) {
        if (false !== strpos($model, 'AppModel')) {
            continue;
        }
        ?>
        <li><?= $this->Html->link(\Cake\Utility\Inflector::pluralize($model), array('controller' => \Cake\Utility\Inflector::underscore(\Cake\Utility\Inflector::pluralize($model)), 'action' => 'index')); ?></li>
    <?php
    }
    ?>
</ul>
<?php endif;
