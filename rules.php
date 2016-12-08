<?php
    // to be added too
    //    (\\x[a-zA-Z0-9]*?)+
    // 'r0nin|m0rtix|upl0ad|r57shell|cFaTaLisTiCz_Fx|Tukulesto|99shell|shellbot|phpshell|void\.ru|phpremoteview|directmail|bash_history|\.ru/|brute *force|multiviews|cwings|vandal|bitchx|eggdrop|guardservices|psybnc|dalnet|undernet|vulnscan|spymeta|raslan58|Webshell'
    // 
    $rules = [
        "word_by_word" => [
            "SFRUUF9VU0VSX0FHRU5UCg", //        $user_agent 
            "ZXZhbCg", //        $eval 
            "c3lzdGVt", //        $system 
            "cHJlZ19yZXBsYWNl", //        $preg_replace 
            "ZXhlYyg", //        $exec 
            "YmFzZTY0X2RlY29kZ", //        $base64_decode 
            "IyEvdXNyL2Jpbi9wZXJsCg", //        $perl_shebang 
            "Y21kLmV4ZQ", //        $cmd_exe 
            "cG93ZXJzaGVsbC5leGU", //        $powershell 

            "\\x47\\x4c\\x4f\\x42\\x41\\x4c\\x53", //        $globals 
            "\\x65\\x76\\x61\\x6C\\x28", //        $eval 
            "\\x65\\x78\\x65\\x63", //        $exec 
            "\\x73\\x79\\x73\\x74\\x65\\x6d", //        $system 
            "\\x70\\x72\\x65\\x67\\x5f\\x72\\x65\\x70\\x6c\\x61\\x63\\x65", //        $preg_replace 
            "\\x48\\124\\x54\\120\\x5f\\125\\x53\\105\\x52\\137\\x41\\107\\x45\\116\\x54", //        $http_user_agent 

            "slabolg", //$globals
            "ecalper_gerp", //$preg_replace
            "edoced_46esab", //$base64_decode
            "etalfnizg", //$gzinflate
            "lave", //$eval

            "system",
            "array_filter",
            "assert",
            "backticks",
            "call_user_func",
            "eval",
            "exec",
            "fpassthru",
            "fsockopen",
            "function_exists",
            "getmygid",
            "shmop_open",
            "mb_ereg_replace_callback",
            "passthru",
            "pcntl_exec",
            "pcntl_fork",
            "php_uname",
            "phpinfo",
            "posix_geteuid",
            "posix_getgid",
            "posix_getpgid",
            "posix_getppid",
            "posix_getpwnam",
            "posix_getpwuid",
            "posix_getsid",
            "posix_getuid",
            "posix_kill",
            "posix_setegid",
            "posix_seteuid",
            "posix_setgid",
            "posix_setpgid",
            "posix_setsid",
            "posix_setsid",
            "posix_setuid",
            "preg_replace_callback",
            "proc_open",
            "proc_close",
            "popen",
            "register_shutdown_function",
            "register_tick_function",
            "shell_exec",
            "shm_open",
            "show_source",
            "socket_create(AF_INET, SOCK_STREAM, SOL_TCP)",
            "stream_socket_pair",
            "win32_create_service",
            "xmlrpc_decode",

        ],

        "regex" => [
            '/(<\?php|[;{}])[ \t]*@?(eval|preg_replace|system|assert|passthru|(pcntl_)?exec|shell_execute|call_user_func(_array)?)\s*\(/',  // $eval ;eval( <- this is dodgy
            "/(\$\w+=[^;]*)*;\$\w+=@?\$\w+\(/", //align
            "/\$\w=\$[a-zA-Z]\('',\$\w\);\$\w\(\);/", // weevely3 launcher
            "/;\$\w+\(\$\w+(,\s?\$\w+)+\);/", //http://bartblaze.blogspot.fr/2015/03/c99shell-not-dead.html
            "/\${\$[0-9a-zA-z]+}/", //variable variables
            "/(chr\([\d]+\)\.){8}/", // too many chr
            "/(\$[^\n\r]+\.){5}/", //too much concatenation
            "/(\$[^\n\r]+\. ){5}/", // concatenation of more than 5 words, with spaces
            "/\$_(GET|POST|COOKIE|REQUEST|SERVER)\s*\[[^\]]+\]\s*\(/", // var as func
            "/(eval|assert|passthru|exec|include|system|pcntl_exec|shell_execute|base64_decode|`|array_map|call_user_func(_array)?)\s*\(\s*(base64_decode|php:\/\/input|str_rot13|gz(inflate|uncompress)|getenv|pack|\\?\$_(GET|REQUEST|POST|COOKIE|SERVER))/", // function that takes a callback as 1st parameter
            "/(array_filter|array_reduce|array_walk(_recursive)?|array_walk|assert_options|uasort|uksort|usort|preg_replace_callback|iterator_apply)\s*\(\s*[^,]+,\s*(base64_decode|php:\/\/input|str_rot13|gz(inflate|uncompress)|getenv|pack|\\?\$_(GET|REQUEST|POST|COOKIE|SERVER))/", // functions that takes a callback as 2nd parameter
            "/(array_(diff|intersect)_u(key|assoc)|array_udiff)\s*\(\s*([^,]+\s*,?)+\s*(base64_decode|php:\/\/input|str_rot13|gz(inflate|uncompress)|getenv|pack|\\?\$_(GET|REQUEST|POST|COOKIE|SERVER))\s*\[[^]]+\]\s*\)+\s*;/", // functions that takes a callback as 2nd parameter
            "/(preg_replace(_callback)?|mb_ereg_replace|preg_filter)\s*\(.+(\/|\\x2f)(e|\\x65)['\"]/", // http://php.net/manual/en/function.preg-replace.php
        ],

    ];