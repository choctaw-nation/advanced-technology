# Overview

The Repo for the theme (based on bootscore).

# Changelog

## v4.0.3 - [December 16, 2025]

-   Fixed: Removed conflicting asset loading and added appropriate `crossorigin` attribute

## v4.0.2 - [December 4, 2025]

-   Tweak: Add Core Web Vitals Configs to Theme_Init
-   Chore: Add Lints and Configs
-   Chore: Update Packages

## v4.0.1

-   Fixed: Staff CTA button
-   Fixed: Set the `is_even_index` variable with modulo operator instead of toggling a boolean value

## v4.0.0

-   Breaking: Namespaced classes
-   Added: Gravity Forms Handler
-   Updated: Files are all loaded via `theme-init` class
-   Fixed: Gravity Forms Submit button has the correct styling
-   Fixed: Overflow/gutter issues on mobile are corrected on `/news`
-   Fixed: Bootstrap Buttons have expected hover effects

## v3.1.2

-   Fixed: Breadcrumbs are now properly accessible

## v3.1.1

-   Fixed: Spacing is tightened up
-   Fixed: ACF fields are properly escaped
-   Fixed: Links now use `stretched-link` pattern (a11y)
-   Updated: Text now uses `text-wrap:pretty` by default

## v3.1.0

-   Updated: Above-the-fold images are loaded eagerly

## v3.0.1

-   Fixed: Type scale added for headings
-   Fixed: Links only have underlines where appropriate
-   Fixed: Nav links are styled correctly
-   Fixed: Footer nav links only hover if links are not '#'

## v3.0.0

-   Breaking: Updated Bootstrap CSS
    -   1rem = 16px instead of 1rem = 10px
    -   Updated Typography (type scale, text decoration on links)
    -   Updated Bootstrap colors
    -   Used namespaced sass modules instead of deprecated global modules (e.g. `map.get()` instead of `map-get()`)
-   Breaking: Removed unused Bootscore scss partials
-   Breaking: Swapped custom utilities (e.g. `text-lightgreen`) with Bootstrap native utilities
-   Updated: Swapped custom css for CSS utilities where possible

## v2.1.2

-   Chore: PHPCS checks pass

## v2.1.1

-   Chore: Removed unused code, flattened files (aka moved bootscore setup to theme-init file)
-   Chore: Replace bootscore functions with default WordPress functions

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
