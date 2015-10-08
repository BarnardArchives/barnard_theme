# Barnard Theme

Custom visual design and template logic for [Barnard Digital Collections](http://digitalcollections.barnard.edu). Developed by [Discovery Garden](https://github.com/discoverygarden) with additional contributions from [Dillon Savage](http://github.com/dillonsavage).

# Dependencies

* [bc_islandora](http://github.com/BarnardArchives/bc_islandora)
* [Compass](http://compass-style.org/)
* [Service links](https://www.drupal.org/project/service_links)
* [Zen](https://www.drupal.org/project/zen)

# Template logic

The theme implements [preprocess functions](https://www.drupal.org/node/223430) to generate output for corresponding templates:

* `barnard_theme_preprocess_page()`
  * If `bc_islandora` exists and the page is the front page, invokes `_bc_islandora_featured()` to generate footer text.
  * If `bc_islandora` exists and the page is not the front page or a search result, invokes `theme_bc_islandora_breadcrumb()`.
  * If `service_links` exists, invokes `service_links_render()` to generate social media links.
  * If `bc_islandora` exists and the page is an exhibit node, adds exhibit JavaScript and CSS.
* `barnard_theme_preprocess_node()`
  * If `bc_islandora` exists and the node is an exhibit, invokes `theme_bc_islandora_exhibition()`.
* `barnard_theme_preprocess_islandora_basic_collection_wrapper()`
  * If the object is a student publication, sets a special variable.
* `barnard_theme_preprocess_islandora_book_book()`
  * If `bc_islandora` exists, provides alternate download links via `_bc_islandora_dl_links()`.
  * Unused feature: checks whether the book is actually a "document" (`_bc_islandora_is_document()`) and themes as a newspaper issue if so.
* `barnard_theme_preprocess_islandora_book_page()`
  * If `bc_islandora` exists, provides alternate download links via `_bc_islandora_dl_links()`.
* `barnard_theme_preprocess_islandora_large_image()`
  * If `bc_islandora` exists, provides alternate download links via `_bc_islandora_dl_links()`.
* `barnard_theme_islandora_newspaperpagecmodel_islandora_solr_object_result_alter()`
  * Prevents a long list of query parameters from being included in search result URLs.
* `barnard_theme_islandora_bookCModel_islandora_solr_object_result_alter()`
  * Add page viewing fragment and search term to show all search results within book on page load.
* `barnard_theme_islandora_pageCModel_islandora_solr_object_result_alter()`
  * Replaces the url for the search result to be the book's url, not the page. The page is added as a fragment at the end of the book url.

# To do

* Improve this document
* Improve mobile/responsive behavior