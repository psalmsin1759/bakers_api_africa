<VirtualHost *:80>
    ServerAdmin samson_ude@yahoo.com
    DocumentRoot "/var/www/html/backend/public"
    DirectoryIndex index.html index.php
    ServerName admin.houseofeppagelia.com
    Redirect / https://admin.houseofeppagelia.com


<Directory "/var/www/html/backend/public">

 Options Indexes FollowSymLinks
        AllowOverride All
        Order allow,deny
    allow from all
Require all granted


 # BEGIN WordPress
    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteRule ^index\.php$ - [L]
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . /index.php [L]
    </IfModule>
    # END WordPress

</Directory>

RewriteCond %{SERVER_NAME} =admin.houseofeppagelia.com
RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>


sudo certbot --apache -d houseofeppagelia.com


<VirtualHost *:80>
    ServerName houseofeppagelia.com
    ServerAlias www.houseofeppagelia.com

    ProxyRequests Off
    ProxyPreserveHost On
    ProxyVia Full

    <Proxy *>
        Require all granted
    </Proxy>

    ProxyPass / http://127.0.0.1:5000/
    ProxyPassReverse / http://127.0.0.1:5000
RewriteEngine on
RewriteCond %{SERVER_NAME} =houseofeppagelia.com [OR]
RewriteCond %{SERVER_NAME} =www.houseofeppagelia.com
RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>