import './styles/main.scss';

( function() {
	/**
	 * Sets the Gravity Forms inquiry-type select (`#input_1_7`) inside `#modal-range-time`
	 * to "Range Time Inquiry" and fires the necessary native and jQuery change events.
	 * Returns `true` on success, `false` if the select element is not yet in the DOM.
	 */
	function setRangeTimeInquiry() {
		const select = document.querySelector<HTMLSelectElement>( '#modal-range-time #input_1_7' );
		if ( ! select ) {
			return false;
		}

		select.value = 'Range Time Inquiry';

		select.dispatchEvent( new Event( 'input', { bubbles: true } ) );
		select.dispatchEvent( new Event( 'change', { bubbles: true } ) );

		if ( window.jQuery ) {
			jQuery( select ).val( 'Range Time Inquiry' ).trigger( 'change' );
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
		if ( ( event.target as Element | null )?.id !== 'modal-range-time' ) {
			return;
		}
		setRangeTimeInquiry();
	} );
}() );

( function() {
	/**
	 * Opens the `#modal-range-time` Bootstrap modal when the URL hash is `#range-time`,
	 * then pre-selects "Range Time Inquiry" in the Gravity Forms select after a short delay.
	 * Runs on `DOMContentLoaded` and on every `hashchange` event.
	 */
	function openRangeTimeModal() {
		if ( window.location.hash !== '#range-time' ) {
			return;
		}

		const trigger = document.querySelector(
			'.cno-modal-trigger[data-bs-target="#modal-range-time"]'
		);

		if ( ! trigger ) {
			return;
		}

		( trigger as HTMLElement ).click();

		setTimeout( function() {
			const select = document.querySelector<HTMLSelectElement>(
				'#modal-range-time #input_1_7'
			);
			if ( ! select ) {
				return;
			}

			select.value = 'Range Time Inquiry';
			select.dispatchEvent( new Event( 'change', { bubbles: true } ) );

			if ( window.jQuery ) {
				jQuery( select )
					.val( 'Range Time Inquiry' )
					.trigger( 'change' );
			}
		}, 400 );
	}

	document.addEventListener( 'DOMContentLoaded', openRangeTimeModal );
	window.addEventListener( 'hashchange', openRangeTimeModal );
}() );

( function() {
	/**
	 * Opens the `#modal-contact-us` Bootstrap modal when the URL hash is `#contact-us`.
	 * Runs on `DOMContentLoaded` and on every `hashchange` event.
	 */
	function openContactUsModal() {
		if ( window.location.hash !== '#contact-us' ) {
			return;
		}

		const trigger = document.querySelector(
			'.cno-modal-trigger[data-bs-target="#modal-contact-us"]'
		);

		if ( ! trigger ) {
			return;
		}

		( trigger as HTMLElement ).click();
	}

	document.addEventListener( 'DOMContentLoaded', openContactUsModal );
	window.addEventListener( 'hashchange', openContactUsModal );
}() );
