<?php

namespace App\src;

class Pis {


	public static function is_valid($nis) {

        // Canonicalize input
        $nis = sprintf('%011s', preg_replace('{\D}', '', $nis));

        // Validate length and invalid numbers
        if ((strlen($nis) != 11)
                || (intval($nis) == 0)) {
            return false;
        }

        // Validate check digit using a modulus 11 algorithm
        for ($d = 0, $p = 2, $c = 9; $c >= 0; $c--, ($p < 9) ? $p++ : $p = 2) {
            $d += $nis[$c] * $p;
        }

        return ($nis[10] == (((10 * $d) % 11) % 10));

    }

}