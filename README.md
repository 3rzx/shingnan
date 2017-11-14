# shingnan backend 

# Requirement
- PHP 5.3
- MySQL
- Apache server

After you put the project in apache server. Please do following:
```sh
$ chmod 744 environment.sh
$ ./environment.sh 
```

# Coding Style
Follow [PSR-2](http://www.php-fig.org/psr/psr-2/)

Use the tool like [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) to format your code.

Install PHP_CodeSniffer
``` sh
$ sudo apt install composer
$ sudo apt install php-codesniffer
```
Format the test.php file to PS2.
```
$ phpcbf -w --standard=PSR2 test.php
```
The are some formater like [vim-phpfmt](https://github.com/beanworks/vim-phpfmt) for vim8 , [vscode-php-formatter](https://github.com/Dickurt/vscode-php-formatter) for vscode, and [sublime-phpcs](https://github.com/benmatselby/sublime-phpcs) for sublime.

# For all member
Do not force push on master.