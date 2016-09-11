# ShortLink

## About
ShortLink is a lightweight link shortener built on Apache, PHP, and MySQL.

The frontend is incredibly lacking in style as I'm not really a web designer. If you happen to be one, all the files you need to edit are in the [/static/](static/) directory.

## Configuration

### MySQL
Edit the database values in [config.php](config.php) (default values are `REPLACE_ME`). If your database will have a name other than `shortlink`, edit that value in the config as well as in [/install/database.sql](install/database.sql).

Once you have set these values, navigate to (or execute through shell) `/install/install.php`. If the script prints `Database created.`, the database creation should have completely successfully.

After your database has successfully been created, delete the [/install/](install/) directory.

### Apache
ShortLink utilizes Apache's `mod_rewrite` module to handle link routing, thus we must ensure the module is enabled.
To check if it is already enabled you must have already followed the MySQL configuration instructions. If you have, simply navigate to `/index.php` and create a link. If the link doesn't lead to a 404, the module is probably already enabled so you can skip this part.

If you **do not** have shell access to your webserver and the above steps resulted in a 404 or other error, there isn't much you can do except contact your hosting provider and ask them to enable the module.

If you **do** have shell access - 

Run `a2enmod rewrite` and restart Apache. Test the link we created earlier, if it works you're done.

Assuming the above did not work, you must locate the correct apache configuration file. Mine is located at `/etc/apache2/apache2.conf` - this will be different depending on your setup.

Locate the correct directory configuration. Mine looks like:
```
<Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
</Directory>
```

Change `AllowOverride` to `All`. Restart Apache and navigate to the test link we created earlier - it should be working correctly now.