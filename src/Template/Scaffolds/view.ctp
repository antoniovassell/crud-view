<?php
use Cake\Utility\Inflector;

?>

<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $this->get('title');?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <?php
                    $this->CrudView->setContext(${$viewVar});
                    foreach ($fields as $field => $options) {
                        if (in_array($field, array($primaryKey))) {
                            continue;
                        }

                        $output = $this->CrudView->relation($field, ${$viewVar}, $associations);

                        if ($output) {
                            echo "<dt>" . Inflector::humanize($output['alias']) . "</dt>";
                            echo "<dd>";
                            echo $output['output'];
                            echo "&nbsp;</dd>";
                        } else {
                            echo "<dt>" . Inflector::humanize($field) . "</dt>";
                            echo "<dd>";
                            echo $this->CrudView->process($field, ${$viewVar}, $options);
                            echo "&nbsp;</dd>";
                        }

                    }
                    ?>
                </dl>
            </div>
        </div>
    </div>
</div>
<?= $this->element('view/related'); ?>
