in case of permission error

Enter the sail container as root:
vendor/bin/sail root-shell

Set the file ownership for all files in the project:
chown -R sail:sail /var/www/html
OR
the vendor folder only
chown -R sail:sail /var/www/html/vendor