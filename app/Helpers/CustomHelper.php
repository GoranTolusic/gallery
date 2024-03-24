<?php

use Illuminate\Foundation\Inspiring;

    function handleInspirationalQuote()
    {
        $striped = strip_tags(Inspiring::quote());
        $stripedNewLines = str_replace("\n", "", $striped);
        $trimed = trim($stripedNewLines);
        $quoteArray = explode(" — ", $trimed);
        return [
            'quote' => $quoteArray[0],
            'quoteAuthor' => $quoteArray[1]
        ];
    }

    function getHiddenParams($argument)
    {
        $param_args = ['keyword'];

        foreach ($param_args as $param) {
            if ($param == $argument) {
                if (isset($_GET[$param])) {
                    $value = $_GET[$param];
                } else {
                    $value = '';
                }
                return $value;
            }
        }
    }
