<?php

if ( !is_admin() ) return;
add_filter( 'use_block_editor_for_post', '__return_false', 10 );
