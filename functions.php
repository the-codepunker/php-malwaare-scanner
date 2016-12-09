<?php
    /**
     * UTILITY FUNCTIONS IF NEEDED
     */
    function colorset($str, $color)
    {
        $ANSI_CODES = array(
            "off"        => 0,
            "bold"       => 1,
            "red"        => 31,
            "green"      => 32,
            "yellow"     => 33,
        );

        $color_attrs = explode("+", $color);
        $ansi_str = "";
        foreach ($color_attrs as $attr) {
            $ansi_str .= "\033[" . $ANSI_CODES[$attr] . "m";
        }
        $ansi_str .= $str . "\033[" . $ANSI_CODES["off"] . "m";
        return $ansi_str;
    }
