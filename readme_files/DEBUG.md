[< Back to Table of Contents](../README.md)

___

### Setting up PHPStorm for debugging

If you need to see how the code is executed with a debugger or examine the tables in my project, then this section is for you.
Otherwise, you can skip it.

#### Debugging code
Since xdebug is already available in the php-fpm container, all you need to do is configure the following in PhpStorm:
  - In the tab `PHP` > `Debug` > `DBGp Proxy` specify:

    | IDE key  | Host      | Port |
    |----------|-----------|------|
    | PHPSTORM | localhost | 9003 |
    
  - In the tab `PHP` > `Servers` create a new server and configure it as follows:
    
    - 

      | Name               | Host      | Port |
      |--------------------|-----------|------|
      | ecarstrade-php-fpm | localhost | 80   |
  
    - Check "Use path mappings" and assign your local `<project_place>/var/www` to `/var/www` respectively in the "Absolute path on the server" field

#### Database debugging
Set up a connection to the database in the PhpStorm Database panel using the MySQL8 template with the following parameters:

| Host        | Port  | User        | Password    | Database    |
|-------------|-------|-------------|-------------|-------------|
| localhost   | 3396  | ecarstrade  | ecarstrade  | ecarstrade  |

___

[< Back to Table of Contents](../README.md)
