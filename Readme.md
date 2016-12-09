Installation
===

1. Clone the repo
2. Create one file in the same folder called configuration.php
3. Sample configuration.php file:
    
    ```php
            <?php
            $active = 1; // if active it will send out emails
            $root = '/home/'; // the folder it will scan recursively
            $time = 5; // the script will search for files modified in the past X minutes
            $server = 'SERVER1.EXAMPLE.COM'; // the name of your server
            $emails = [
                "me@example.com",
            ]; // email addresses to send the report to
    ```

4. Create one file in the same folder called excludes.php
5. Sample excludes.php file:

    ```php
    <?php
        //exclusions are done using stripos()
        $excludes = 
            [
                'path/to/filename.php',
                'path/to/filename2.php'
            ];
    ```

6. Execute the file into a cron every X minutes
7. Let's hope you won't receive any infections report - ever :)
