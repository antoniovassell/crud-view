<div class="row">
    <div class="col-md-6">
        <?= $this->Paginator->counter(); ?>
    </div>
    <div class="dataTables_paginate paging_bootstrap col-md-6">
        <?php
        if ($this->Paginator->hasPage(2)) {
            ?>
            <ul class="pagination pull-right">
                <?= $this->Paginator->prev('PREV'); ?>
                <?= $this->Paginator->numbers(); ?>
                <?= $this->Paginator->next('NEXT'); ?>
            </ul>
        <?php
        }
        ?>
    </div>
</div>
