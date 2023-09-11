# Changelog

## 0.5.6 (2023-09-11)

* Fix: no password reset emails to admin - [use correct filter](https://developer.wordpress.org/reference/functions/wp_password_change_notification/), don't disable it [for user](https://developer.wordpress.org/reference/hooks/send_password_change_email/).

## 0.5.5 (2023-08-09)

* Set default image size.
* Add custom post type to ACF post type select.
* Add custom login Image.
* Cleanup dashboard.
* Add inline script.
* Remove theme support.
* Allow to undergister patterns and categories.
* New FA icons
* Fix loading editor styles in Gutenberg iframe in 6.3 and newer
* Fix no block defaults
* ACF add loadJson function (load from parent instead of child etc.)
* Array fce append after

## 0.5.4 (2023-06-26)

* Extend Archive behavior and handle sticky posts within the standard loop posts_per_page if possible.
* Fix decoding=async issue.

## 0.5.3 (2023-06-13)

* Add core/butttons + core/button to ConstructBlock
* Refactor ConstructBlock class for better handling
* Add ConstructACfBlock helper
* Recursive check for H1 in the content
* Add the possibility to register only the selected script or style but not enqueue
* Allow negative conditions to load script/style and make it available for dequeuing.

## 0.5.2 (2023-04-25)

* Fluent Forms - filter to keep only one IP address (hotfix FF bugu)

## 0.5.1 (2023-03-06)

* Add disable password reset e-mails function.
* Allow to call SanitizeFilenames function separately (instead of theme_default var)

## 0.5.0 (2023-01-31)

* Set uncompressed image quality per theme default.
* Archive updates on after_setup_theme hook.
* ⚠ Rename SaveTheHTML to ConstructBlock class and add core/paragraph (used in block patterns)

## 0.4.2 (2022-09-13)

* Add taxonomy filter function in CustomTaxonomies

## 0.4.1 (2022-08-04)

* Fix namespace.

## 0.4.0 (2022-08-04)

* Fix issue with `false` values in CustomTaxonomy class (esp. `public` parameter can be set to `false` etc.)
* Styles & scripts enqueuing
* Disable template block editor (FSE)
* Show all - cpts or taxonomy
* Order by all - cpts or taxonomy
* Show thumbnail in admin column
* Disable XMLRPC
* Database helper (create DB, get or download CSV from table)

## 0.3.2 (2022-04-08)

* Allow styles to be loaded conditionaly
* Fix typo in doc comment

## 0.3.1 (2022-03-28)

* Fix: ACF supports - add bool
* New: Register block patterns
* Additional SVGs in FA icons
* ACF\Blocks:
  * Sort registered blocks by title
  * Add shorthand - setExampleData()
  * TemplateLocks
* Arrays remove by value
* Save block helpers
* Unregister taxonomy
* Fix and simplify ACF options loading function

## 0.3.0 (2022-03-07)

* ReflectionPropertyExtractor.php
* Fix: Archive: Load X more posts on is_home() first page
* Gutenberg: disable empty paragraph blocks

## 0.2.0 (2022-02-15)

* ⚠ addImageSize -> move name to the last parameter
* FluentForms - do_shortcode in Terms & Conditions
* Disable editor fullscreen mode
* Archive settings
  * Show all
  * Order by
  * Archive only
  * Don't show "archive" in title
  * Load X more posts on is_home() first page
* Fix options
* Gutenberg setup:
  * Fix quotes
  * Reveal Reusable posts in menu
  * Disable directory search
  * Disable layout
  * Disable render global styles
* FontAwesome new icons:
  * Download
* Helpers
  * WP: get blog ID, get blog title
  * Strings: startsWith, endsWidth
* Theme - disable jQuery migrate only on frontend
* ACF basic setup helper
* ACF block classes helper


## 0.1.0 (2022-01-26)

* Initial release (jsmprf version).
