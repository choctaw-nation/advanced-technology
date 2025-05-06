<?php
/**
 * Boilerplates for News Articles
 *
 * @package ChoctawNation
 */

?>
<div class="mt-4 w-100 d-flex justify-content-end">
	<div class="tab-top bg-secondary"></div>
</div>
<div class="bg-secondary py-5">
	<div class="container">
		<section>
			<h3>About the UAS IPP Program</h3>
			<p>The Unmanned Aircraft System (UAS) Integration Pilot Program (IPP) is an opportunity for state, local, and tribal governments to partner with private
				sector entities, such as UAS operators or manufacturers, to accelerate safe UAS integration. The program will help the U.S. Department of
				Transportation (USDOT) and Federal Aviation Administration (FAA) craft new enabling rules that allow more complex low-altitude UAS operations by:</p>
			<ul>
				<li>Identifying ways to balance local and national interests related to UAS integration</li>
				<li>Improving communications with local, state and tribal jurisdictions</li>
				<li>Addressing security and privacy risks</li>
				<li>Accelerating the approval of operations that currently require special authorizations</li>
			</ul>
			<p>The program is expected to foster a meaningful dialogue on the balance between local and national interests related to UAS integration, and provide
				actionable information to the USDOT on expanded and universal integration of UAS into the National Airspace System.</p>
		</section>
		<hr />
		<section>
			<h3>About the Choctaw Nation of Oklahoma</h3>
			<p>The Choctaw Nation is the third-largest Indian Nation in the United States with more than 225,000 tribal members and 12,000-plus associates. This
				ancient people has an oral tradition dating back over 13,000 years. The first tribe over the Trail of Tears, its historic reservation boundaries are
				in the southeast corner of Oklahoma, covering 10,923 square miles. The Choctaw Nation's vision, "Living out the Chahta Spirit of faith, family and
				culture," is evident as it continues to focus on providing opportunities for growth and prosperity. For more information about the Choctaw Nation, its
				culture, heritage, and traditions, please visit <a href="https://www.choctawnation.com/" target="_blank" rel="noreferrer noopener">choctawnation.com</a>.</p>
		</section>
		<section>
			<h3>Inquiries</h3>
			<p>Contact Kristina Humenesky for any media relations needs at <a href="mailto:khumensky@choctwnation.com">khumensky@choctwnation.com</a></p>
		</section>

		<?php
		$additional_boilerplates = get_field( 'additional_boilerplates' );
		if ( $additional_boilerplates ) :
			foreach ( $additional_boilerplates as $additional_boilerplate ) :
				$media_inquiry = acf_esc_html( get_field( 'media_inquiry', $additional_boilerplate->ID ) );
				?>
		<hr />
		<section class="py-3">
			<h3>About <?php echo get_the_title( $additional_boilerplate->ID ); ?></h3>
			<p><?php the_field( 'about_company', $additional_boilerplate->ID ); ?></p>
			<?php echo $media_inquiry ? "<h3>Media Inquiries</h3><p>{$media_inquiry}</p>" : ''; ?>
		</section>
		<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>