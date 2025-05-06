import './styles/main.scss';
import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();

window.addEventListener( 'DOMContentLoaded', () => {
	/**
	 * Prevents interaction states when no link is present
	 * @param {MouseEvent} ev The MouseEvent
	 */
	function preventInteractionStates( ev ) {
		/**
		 * @type {HTMLAnchorElement} anchor
		 */
		const anchor = ev.target;
		if ( anchor.getAttribute( 'href' ) === '#' ) {
			anchor.style.color = 'rgba(255,255,255,1)';
			anchor.style.pointerEvents = 'none';
			anchor.style.cursor = 'default';
			anchor.style.textDecoration = 'none';
		}
	}
	function resetInteractionStates( ev ) {
		const anchor = ev.target;
		anchor.style.pointerEvents = 'auto';
		anchor.style.cursor = 'pointer';
		anchor.style.color = '';
	}
	const footer = document.getElementById( 'footer-menu' );
	if ( footer ) {
		const links = footer.querySelectorAll( 'a' );
		links.forEach( ( link ) => {
			link.addEventListener( 'mouseover', preventInteractionStates );
			link.addEventListener( 'mouseout', resetInteractionStates );
			link.addEventListener( 'focus', preventInteractionStates );
			link.addEventListener( 'blur', resetInteractionStates );
		} );
	}
} );
