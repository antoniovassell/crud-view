<?php
foreach ($fields as $field => $options) {
    ?>
    <td class="text-nowrap"><?= $this->CrudView->process($field, $singularVar, $options); ?></td>
    <?php
}
