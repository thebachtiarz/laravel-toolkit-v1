<?php

namespace TheBachtiarz\Toolkit\Helper\Interfaces\Validator;

interface GlobalValidatorInterface
{
    /**
     * Password secure
     */
    public const RULES_REGEX_PASSWORD_SECURE = "regex:/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=.*[^0-9a-zA-Z]).{7,})\S$/";

    /**
     * Password debug
     */
    public const RULES_REGEX_PASSWORD_DEBUG = "regex:/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{3,})\S$/";

    /**
     * Input access encrypted
     */
    public const RULES_REGEX_ACCESS_ENCRYPTED = "regex:/^[a-zA-Z0-9=]+$/";

    /**
     * Name simple
     */
    public const RULES_REGEX_NAME_SIMPLE = "regex:/^[a-zA-Z\s]+$/";

    /**
     * Name advance
     */
    public const RULES_REGEX_NAME_ADVANCE = "regex:/^[a-zA-Z,.\s]+$/";

    /**
     * Allowed import image format name extension
     */
    public const RULES_REGEX_PHOTO_JPG = "regex:/^[0-9A-Za-z-_.jJpPeEnNgG]+$/";

    /**
     * Biodata gender iso
     */
    public const RULES_REGEX_BIODATA_GENDER = "regex:/^[FM]+$/";

    /**
     * Biodata city
     */
    public const RULES_REGEX_BIODATA_CITY = "regex:/^[a-zA-Z,.\s()]+$/";

    /**
     * Born date
     */
    public const RULES_DATE_FORMAT_BIODATA_BORN_DATE = "date_format:Y-m-d";

    /**
     * Input sentences
     */
    public const RULES_REGEX_SENTENCES = "regex:/^[\v\w\s\-\_:,.]+$/";

    /**
     * Allowed import image extension
     */
    public const RULES_FILE_IMAGE_UPLOAD_TYPE = "mimes:jpeg,png,jpg";

    /**
     * Allowed import image max size
     */
    public const RULES_FILE_IMAGE_UPLOAD_SIZE = "max:2048";
}
