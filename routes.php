<?php

Route::post('/markdown/preview', function()
{
    return Markdown::convertToHtml(Request::get('content'));
});