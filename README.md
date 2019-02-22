# Facebook login using PHP sdk

* Prerequisites

```
1. Facebook Developers account
2. Facebook developers applictiion.
3. APP Id obtained from facebook application.
4. App Secret obtained from facebook application.
5. Graph version obtained from facebook application.
```

* Setup

```
1. Paste App Id in app_id field of main.php
2. Paste App Secret in app_secret field of main.php
3. Paste Graph version in app_id default_graph_version field of main.php
4. Set Redirect URI in Facebook Login -> Settings -> Valid OAuth Redirect URIs to your redirect URI (in which php file, you are going to handle the response from Facebook) i.e. http://localhost/facebook_project/index.php
5. Set App domains in Settings -> Basic -> App domains field. i.e. http://localhost/facebook_project
6. Turn on Facebook Login -> Settings -> Client OAuth Login
7. Turn on Facebook Login -> Settings -> Web OAuth Login
```