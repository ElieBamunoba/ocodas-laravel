<?php

use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\GoogleTranslate;

/**
 * Translate the given message.
 *
 * @param string|null $key
 * @param array $replace
 * @return string|array|null
 */
function __trans($key = null, $replace = [], $locale = null)
{
    if (is_null($key)) {
        return $key;
    }

    return trans($key, $replace, $locale);

    try {
        $currentLocale = app()->getLocale();

        $tr = new GoogleTranslate();
        $tr->setOptions([
            'timeout' => 10,
            'verify' => false,
        ]);

        // Use 'auto' for source language detection
        $tr->setSource('auto')
            ->setTarget($currentLocale);

        $translatedText = $tr->translate(trans($key, $replace, $locale));
        return "{$translatedText}";
    } catch (\Exception $e) {
        Log::error("Translation failed: " . $e->getMessage());
        return "{$key}";
    }
}
