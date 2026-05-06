import './styles/main.scss';

const RANGE_TIME_MODAL_SELECTOR = '#modal-range-time-inquiry';
const RANGE_TIME_TRIGGER_SELECTOR = '.cno-modal-trigger[data-bs-target="#modal-range-time-inquiry"]';
const RANGE_TIME_INQUIRY_SELECTOR = `${ RANGE_TIME_MODAL_SELECTOR } #input_1_7`;
const RANGE_TIME_INQUIRY_VALUE = 'Range Time Inquiry';

( function() {
	/**
	 * Sets the Gravity Forms inquiry-type select (`#input_1_7`) inside the range-time modal
	 * to "Range Time Inquiry" and fires the necessary native and jQuery change events.
	 * Returns `true` on success, `false` if the select element is not yet in the DOM.
	 */
	function setRangeTimeInquiry() {
		const select = document.querySelector<HTMLSelectElement>( RANGE_TIME_INQUIRY_SELECTOR );
		if ( ! select ) {
			return false;
		}

		select.value = RANGE_TIME_INQUIRY_VALUE;

		select.dispatchEvent( new Event( 'input', { bubbles: true } ) );
		select.dispatchEvent( new Event( 'change', { bubbles: true } ) );

		if ( window.jQuery ) {
			jQuery( select ).val( RANGE_TIME_INQUIRY_VALUE ).trigger( 'change' );
		}

		return true;
	}

	document.addEventListener( 'click', function( event ) {
		const target = event.target as Element | null;
		const button = target?.closest( '.js-range-time' );
		if ( ! button ) {
			return;
		}

		let tries = 0;
		const timer = setInterval( function() {
			tries++;

			if ( setRangeTimeInquiry() || tries > 30 ) {
				clearInterval( timer );
			}
		}, 100 );
	} );

	document.addEventListener( 'shown.bs.modal', function( event ) {
		if ( ( event.target as Element | null )?.id !== 'modal-range-time-inquiry' ) {
			return;
		}
		setRangeTimeInquiry();
	} );
}() );

( function() {
	/**
	 * Opens the range-time inquiry Bootstrap modal when the URL hash is `#range-time`,
	 * then pre-selects "Range Time Inquiry" in the Gravity Forms select after a short delay.
	 * Runs on `DOMContentLoaded` and on every `hashchange` event.
	 */
	function openRangeTimeModal() {
		if ( window.location.hash !== '#range-time' ) {
			return;
		}

		const trigger = document.querySelector( RANGE_TIME_TRIGGER_SELECTOR );

		if ( ! trigger ) {
			return;
		}

		( trigger as HTMLElement ).click();

		setTimeout( function() {
			const select = document.querySelector<HTMLSelectElement>( RANGE_TIME_INQUIRY_SELECTOR );
			if ( ! select ) {
				return;
			}

			select.value = RANGE_TIME_INQUIRY_VALUE;
			select.dispatchEvent( new Event( 'change', { bubbles: true } ) );

			if ( window.jQuery ) {
				jQuery( select )
					.val( RANGE_TIME_INQUIRY_VALUE )
					.trigger( 'change' );
			}
		}, 400 );
	}

	document.addEventListener( 'DOMContentLoaded', openRangeTimeModal );
	window.addEventListener( 'hashchange', openRangeTimeModal );
}() );

( function() {
	let scrollBeforeModal = 0;

	document.addEventListener( 'show.bs.modal', function( event ) {
		if ( ! event.target.matches( '.modal' ) ) {
			return;
		}

		// Save where the user was before the modal opened
		scrollBeforeModal = window.scrollY || window.pageYOffset;
	} );

	document.addEventListener( 'hidden.bs.modal', function( event ) {
		if ( ! event.target.matches( '.modal' ) ) {
			return;
		}

		// Remove hash like #contact-us or #modal-contact-us without scrolling
		if ( window.location.hash ) {
			history.replaceState(
				null,
				document.title,
				window.location.pathname + window.location.search
			);
		}

		// Restore the original scroll position after Bootstrap closes
		window.scrollTo( {
			top: scrollBeforeModal,
			left: 0,
		} );
	} );
}() );
