<?php
/**
 * @file
 * Template file to style output.
 */
?>
<?php if (isset($letter) && $letter): ?>

<?php endif; ?>
<?php if (isset($dl_links) && !empty($dl_links)): ?>
  <p>
    <strong>Download:</strong>
    <?php print $dl_links; ?>
  </p>
<?php endif; ?>
<?php if (isset($viewer)): ?>
  <div id="book-viewer">
    <?php print $viewer; ?>
  </div>
<?php endif; ?>
<?php if (isset($metadata) && !empty($metadata)): ?>
  <div class="islandora-large-image-metadata">
    <?php print $metadata; ?>
  </div>
<?php endif; ?>
<!-- @todo Add table of metadata values -->
