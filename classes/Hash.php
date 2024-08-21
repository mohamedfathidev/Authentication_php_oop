<?php

class Hash {
    public static function make($pass,$salt=null) {
        return hash('sha256', $pass.$salt);
    }

    public static function salt() {
        return bin2hex(random_bytes(16));
    }

    public static function unique() {
        return self::make(uniqid());
    }
}


