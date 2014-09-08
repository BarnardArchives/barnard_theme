<?php
/**
 * @file
 * Displays the newspaper page controls.
 */
?>
<div class="islandora-newspaper-controls">
  <?php //print theme('item_list', array('items' => $controls, 'attributes' => array('class' => array('items', 'inline')))); ?>
  <?php print theme('bc_islandora_newspaper_page_controls', array('object' => $object)); ?>
</div>
