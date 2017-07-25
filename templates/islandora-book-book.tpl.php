<?php
/**
 * @file
 * Template file to style output.
 */
?>
<?php // Provide datastream download links, if available. ?>
<?php if (isset($dl_links) && !empty($dl_links)): ?>
  <p>
    <strong>Download:</strong>
    <?php print $dl_links; ?>
  </p>
<?php endif; ?>
<?php if (isset($viewer)): ?>
  <div id="return-to-page"></div>
  <div id="book-viewer">
    <?php print $viewer; ?>
  </div>
<?php endif; ?>
<?php if (isset($metadata) && !empty($metadata)): ?>
  <div class="islandora-large-image-metadata">
    <?php print $description; ?>
    <?php print $metadata; ?>
  </div>
<?php endif; ?>
