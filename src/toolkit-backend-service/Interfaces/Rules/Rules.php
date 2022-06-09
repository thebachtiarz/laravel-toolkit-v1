<?php

namespace TheBachtiarz\Toolkit\Backend\Interfaces\Rules;

interface Rules
{
    /**
     * Rules validator.
     * Use key name for validate input request.
     */
    public const RULES_VALIDATOR = [
        'name-simple' => [
            'rule' => ["required", AppRules::RULES_REGEX_NAME_SIMPLE_NAME],
            'message' => AppRules::RULES_REGEX_NAME_SIMPLE_MESSAGES
        ],

        'url-simple' => [
            'rule' => ["required", "url"],
            'message' => AppRules::RULES_REGEX_URL_SIMPLE_MESSAGES
        ],

        'timezone-simple' => [
            'rule' => ["required", "timezone"],
            'message' => AppRules::RULES_REGEX_TIMEZONE_SIMPLE_MESSAGES
        ],

        'prefix-simple' => [
            'rule' => ["required", "alpha_num"],
            'message' => AppRules::RULES_REGEX_PREFIX_SIMPLE_MESSAGES
        ]
    ];
}
