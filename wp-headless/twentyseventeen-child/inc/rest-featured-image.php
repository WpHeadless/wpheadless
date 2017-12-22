<?php

add_action( 'init', 'rest_api_featured_image_init', 12 );

function rest_api_featured_image_init() {
  $post_types = get_post_types( array( 'public' => true ), 'objects' );

  foreach ( $post_types as $post_type ) {

    $post_type_name     = $post_type->name;
    $show_in_rest       = isset( $post_type->show_in_rest ) && $post_type->show_in_rest;
    $supports_thumbnail = post_type_supports( $post_type_name, 'thumbnail' );

    if ( $show_in_rest && $supports_thumbnail ) {
      register_rest_field( $post_type_name,
        'featured_image',
        array(
          'get_callback' => 'rest_api_featured_image_get_field',
          'schema'       => null,
        )
      );
    }
  }
}

function rest_api_featured_image_get_field( $object, $field_name, $request ) {

  if ( ! empty( $object['featured_media'] ) ) {
    $image_id = (int)$object['featured_media'];
  } else {
    return null;
  }

  $image = get_post( $image_id );

  if ( ! $image ) {
    return null;
  }

  $src = wp_get_attachment_image_src( $image->ID, 'full' );
  $featured_image = array(
    'id' => $image->ID,
    'alt' => get_post_meta( $image->ID, '_wp_attachment_image_alt', true ),
    'title' => $image->post_title,
    'caption' => $image->post_excerpt,
    'description' => $image->post_content,
    'mime_type' => $image->post_mime_type,
    'url' => $src[0],
    'width' => $src[1],
    'height' => $src[2],
    'sizes' => array(),
  );

  $image_sizes = get_intermediate_image_sizes();
  if ( $image_sizes ) {
    foreach ( $image_sizes as $image_size ) {
      $src = wp_get_attachment_image_src( $image->ID, $image_size );
      $featured_image[ 'sizes' ][ $image_size ] = $src[0];
      $featured_image[ 'sizes' ][ $image_size . '-width' ] = $src[1];
      $featured_image[ 'sizes' ][ $image_size . '-height' ] = $src[2];
    }
  }

  return $featured_image;
}
