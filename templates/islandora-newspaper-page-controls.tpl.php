<?php
/**
 * @file
 * Displays the newspaper page controls.
 */
?>
<div class="islandora-newspaper-controls">
  <?php // If we have bc_islandora, use its theme method. ?>
  <?php if (module_exists('bc_islandora')): ?>
    <?php print theme('bc_islandora_newspaper_page_controls', array('object' => $object)); ?>
  <?php else: ?>
    <?php print theme('item_list', array('items' => $controls, 'attributes' => array('class' => array('items', 'inline')))); ?>
  <?php endif; ?>
</div>
