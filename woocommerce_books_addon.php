<?php
/*
Plugin Name: woocommerce_books_addon
Plugin URI: https://github.com/Zhybuliou/woocommerce_books_addon
Description: Hi, woocommerce_books_addon is a plugin for woocommerce designed to expand the functionality of an online store for sales of books.
Version: 1.0
Author:Vitali Zhybuliou
Author URI: http://vitalizhybuliou.000webhostapp.com/
*/


 // Plugin 'woocommerce_books_addon';

add_action( 'edit_form_after_title', 'woocommerce_books_addon' );
function woocommerce_books_addon() {
	global $product, $post;
	echo '<div class="options_group" style="color:#E870FE;p{font-size: 18px;}">';
	$woocommerce_select = $_POST['_text_field'];
if( !empty( $woocommerce_select ) )
update_post_meta( $post_id, '_text_field', esc_attr( $woocommerce_select ) );
    // Author Input
	woocommerce_wp_text_input( array(
        'id'                => '_text_field',
        'style'             => 'width: 30%; background:#fff; border: solid 2px #E870FE;margin-left:5px;', 
        'label'             => __( 'Author', 'woocommerce' ),
        'placeholder'       => '',
        'custom_attributes' => array( 'required' => 'required' ),
        'description'       => __( '', 'woocommerce' ),
        'type'              => 'text',
        ) );
	// EAN Input
	woocommerce_wp_text_input( array(
   		'id'                => '_number_field',
   		'label'             => __( 'EAN', 'woocommerce' ),
   		'style'             => 'width: 30%; background:#fff; border: solid 2px #E870FE; margin-left:20px;',
   		'placeholder'       => '',
   		'description'       => __( '', 'woocommerce' ),
   		'type'              => '',
   		'custom_attributes' => array(
   		   'step' => 'any',
   		   'min'  => '0',
           ),
        ) );
	// ISBN Input
	woocommerce_wp_text_input( array(
   		'id'                => '_number_field2',
   		'label'             => __( 'ISBN', 'woocommerce' ),
   		'style'             => 'width: 30%; background:#fff; border: solid 2px #E870FE;margin-left:15px;',
   		'placeholder'       => '',
   		'description'       => __( '', 'woocommerce' ),
   		'type'              => '',
   		'custom_attributes' => array(
   		   'step' => 'any',
   		   'min'  => '0',
   		),
        ) );

	echo '</div>';
        }
    // Save input
    add_action( 'woocommerce_process_product_meta', 'art_woo_custom_fields_save', 10 );
    function art_woo_custom_fields_save( $post_id ) {
    // Save text Author
    $woocommerce_text_field = $_POST['_text_field'];
    if ( $woocommerce_text_field ) {
      update_post_meta( $post_id, '_text_field', esc_attr( $woocommerce_text_field ) );
    }
    // Save number EAN
    $woocommerce_number_field = $_POST['_number_field'];
    if ( $woocommerce_number_field ) {
      update_post_meta( $post_id, '_number_field', esc_attr( $woocommerce_number_field ) );
    }
      // Save number ISBN 
    $woocommerce_number_field = $_POST['_number_field2'];
    if ( $woocommerce_number_field ) {
      update_post_meta( $post_id, '_number_field2', esc_attr( $woocommerce_number_field ) );
    }
      }
    // Front-end 
    // Location
   add_action( 'woocommerce_single_product_summary', 'art_get_text_field_before_add_card', 5 );

   function art_get_text_field_before_add_card() {
	global $post, $product;
	$text_field     = get_post_meta( $post->ID, '_text_field', true );
	$num_field      = get_post_meta( $post->ID, '_number_field', true );
	$num_field2      = get_post_meta( $post->ID, '_number_field2', true );
	if ( $text_field ) {
		?>
		<div class="text-field" style="color:#E870FE;">
			<strong>Издательства: 
			 <?php echo $text_field; ?>
			</strong>
		</div><!-- .text-field -->
	<?php }
	if ( $num_field ) { ?>
		<div class="number-field" style="color:#E870FE;">
			<strong>EAN: 
			 <?php echo $num_field; ?>
			</strong>
		</div><!-- .number-field -->
	<?php }
	if ( $num_field2 ) { ?>
		<div class="number-field2" style="color:#E870FE;">
			<strong>ISBN: 
			 <?php echo $num_field2; ?>
			</strong>
		</div><!-- .number-field2 -->
		<?php
	 }
  }