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
    <?php if (isset($ms_transcript) && !empty($ms_transcript)): ?>
      <div id="manuscript-viewer-transcript-pane">
          <?php foreach($ms_transcript as $i => $ms_page): ?>
            <div class="manuscript-transcript-page" id="page-<?php print $i + 1; ?>">
              <pre><?php print $ms_page; ?></pre>
            </div>
          <?php endforeach; ?>
        <?php //endif; ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
<!-- Add table of metadata values -->
<?php if (isset($metadata) && !empty($metadata)): ?>
  <div id="manuscript-metadata">
    <?php print $description; ?>
    <?php print $metadata; ?>
    <?php //  dpm($metadata); ?>
  </div>
<?php endif; ?>
