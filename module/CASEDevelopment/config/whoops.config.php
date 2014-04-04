<?php
return array(
    'view_manager' => array(
        //zf2-whoops
        'json_exceptions' => array(
            'display' => true,
            'ajax_only' => true,
            'show_trace' => true
        ),
        'whoops_no_catch' => array(
            'BjyAuthorize\Exception\UnAuthorizedException'
        ),
    ),
);