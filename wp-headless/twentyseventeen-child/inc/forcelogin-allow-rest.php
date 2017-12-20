<?php

// allow rest interface in forcelogin
remove_filter( 'rest_authentication_errors', 'v_forcelogin_rest_access', 99 );
