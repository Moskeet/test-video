Test Video
==========

Apache2 configs:
----------------
```
<VirtualHost *:80>
    ServerName test-video-api.loc

    DocumentRoot [projectPath]/api/web
    <Directory [projectPath]/api/web>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order Allow,Deny
        Allow from All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName test-video.loc

    DocumentRoot [projectPath]/auth/web
    <Directory [projectPath]/auth/web>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order Allow,Deny
        Allow from All
        Require all granted
    </Directory>
</VirtualHost>
```

Installation script:
========================
API installation:
* Run from the `[projectPath]/api/` folder `bin/install` it will:
    * install dependencies via composer + request(prompt) access to DB (access parameters)
      * `database_*` - mysql user should have the rights to create DB, DB should exist
      * `mailer_*` - leave it blank
      * `secret` - some dummy text
      * others - just leave default values
    * create DB
    * apply migrations:
      * db structure
      * dummy data (specified lower here)
    * applies 777 rights (fast solution) to logs+cache folders
    
Auth installation:
* Run from the `[projectPath]/auth/` folder `bin/install` it will:
    * install dependencies via composer + request(prompt) access to DB (access parameters)
      just click `Enter` on each parameter, to use default values
      * critical values are (they are set by default):
        ```
        client_id: 1_3ywdlzyn1iyockc0wg0woksgswowss8gso84ow44scwo8ks84k
        client_secret: 50o6jk94cxgcs0co04wccsk84gkwgo8wc00w40c440c80w88kk
        client_auth_url: http://test-video-api.loc/app_dev.php/oauth/v2/auth
        client_token_url: http://test-video-api.loc/app_dev.php/oauth/v2/token
        ```
    * applies 777 rights (fast solution) to logs+cache folders
  
  
_HOW2_
------
* visit `http://test-video.loc/app_dev.php/` you'll see a login link, click it,
  it will lead you through oAuth2 process + after login you'll see
  header, which should be used on next steps
* visit `http://test-video-api.loc/app_dev.php/api-doc` in the next tab/window,
  here you'll see a native Nelmio tool, which will list you all calls with
  parameters + can be used for testing purposes (`sandbox` tab on each call
  details).
  
  Please make sure you've specified an AUTHORIZATION header in each call, token
  is valid for 1 day.
  
 
DB test data:
-------------

Users:

| username | password |
|----------|----------|
|user1     |111       |
|user2     |111       |
|user3     |111       |
|user4     |111       |
|user5     |111       |

Videos

| title    | description          | year   |
|----------|----------------------|--------|
|Video 1   | Video 1 description  | random |
|Video 2   | Video 2 description  | random |
|...       | ...                  | random |
|Video 20  | Video 20 description | random |
