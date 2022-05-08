<?php

namespace TheBachtiarz\Toolkit\Helper\Interfaces\Validator;

interface GlobalValidatorInterface
{
    /**
     * password secure
     */
    public const RULES_REGEX_PASSWORD_SECURE = "regex:/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=.*[^0-9a-zA-Z]).{7,})\S$/";

    /**
     * password debug
     */
    public const RULES_REGEX_PASSWORD_DEBUG = "regex:/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{3,})\S$/";

    /**
     * input access encrypted
     */
    public const RULES_REGEX_ACCESS_ENCRYPTED = "regex:/^[a-zA-Z0-9=]+$/";

    /**
     * name simple
     */
    public const RULES_REGEX_NAME_SIMPLE = "regex:/^[a-zA-Z\s]+$/";

    /**
     * name advance
     */
    public const RULES_REGEX_NAME_ADVANCE = "regex:/^[a-zA-Z,.\s]+$/";

    /**
     * allowed import image format name extension
     */
    public const RULES_REGEX_PHOTO_JPG = "regex:/^[0-9A-Za-z-_.jJpPeEnNgG]+$/";

    /**
     * biodata gender iso
     */
    public const RULES_REGEX_BIODATA_GENDER = "regex:/^[FM]+$/";

    /**
     * biodata city
     */
    public const RULES_REGEX_BIODATA_CITY = "regex:/^[a-zA-Z,.\s()]+$/";

    /**
     * born date
     */
    public const RULES_DATE_FORMAT_BIODATA_BORN_DATE = "date_format:Y-m-d";

    /**
     * input sentences
     */
    public const RULES_REGEX_SENTENCES = "regex:/^[\v\w\s\-\_,.]+$/";

    /**
     * allowed import image extension
     */
    public const RULES_FILE_IMAGE_UPLOAD_TYPE = "mimes:jpeg,png,jpg";

    /**
     * allowed import image max size
     */
    public const RULES_FILE_IMAGE_UPLOAD_SIZE = "max:2048";
}
