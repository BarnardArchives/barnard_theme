<?php

/**
 * @file
 */
?>
<div class="islandora-newspaper-object clearfix">
  <span class="islandora-newspaper-issue-navigator">
    <?php if (module_exists('bc_islandora')): ?>
      <?php print theme('bc_islandora_newspaper_issue_navigator', array('object' => $object)); ?>
    <?php else: ?>
      <?php print theme('islandora_newspaper_issue_navigator', array('object' => $object)); ?>
    <?php endif; ?>
  </span>
  <?php if ($viewer_id == 'islandora_internet_archive_bookreader' || module_exists('bc_islandora')): ?>
    <?php print $viewer; ?>
  <?php else: ?>
    <?php print theme('islandora_objects', array('objects' => $pages)); ?>
  <?php endif; ?>
</div>
