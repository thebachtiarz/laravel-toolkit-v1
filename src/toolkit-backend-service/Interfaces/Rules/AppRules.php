<?php

namespace TheBachtiarz\Toolkit\Backend\Interfaces\Rules;

interface AppRules
{
    // ? RULES
    public const RULES_REGEX_NAME_SIMPLE_NAME = "regex:/^[a-zA-Z\s]+$/";

    // ? MESSAGES
    public const RULES_REGEX_NAME_SIMPLE_MESSAGES = ":key cannot be accepted";
    public const RULES_REGEX_URL_SIMPLE_MESSAGES = ":key cannot be accepted";
    public const RULES_REGEX_TIMEZONE_SIMPLE_MESSAGES = ":key cannot be accepted";
}
