<?php

define('PAGINATION_COUNT', 15);

function getFolderName(){
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}

