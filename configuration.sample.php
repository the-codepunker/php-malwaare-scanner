<?php
    //exclusions are done using stripos()
    $active = 1; // if active it will send out emails
    $root = '/home/'; // the folder it will scan recursively
    $time = 5; // the script will search for files modified in the past X minutes
    $server = 'SERVER1.EXAMPLE.COM'; // the name of your server
    $emails = [
        "me@example.com",
    ]; // email addresses to send the report to
