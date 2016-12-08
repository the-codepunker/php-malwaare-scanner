<?php
(php_sapi_name() == 'cli') or die("not allowed");

require __DIR__ . '/rules.php';
require __DIR__ . '/excludes.php';

$all_files = [];
$potentially_infected = [];
$active = 1;
$root = '/home/';
$time = 5;
$server = 'S2.CODEPUNKER.COM';

exec('cd '.$root.' && find . -type f -name \'*.php\' -mmin -$(('.$time.'))', $all_files);

$mailreport = "\n===================\n";

foreach ($all_files as $a => $value) {
    foreach ($excludes as $exclude) {
        if(stripos($value, $exclude))
            continue;
    }

    if(!file_exists($root . $value)) {
        echo "File {$value} skipped ... no longer exists" . PHP_EOL;
        continue;
    }

    $content = file_get_contents($root . $value);

    foreach ($rules as $rule_type_key => $type) {
        foreach ($type as $c => $rule) {
            // pass the generic rules
            if(preg_match('/eval\((base64|eval|\$_|\$\$|\$[A-Za-z_0-9\{]*(\(|\{|\[))/i',$contents) === 1) {
                $potentially_infected[$rule_type_key . '_' . $c] = $value;
            }

            //pas the specific word by word rules 
            if($rule_type_key=='word_by_word') {                
                if(stripos($content, $rule) !== false) {
                    $potentially_infected[$rule_type_key . '_' . $c] = $value;
                }
            }

            //pas the specific regex rules 
            if($rule_type_key=='regex') {
                if(preg_match($rule, $content) === 1) {
                    $potentially_infected[$rule_type_key . '_' . $c] = $value;
                }
            }
        }
    }
}

$report = array();
$report[] = "PLEASE READ! Potentially infected files in the past {$time} minutes on {$server} ";
$report[] = "\n===================\n";

$report_temp = '';
foreach ($potentially_infected as $key => $value) {
    $report_temp .= PHP_EOL . $key . ": " . PHP_EOL . $value . PHP_EOL;
}
$report[] = $report_temp;

$report[] = "PHP file in the past {$time} minutes on {$server} ";
$report[] = "\n===================\n";

$report[] = implode("\n", $all_files);

$mailreport = implode("\n", $report);
$mailreport .= "\n===================\n";

if (!empty($potentially_infected) || !empty($all_files)) {
    if($active) {
        mail("danijelu@gmail.com", "File change report - created by DanielG", $mailreport);
        mail("cosmin@codepunker.com", "File change report - created by DanielG", $mailreport);
    }
    echo $mailreport;
} else {
    echo $mailreport;
}
