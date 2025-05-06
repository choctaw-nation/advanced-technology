# Overview

The Repo for the theme (based on bootscore).

# Changelog

## v3.0.1

-   Fixed: Font families are now declared properly, fixing the font display on Webkit

## v3.0.0

-   Added: JS handles interaction states on footer links with href === '#'
-   Added: Above-the-fold images are now eagerly loaded and ready for SPAI plugin
-   Added: Homepage now uses `lite-vimeo` package
-   Updated: Typography now matches Minor Third type scale
-   Updated: Links now have text-decoration by default (A11y)
-   Updated: Refactored CSS to use 1rem = 16px base
-   Updated: Tightened up spacing and html on elements
    -   removed / de-duplicated `.container`, `.row` declarations,
    -   consolidated page spacing to `.my-5`,
    -   Used more semantic html (a11y)
-   Updated: Refactored `single-news.php` into template parts
-   Removed: Header no longer has search icon (was previously broken)

## v2.1.0

-   Added: Github Actions now handles deploy of site
-   Updated: Webpack now removes empty js files
-   Chore: Updated packages

## v2.0

-   Total refactor of Theme Asset Loading to make in conform to CNO Template theme.
-   Heavy modifications to the `bootstrap.scss` file to reduce the amount of extra styles needed
-   Refactor markup pages for more semantic HTML5
-   npm handling of JS libraries where possible

## v1.0.1

-   Init package managers (but not config).

## v1.0

-   Init repo.
-   Init changelog.
