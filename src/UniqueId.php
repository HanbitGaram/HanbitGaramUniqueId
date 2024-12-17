<?php
namespace Hanbitgaram\UniqueId;
/**
 * Unique ID Generation Class
 * @package HanbitGaram\UniqueId
 * @author HanbitGaram <webmaster@hanb.jp>
 */

class UniqueId
{
    /**
     * Unique ID Generation Method
     *
     * @param array $options Options (prefix, datetime)
     * @return string URL-Safe Unique ID 14~ strings (e.g. wyRTjRIRF-pGWw)
     */
    public function generate(array $options = [
     'prefix' => null,
     'datetime' => null
    ]): string
    {
        // Default: Default Prefix (e.g. Machine ID, Service ID...)
        $prefix = $options['prefix'] ?? "";

        // Default: Current date and time
        $datetime = $options['datetime'] ?? date("ymdHis");

        // Converting Date/Time Components
        $binaryParts = [
            'yearEnd2digit' => $this->offsetFromHex($datetime, 2),
            'month' => $this->offsetFromHex($datetime, 2),
            'day' => $this->offsetFromHex($datetime, 4),
            'hour' => $this->offsetFromHex($datetime, 6),
            'minute' => $this->offsetFromHex($datetime, 8),
            'second' => $this->offsetFromHex($datetime, 10),
        ];

        // Generating Random Values
        $randomBytes = array_map(function () {
            return hex2bin($this->generateRandomHex());
        }, range(1, 4));

        // Result Combination
        $result = $prefix . $randomBytes[0] . $binaryParts['yearEnd2digit'] . $binaryParts['second'] .
            $randomBytes[1] . $binaryParts['month'] . $binaryParts['hour'] .
            $binaryParts['day'] . $randomBytes[2] . $binaryParts['minute'] .
            $randomBytes[3];

        // Formatted to URL-Safe after encoding with Base64
        return str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($result));
    }

    /**
     * Hex Offset Extraction Method
     *
     * @param string|null $datetime Date and time (yymmddhhmmss format)
     * @param int $offset Offset value
     * @return string Extracted HEX value
     */
    protected function offsetFromHex(string $datetime = null, int $offset = 0): string
    {
        return hex2bin(substr($datetime, $offset, 2));
    }

    /**
     * Random HEX Generation Method
     *
     * @return string Randomly generated 2-digit HEX value
     */
    private function generateRandomHex(): string
    {
        $hex = str_split("0123456789abcdef0123456789abcdef");
        shuffle($hex);
        return $hex[0] . $hex[1];
    }
}
