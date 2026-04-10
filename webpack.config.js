const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
const path = require( 'path' );

const THEME_NAME = 'advanced-technology';
const THEME_DIR = `/wp-content/themes/${ THEME_NAME }`;

/**
 * Array of strings modeled after folder names (e.g. 'about-choctaw'). Inside of these folders, an `index.ts` file is expected. If that's not what you want, consider editing the `addEntries` function below.
 *
 * **Be sure to import page scss in these files**
 */
const appNames = [ 'front-page', 'gallery' ];

/**
 * For SCSS files (no leading `_`)
 * Array of strings modeled after scss names (e.g. 'we-are-choctaw')
 */
const styleSheets = []; // for scss only
const blockEditor = [ 'editDefaultBlocks' ];

module.exports = {
	...defaultConfig,
	...{
		resolve: {
			...defaultConfig.resolve,
			alias: {
				'@': path.resolve( __dirname, `${ THEME_DIR }/src/` ),
			},
		},
		entry() {
			/** Custom entry points */
			const entries = {
				...defaultConfig.entry(),
				global: `.${ THEME_DIR }/src/index.ts`,
				'vendors/bootstrap': `.${ THEME_DIR }/src/js/vendors/bootstrap.js`,
				...addEntries( appNames, 'pages' ),
				...addEntries( styleSheets, 'styles' ),
				...addEntries( blockEditor, 'admin' ),
			};
			return entries;
		},

		output: {
			path: __dirname + `${ THEME_DIR }/dist`,
			filename: `[name].js`,
		},
	},
};

/**
 * Helper function to add entries to the entries object. It takes an array of strings in either kebab-case or snake_case and returns an object with the key as the entry name and the value as the path to the entry file.
 * @param {Array}  array - Array of strings
 * @param {string} type  - The type of entry. Either 'pages' or 'styles'
 */
function addEntries( array, type ) {
	if ( ! Array.isArray( array ) ) {
		throw new Error( `Expecting an array, received ${ typeof array }!` );
	}
	if ( 0 >= array.length ) {
		return {};
	}
	const entries = {};
	const typeOutput = {
		styles: {
			outputDir: ( assetOutput ) => `pages/${ assetOutput }`,
			path: ( asset ) =>
				`.${ THEME_DIR }/src/styles/pages/${ asset }.scss`,
		},
		pages: {
			outputDir: ( assetOutput ) => `pages/${ assetOutput }`,
			path: ( asset ) => `.${ THEME_DIR }/src/js/${ asset }/index.ts`,
		},
		admin: {
			outputDir: ( assetOutput ) => `admin/${ assetOutput }`,
			path: ( asset ) => `.${ THEME_DIR }/src/js/gutenberg/${ asset }.ts`,
		},
	};
	array.forEach( ( asset ) => {
		const assetOutput = snakeToCamel( asset );

		if ( Object.hasOwn( typeOutput, type ) ) {
			const output = typeOutput[ type ];
			entries[ output.outputDir( assetOutput ) ] = output.path( asset );
		} else {
			throw new Error(
				`Invalid type! Expected one of ${ Object.keys(
					typeOutput
				).join( ', ' ) }, received "${ type }"`
			);
		}
	} );
	return entries;
}

/**
 * A simple utility class to alter strings from kebab-case or snake_case to camelCase
 *
 * @param {string} str - The string to be converted
 */
function snakeToCamel( str ) {
	return str.replace( /([-_][a-z])/g, ( group ) =>
		group.toUpperCase().replace( '-', '' ).replace( '_', '' )
	);
}
