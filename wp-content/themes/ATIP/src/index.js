import './styles/main.scss';
import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();

window.addEventListener( 'DOMContentLoaded', () => {
	const footerMenu = document.getElementById( 'footer-menu' );

	function preventInteractionState( ev ) {
		const { target } = ev;
		if ( target.tagName === 'A' && target.getAttribute( 'href' ) === '#' ) {
			target.style.color = 'white';
			target.style.pointerEvents = 'none';
			target.style.cursor = 'default';
			target.style.textDecoration = 'none';
		}
	}

	function resetInteractionState( ev ) {
		const { target } = ev;
		if ( target.tagName === 'A' && target.getAttribute( 'href' ) === '#' ) {
			target.style.color = '';
			target.style.pointerEvents = '';
			target.style.cursor = '';
			target.style.textDecoration = '';
		}
	}
	footerMenu.addEventListener( 'mouseover', preventInteractionState );
	footerMenu.addEventListener( 'mouseout', resetInteractionState );
	footerMenu.addEventListener( 'focus', preventInteractionState );
	footerMenu.addEventListener( 'blur', preventInteractionState );
} );
