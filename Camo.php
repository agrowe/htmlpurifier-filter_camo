<?php

class HTMLPurifier_Filter_Camo extends HTMLPurifier_Filter
{

    public $name = 'Camo';

    public function preFilter($html, $config, $context) {
        return $html;
    }

    public function postFilter($html, $config, $context) {
        if (empty($html)) {
            // non string data can not be filtered anyway
            return $html;
        }
        
        if (stripos($html, '<img') === false) {
            // Performance shortcut - if no <img> tag, nothing can match.
            return $html;
        }
        
        $host = 'https://[[CAMOHOST]]';
        $key  = 'CAMOKEY';
        $site = get_config('wwwroot');
        
        $newtext = $html;
        
        $pattern = "#<img.*?src=[\"'](http://[^\"]+)[\"'].*?/?>#i";
        
        if (preg_match_all($pattern, $newtext, $matches)) {
            foreach ($matches[1] as $url) {
                // Don't rewrite requests for this site
                if (stripos($url, $site) === false) {
                    $digest = hash_hmac('sha1', $url, $key);
                    $newtext = str_replace($url, $host . '/' . $digest . '/' . bin2hex($url), $newtext);
                }
            }
        }
        
        if (empty($newtext) or $newtext === $html) {
            // error or not filtered
            return $html;
        } 
        
        return $newtext;
    }

}
