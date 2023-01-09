<?php
/*
Plugin Name: Elementor No Spam
Description: This plugin reduces spam on Elementor forms.
Version: 1.1.5
Author: Pina Data
Author URI: https://www.pinadata.com
License: GPLv2 or later
Text Domain: elementor-no-spam
*/

// Prevent user to add an Email or URL into a textarea field (JavaScript)
function ens_prevent_urls_into_textarea() {
?>
    <script>
        ( function($) {
            $( 'textarea[id^="form-field-"]' ).keyup( function() {
                const submitBtn = $( '.elementor-form button[type="submit"]' );
			if (
				isUrl( $(this).val() )
				|| $(this).val().indexOf('@') != -1
				|| $(this).val().indexOf('www.') != -1
				|| $(this).val().indexOf('ftp.') != -1
				|| $(this).val().indexOf('http') != -1
				|| $(this).val().indexOf('.com') != -1
				|| $(this).val().indexOf('.ca') != -1
				|| $(this).val().indexOf('bit.ly') != -1
			) {
				submitBtn.prop( 'disabled', true );
			} else {
				submitBtn.prop( 'disabled', false );
			}
		});
		function isUrl(s) {
			const regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
			return regexp.test(s);
		}
        })( jQuery );
    </script>
<?php }
add_action( 'wp_footer', 'ens_prevent_urls_into_textarea' );


// Prevent user to add an URL into a textarea field (PHP)
add_action( 'elementor_pro/forms/validation/textarea', function( $field, $record, $ajax_handler ) {

	$blacklist_terms = [
		// Emails and URLs
		'@',
		'wwww.',
		'ftp.',
		'http',
		'.com',
		'.ca',
		'bit.ly',
		// Marketing services & cie.
		'free marketing',
		'Local Business Free Marketing Club',
		'generating more traffic',
		'local businesses',
		'Boost Sales',
		'Qualified Leads',
		'Are you the owner of the website',
		// Phone numbers
		'450',
		'514',
		'415',
		'418',
	];
	
	foreach ( $blacklist_terms as $term ) {
		if ( str_contains( $field['value'], $term ) !== FALSE ) {
			$ajax_handler->add_error( $field['id'], 'Invalid text, the term "' . $term . '" is not allowed.' );
			return;
		}
	}

}, 10, 3 );
    
    
// Blacklist emails
// Reference : https://github.com/elementor/elementor/issues/5616
add_action( 'elementor_pro/forms/validation/email', function( $field, $record, $ajax_handler ) {
    // validate email format
    if ( ! is_email( $field['value'] ) ) {
        $ajax_handler->add_error( $field['id'], 'Invalid Email address, it must be in the format XX@XX.XX' );
        return;
    }

    $black_list_domains = [
        'eric.jones.z.mail@gmail.com',
        'ericjonesmyemail@gmail.com',
        'scutt.kandy66@gmail.com',
	'farkas.forrest@gmail.com',
	'troiano.chloe@outlook.com',
	'elmer.zoila@gmail.com',
	'shakiluttara22@gmail.com',
	'hoinville.maximo@gmail.com',
	'zenaida.fox@outlook.com',
	'lance.marroquin@yahoo.com',
	'pena.phyllis@gmail.com',
	'shanon@customdata.shop',
	'astrid.ten@gmail.com',
	'colette.connelly@gmail.com',
	'jenifer.goff75@yahoo.com',
	'rosaline.cash@gmail.com',
	'jason.cosh@googlemail.com',
	'ewan.siddins@gmail.com',
	'pugh.virgie@outlook.com',
	'tahlia.fortner@yahoo.com',
	'picot.shavonne@hotmail.com',
	'straub.aracelis@gmail.com',
	'clara.baer53@gmail.com',
	'mcinnis.rosalyn@gmail.com',
	'serrano.angelita@yahoo.com',
	'reliablecomputerhelper@gmail.com',
	'ola.luevano45@gmail.com',
	'carlos.carnahan44@gmail.com',
	'fogle.erica@hotmail.com',
	'hilliard.sammy@gmail.com',
	'medders.rosalinda@gmail.com',
	'blubaugh.melisa@googlemail.com',
	'cammack.ian@googlemail.com',
	'pryor.wolfgang15@outlook.com',
	'mabel.bushell@gmail.com',
	'cedric@getlisted.directory',
	'lou@pictorysoft.com',
	'mcguinness.dee@gmail.com',
	'bernie.cooney51@msn.com',
	'harold.white@yahoo.com',
	'wildermuth.sebastian@gmail.com',
	'jimbradley877@gmail.com',
	'maggie93@gmail.com',
	'ariana@oborku.com',
	'steve.jndyg@slmail.me',
	'fenner.margarita@gmail.com',
	'jina.strub@hotmail.com',
	'nilda.weber@gmail.com',
	'marmion.dominik50@gmail.com',
	'norris.brereton80@msn.com',
	'noemi.monash@gmail.com',
	'kidston.elaine@gmail.com',
	'buckmaster.keith@gmail.com',
	'leila@getlisted.directory',
	'windy.remley@hotmail.com',
	'oma.gurner@gmail.com',
	'jacob.mahoney43@hotmail.com',
	'fornachon.hollie9@msn.com',
	'sceusa.angeline97@gmail.com',
	'loos.kian@gmail.com',
	'jody.saddler@gmail.com',
	'gerardo.steffan82@gmail.com',
	'inman.avis@gmail.com',
	'barreto.geraldo@hotmail.com',
	'hely.berniece53@gmail.com',
	'automateddigitalmarketer@gmail.com',
	'latoya.prins@hotmail.com',
	'hacking.jolene@hotmail.com',
	'kate@aiwealthcourse.com',
	'ardis.zox@yahoo.com',
	'merriam.stacie@outlook.com',
	'grace.lansell@hotmail.com',
	'mosby.ingrid@googlemail.com',
	'inquiry@automationdad.com',
	'marketing@automationdad.com',
	'tryjasperbot@gmail.com',
	'eharrison@globalrealestate.com',
	'plumb.angelica@gmail.com',
	'earnnetwork381@gmail.com',
	'reliablewebsiteranker@gmail.com',
	'derektexas1111@proton.me',
	'ajeng_kuswoyo@tf-info.com',
	'gordonb95@yahoo.com',
	'isobel72@hotmail.com',
	'ajeng_kuswoyo@tf-info.com',
	'aniya_bergnaum20@tf-info.com',
	'gordonb95@yahoo.com',
	'clint_hudson79@tf-info.com',
	'mathewblochgetsitdone@gmail.com',
    ];

    $email_domain = $field['value'];

    if ( in_array( $email_domain, $black_list_domains ) ) {
        $ajax_handler->add_error( $field['id'], 'Invalid Email address, emails from the domain ' . $email_domain . ' are not allowed.' );
        return;
    }
}, 10, 3 );
