Test Video
==========

Docker notes:
-------------
Make sure you have 80 port free.

Add line to your `hosts` file
```
127.0.0.1      test-video.loc test-video-api.loc
```
Run from the repo root: 
```
$ docker-compose up --build
```
In 2nd console run:
```
$ docker exec -it php-api /bin/bash 
```
In opened shell run next command, extensions + default parameters will be setup:
```
# bin/install
```
In 3rd console run:
```
$ docker exec -it php-auth /bin/bash 
```
In opened shell run the same command for the auth site (oAuth2 client),
extensions + default parameters will be setup:
```
# bin/install
```
After these steps open in your browser `http://test-video.loc/app_dev.php/`, and click
'Login' there. You'll be lead through oAuth process: 
* site1 -> creates link with `redirect url`
* site1 -> redirects you to site2 with `redirect url`
* site2 -> requests user + password (select any from `DB test data` section)
* site2 -> after successful login you need to `allow` token
* site2 -> redirect to site1 with `code` (30s valid)
* site1 -> requests `token` by `code`
* site1 -> shows header to be used

So site 1 stands for oAuth2 token retrieving.

Site 2 stands for oAuth2 server + uses those tokens for authentication + api + api-docs.
DB is used only on 1 side due to requirement about independent applications.

Open in your browser `http://test-video-api.loc/app_dev.php/api-doc` (but don't close
previous window/tab)

There is calls description + `sandbox` tab on each call, you may use it for testing purposes.

If you'd like to use extra tool, use endpoints:
* _POST_ http://test-video-api.loc:11080/app_dev.php/api/add
* _PATCH_ http://test-video-api.loc:11080/app_dev.php/api/favourite/{video}
* _GET_ http://test-video-api.loc:11080/app_dev.php/api/not-favourited


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

Apache installation script:
========================
API installation:
* Run from the `[projectPath]/api/` folder `bin/install` it will:
    * install dependencies via composer + access to DB (access parameters)
      * `database_*` - mysql user, DB should exist
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
    * install dependencies via composer + access to DB (access parameters)
      (all default values should be used)
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
