<?php

declare(strict_types=1);

return [

    /**
     * Localize types of translation strings.
     */
    'localize' => [
        /**
         * Short keys. This is the default for Laravel.
         * They are stored in PHP files inside folders name by their locale code.
         * Laravel comes with default: auth.php, pagination.php, passwords.php and validation.php
         */
        'default' => true,

        /**
         * Translations strings as key.
         * They are stored in JSON file for each locale.
         */
        'json' => true,
    ],

    /**
     * Search criteria for files.
     */
    'search' => [
        /**
         * Directories which should be looked inside.
         */
        'dirs' => [
            'resources/views',
            'app/Http/Controllers',
            'app/Http/ViewModels',
            'app/Actions',
        ],

        /**
         * Subdirectories which will be excluded.
         * The values must be relative to the included directory paths.
         */
        'exclude' => [
            //
        ],

        /**
         * Patterns by which files should be queried.
         * The values can be a regular expression, glob, or just a string.
         */
        'patterns' => ['*.php'],

        /**
         * Functions that the strings will be extracted from.
         * Add here any custom defined functions.
         * NOTE: The translation string should always be the first argument.
         */
        'functions' => ['__', 'trans', '@lang', 'trans_key'],
    ],

    /**
     * Should the localize command sort extracted strings alphabetically?
     */
    'sort' => true,

];
