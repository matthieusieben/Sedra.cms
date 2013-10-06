Sedra CMS
=========

This repository contains multiple modules to provide a basic CMS based on the [Sedra framework](https://github.com/matthieusieben/Sedra.framework).

## Installation

First, you will need to checkout the [Sedra framework](https://github.com/matthieusieben/Sedra.framework) in your web directory.

Next, open a terminal and `cd` to the `application` folder located at the root of the framework you just downloaded.

Now move the `settings.example.php` to a temporary location

    mv settings.example.php ~/Desktop

And then checkout the [Sedra CMS](https://github.com/matthieusieben/Sedra.cms) in the current directory:

    git clone git://github.com/matthieusieben/Sedra.cms.git .

Move the settings file back:

    mv ~/Desktop/settings.example.php settings.php

And add the following lines (dont forget to also setup your database settings).

    $config['modules']['page'] = TRUE;
    $config['modules']['home'] = TRUE;
    $config['modules']['blog'] = TRUE;
    $config['modules']['theme'] = FALSE;

Navigate to `setup.php` to create the database and its content.

Navigate to `index.php?q=account` and login using `admin`, `admin` as login and password.

## Licence

See **LICENCE** file.

## Owner

- Matthieu Sieben <http://goo.gl/OJ2ce>
