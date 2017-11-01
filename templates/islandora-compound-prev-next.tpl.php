<?php

/**
 * @file
 * Barnard College modified islandora-compound-object-prev-next.tpl.php.
 *
 * @TODO: needs documentation about file and variables
 * $parent_label - Title of compound object
 * $child_count - Count of objects in compound object
 * $parent_url - URL to manage compound object
 * $previous_pid - PID of previous object in sequence or blank if on first
 * $next_pid - PID of next object in sequence or blank if on last
 * $siblings - array of PIDs of sibling objects in compound
 * $themed_siblings - array of siblings of model
 *    array(
 *      'pid' => PID of sibling,
 *      'label' => label of sibling,
 *      'TN' => URL of thumbnail or default folder if no datastream,
 *      'class' => array of classes for this sibling,
 *    )
 *
 * Barnard Added Variables - @blame br2490 github.
 * $current_inclusion - you guessed it! the current inclusion. (unused?)
 * $themed_siblings - (merged with above)
 *  array(
 *      'return_page' => return path or (int) for URL fragment generation.
 * (currently using integers.)
 *      'inclusion_page' => (int) the page this inclusion is found on in the
 * parent.
 */
?>
<div class="islandora-compound-prev-next">
    <span class="islandora-compound-title">Inclusions</span>
  <?php if ($parent_url): ?>
      <br><span
              class="islandora-compound-manage"><?php print l(t('Manage Compound'), $parent_url); ?></span>
  <?php endif; ?>
    <div class="islandora-compound-details">
      <?php if ($parent_tn): ?>
        <?php print l(
          theme_image(
            [
              'path' => $parent_tn,
              'attributes' => [],
            ]
          ),
          'islandora/object/' . $parent_pid,
          ['html' => TRUE]
        ); ?>
      <?php endif; ?>
    </div>
  <?php if (count($themed_siblings) > 0): ?>
      <div class="islandora-compound-thumbs">
        <?php foreach ($themed_siblings as $sibling): ?>
            <div class='islandora-compound-thumb <?php print(implode(" ", $sibling['class'])); ?>'>
              <?php
              print l(
                theme_image(
                  [
                    'path' => $sibling['TN'],
                    'attributes' => ['class' => $sibling['class']],
                  ]
                ),
                'islandora/object/' . $sibling['pid'],
                ['html' => TRUE]
              ); ?>
                <span class='islandora-compound-caption'><?php print $sibling['label']; ?></span>
            </div>
        <?php endforeach; // each themed_siblings ?>
      </div> <!-- // islandora-compound-thumbs -->
  <?php endif; // count($themed_siblings) > 0 ?>
</div>