<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="index scaffold-view">
                    <?php
                    $this->append('search');
                        echo $this->element('search');
                    $this->end();

                    echo $this->fetch('search');
                    ?>

                    <br />

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th class="text-nowrap"><?= __d('crud', 'Actions'); ?></th>
                                    <?php
                                    foreach ($fields as $field => $options) :
                                        ?>
                                        <?= $this->Paginator->sort($field, null, $options); ?>
                                        <?php
                                        endforeach;
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach (${$viewVar} as $singularVar) :
                                    ?>
                                    <tr>
                                        <td class="actions text-nowrap"><?= $this->element('index/table_actions', compact('singularVar')); ?></td>
                                        <?= $this->element('index/table_columns', compact('singularVar')); ?>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?= $this->element('index/pagination'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
