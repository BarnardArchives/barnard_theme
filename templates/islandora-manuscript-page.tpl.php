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
<?php if (isset($ms_pager)): ?>
  <p>
    <strong>Pages:</strong>
    <?php print $ms_pager; ?>
  </p>
<?php endif; ?>
<?php if (isset($ms_transcript)): ?>
  <p>
    <a id="manuscript-transcript-toggle" href="#">Show transcript</a>
  </p>
<?php endif; ?>
<?php if (isset($viewer)): ?>
  <div id="manuscript-viewer">
    <div id="manuscript-viewer-osd-pane">
      <?php print $viewer; ?>
    </div>
    <?php if (isset($ms_transcript)): ?>
      <div id="manuscript-viewer-transcript-pane">
        <pre>
          <?php print $ms_transcript; ?>
        </pre>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
<!-- @todo Add table of metadata values -->
