<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <?php
                echo $this->Form->create(${$viewVar}, ['role' => 'form', 'class' => 'form-horizontal']);
                ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->inputs($fields, $blacklist);
                    ?>
                    <div class="submit-btns">
                        <?php
                        echo $this->Form->submit('Save', ['class' => 'btn btn-primary']);
                        echo $this->Form->submit('Save & continue edit', ['class' => 'btn btn-default', 'name' => '_edit']);
                        echo $this->Form->submit('Save & create new', ['class' => 'btn btn-success', 'name' => '_add']);
                        ?>
                        <div>
                            <?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'btn btn-default']); ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<style>
    .submit-btns > div {
        display: inline;
    }
</style>
