<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.7.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.7.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-" class="tocify-header">
                <li class="tocify-item level-1" data-unique="">
                    <a href="#"></a>
                </li>
                            </ul>
                    <ul id="tocify-header-" class="tocify-header">
                <li class="tocify-item level-1" data-unique="">
                    <a href="#"></a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-login">
                                <a href="#endpoints-POSTapi-login">POST api/login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-register">
                                <a href="#endpoints-POSTapi-register">POST api/register</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-auth-google-redirect">
                                <a href="#endpoints-GETapi-auth-google-redirect">GET api/auth/google/redirect</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-auth-google-callback">
                                <a href="#endpoints-GETapi-auth-google-callback">GET api/auth/google/callback</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-products">
                                <a href="#endpoints-GETapi-products">GET api/products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-home">
                                <a href="#endpoints-GETapi-home">GET api/home</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-products--id-">
                                <a href="#endpoints-GETapi-products--id-">GET api/products/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-logout">
                                <a href="#endpoints-POSTapi-logout">Log the user out (Invalidate the token).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-products">
                                <a href="#endpoints-POSTapi-products">Store a newly created resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-products--product_id-">
                                <a href="#endpoints-PUTapi-products--product_id-">PUT api/products/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-products--product_id-">
                                <a href="#endpoints-DELETEapi-products--product_id-">DELETE api/products/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-cart-sync">
                                <a href="#endpoints-POSTapi-cart-sync">Sync frontend cart with backend database.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-orders--id-">
                                <a href="#endpoints-GETapi-orders--id-">Get order details.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                                <a href="#endpoints-GETapi-user">GET api/user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-checkout">
                                <a href="#endpoints-GETapi-checkout">Get checkout data (cart summary, total, saved cards)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-checkout">
                                <a href="#endpoints-POSTapi-checkout">Process payment</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-password">
                                <a href="#endpoints-PUTapi-password">Update the user's password.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-profile">
                                <a href="#endpoints-DELETEapi-profile">Delete the user's account.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-products-import">
                                <a href="#endpoints-POSTapi-products-import">Import products from Excel/CSV.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-tags">
                                <a href="#endpoints-GETapi-tags">GET api/tags</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-products--product_id--comments">
                                <a href="#endpoints-POSTapi-products--product_id--comments">POST api/products/{product_id}/comments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-comments--comment_id-">
                                <a href="#endpoints-PUTapi-comments--comment_id-">PUT api/comments/{comment_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-comments--comment_id-">
                                <a href="#endpoints-DELETEapi-comments--comment_id-">DELETE api/comments/{comment_id}</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: February 19, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-login">POST api/login</h2>

<p>
</p>



<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"password\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "password": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
</span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-login"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-register">POST api/register</h2>

<p>
</p>



<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"last_name\": \"n\",
    \"username\": \"g\",
    \"email\": \"rowan.gulgowski@example.com\",
    \"password\": \"BNvYgxwmi\\/#iw\\/kX\",
    \"confirm_password\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "last_name": "n",
    "username": "g",
    "email": "rowan.gulgowski@example.com",
    "password": "BNvYgxwmi\/#iw\/kX",
    "confirm_password": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
</span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-register"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-register"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-register"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>g</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="rowan.gulgowski@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>rowan.gulgowski@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="BNvYgxwmi/#iw/kX"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>BNvYgxwmi/#iw/kX</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>confirm_password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="confirm_password"                data-endpoint="POSTapi-register"
               value="architecto"
               data-component="body">
    <br>
<p>The value and <code>password</code> must match. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-auth-google-redirect">GET api/auth/google/redirect</h2>

<p>
</p>



<span id="example-requests-GETapi-auth-google-redirect">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/auth/google/redirect" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/google/redirect"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-google-redirect">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: https://accounts.google.com/o/oauth2/auth?client_id=782388634943-00eldr0npg8i37ndph980g76m4844oku.apps.googleusercontent.com&amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;scope=openid+profile+email&amp;response_type=code
content-type: text/html; charset=utf-8
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;https://accounts.google.com/o/oauth2/auth?client_id=782388634943-00eldr0npg8i37ndph980g76m4844oku.apps.googleusercontent.com&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;amp;scope=openid+profile+email&amp;amp;response_type=code&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to https://accounts.google.com/o/oauth2/auth?client_id=782388634943-00eldr0npg8i37ndph980g76m4844oku.apps.googleusercontent.com&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;amp;scope=openid+profile+email&amp;amp;response_type=code&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;https://accounts.google.com/o/oauth2/auth?client_id=782388634943-00eldr0npg8i37ndph980g76m4844oku.apps.googleusercontent.com&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;amp;scope=openid+profile+email&amp;amp;response_type=code&quot;&gt;https://accounts.google.com/o/oauth2/auth?client_id=782388634943-00eldr0npg8i37ndph980g76m4844oku.apps.googleusercontent.com&amp;amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fapi%2Fauth%2Fgoogle%2Fcallback&amp;amp;scope=openid+profile+email&amp;amp;response_type=code&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-google-redirect" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-google-redirect"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-google-redirect"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-google-redirect" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-google-redirect">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-google-redirect" data-method="GET"
      data-path="api/auth/google/redirect"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-google-redirect', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-google-redirect"
                    onclick="tryItOut('GETapi-auth-google-redirect');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-google-redirect"
                    onclick="cancelTryOut('GETapi-auth-google-redirect');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-google-redirect"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/google/redirect</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-google-redirect"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-auth-google-redirect"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-auth-google-callback">GET api/auth/google/callback</h2>

<p>
</p>



<span id="example-requests-GETapi-auth-google-callback">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/auth/google/callback" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/google/callback"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-google-callback">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost:5174/login?error=google_auth_failed
content-type: text/html; charset=utf-8
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;http://localhost:5174/login?error=google_auth_failed&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost:5174/login?error=google_auth_failed&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost:5174/login?error=google_auth_failed&quot;&gt;http://localhost:5174/login?error=google_auth_failed&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-google-callback" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-google-callback"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-google-callback"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-google-callback" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-google-callback">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-google-callback" data-method="GET"
      data-path="api/auth/google/callback"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-google-callback', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-google-callback"
                    onclick="tryItOut('GETapi-auth-google-callback');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-google-callback"
                    onclick="cancelTryOut('GETapi-auth-google-callback');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-google-callback"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/google/callback</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-google-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-auth-google-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-products">GET api/products</h2>

<p>
</p>



<span id="example-requests-GETapi-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/products" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/products"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products" data-method="GET"
      data-path="api/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products"
                    onclick="tryItOut('GETapi-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products"
                    onclick="cancelTryOut('GETapi-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-home">GET api/home</h2>

<p>
</p>



<span id="example-requests-GETapi-home">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/home" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/home"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-home">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;featured&quot;: {
        &quot;id&quot;: 10,
        &quot;sku&quot;: &quot;P00010&quot;,
        &quot;name&quot;: &quot;Mewgenics&quot;,
        &quot;description&quot;: &quot;&iexcl;ALERTA DE LABORATORIO! \\n\\n&iquest;Cansado de la gen&eacute;tica aburrida? &iexcl;Mewgenics es la soluci&oacute;n! Convi&eacute;rtete en el Arquitecto del ADN Gatuno.\\n\\nEn este laboratorio de bolsillo, cruza 150+ razas, manipula la herencia de pelajes y gestiona un ecosistema de ronroneos. &iquest;El objetivo? Sobrevivir a mazmorras roguelike usando un mazo de cartas t&aacute;ctico.\\n\\n⚠️ ADVERTENCIA ACAD&Eacute;MICA: Este software puede causar olvido temporal de ex&aacute;menes y deseos incontrolables de adoptar 47 gatos. &iexcl;Matric&uacute;late en la escuela de la vida... gatuna!&quot;,
        &quot;price&quot;: &quot;26.00&quot;,
        &quot;final_price&quot;: 23.4,
        &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_mewgenics.jpg&quot;,
        &quot;video_url&quot;: &quot;http://localhost:8000/video/mewgenics.mp4&quot;,
        &quot;is_new&quot;: true,
        &quot;is_offer&quot;: false,
        &quot;offer_percentage&quot;: &quot;10.00&quot;,
        &quot;offer_start_date&quot;: &quot;2026-02-18&quot;,
        &quot;offer_end_date&quot;: &quot;2026-04-20&quot;,
        &quot;release_date&quot;: &quot;2024-08-19&quot;,
        &quot;active&quot;: true,
        &quot;created_at&quot;: &quot;2026-02-19T16:02:25.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-02-19T16:02:25.000000Z&quot;
    },
    &quot;news&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;sku&quot;: &quot;P00001&quot;,
            &quot;name&quot;: &quot;Hollow Knight 2: Silksong&quot;,
            &quot;description&quot;: &quot;Emb&aacute;rcate en una nueva aventura &eacute;pica en el universo de Hollow Knight. En Silksong controlar&aacute;s a Hornet, explorando reinos desconocidos llenos de enemigos desafiantes, secretos ocultos y un combate &aacute;gil y preciso. Con un estilo art&iacute;stico dibujado a mano, una banda sonora envolvente y una jugabilidad metroidvania refinada, este t&iacute;tulo promete una experiencia intensa tanto para fans como para nuevos jugadores.&quot;,
            &quot;price&quot;: &quot;20.00&quot;,
            &quot;final_price&quot;: 19,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_silksong.jpg&quot;,
            &quot;video_url&quot;: &quot;http://localhost:8000/video/hollow_knight_silksong.mp4&quot;,
            &quot;is_new&quot;: true,
            &quot;is_offer&quot;: false,
            &quot;offer_percentage&quot;: &quot;5.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: &quot;2026-02-09&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;sku&quot;: &quot;P00002&quot;,
            &quot;name&quot;: &quot;Celeste&quot;,
            &quot;description&quot;: &quot;Celeste es un plataformas desafiante y emotivo que combina una jugabilidad precisa con una historia profunda sobre la superaci&oacute;n personal. Acompa&ntilde;a a Madeline en su ascenso a la monta&ntilde;a Celeste, enfrentando niveles cuidadosamente dise&ntilde;ados, mec&aacute;nicas ingeniosas y una banda sonora inolvidable.&quot;,
            &quot;price&quot;: &quot;10.00&quot;,
            &quot;final_price&quot;: &quot;10.00&quot;,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_celeste.jpg&quot;,
            &quot;video_url&quot;: &quot;http://localhost:8000/video/celeste.mp4&quot;,
            &quot;is_new&quot;: true,
            &quot;is_offer&quot;: false,
            &quot;offer_percentage&quot;: null,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: &quot;2026-01-20&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;sku&quot;: &quot;P00003&quot;,
            &quot;name&quot;: &quot;Baldur&#039;s Gate III&quot;,
            &quot;description&quot;: &quot;Sum&eacute;rgete en un RPG &eacute;pico ambientado en el universo de Dungeons &amp; Dragons. Baldur&#039;s Gate III ofrece una narrativa rica, decisiones que influyen directamente en la historia y un sistema de combate por turnos profundo y estrat&eacute;gico.&quot;,
            &quot;price&quot;: &quot;40.00&quot;,
            &quot;final_price&quot;: 36,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_baldurs_gate.jpg&quot;,
            &quot;video_url&quot;: &quot;http://localhost:8000/video/baldurs_gate.mp4&quot;,
            &quot;is_new&quot;: true,
            &quot;is_offer&quot;: false,
            &quot;offer_percentage&quot;: &quot;10.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: &quot;2025-12-21&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
        },
        {
            &quot;id&quot;: 10,
            &quot;sku&quot;: &quot;P00010&quot;,
            &quot;name&quot;: &quot;Mewgenics&quot;,
            &quot;description&quot;: &quot;&iexcl;ALERTA DE LABORATORIO! \\n\\n&iquest;Cansado de la gen&eacute;tica aburrida? &iexcl;Mewgenics es la soluci&oacute;n! Convi&eacute;rtete en el Arquitecto del ADN Gatuno.\\n\\nEn este laboratorio de bolsillo, cruza 150+ razas, manipula la herencia de pelajes y gestiona un ecosistema de ronroneos. &iquest;El objetivo? Sobrevivir a mazmorras roguelike usando un mazo de cartas t&aacute;ctico.\\n\\n⚠️ ADVERTENCIA ACAD&Eacute;MICA: Este software puede causar olvido temporal de ex&aacute;menes y deseos incontrolables de adoptar 47 gatos. &iexcl;Matric&uacute;late en la escuela de la vida... gatuna!&quot;,
            &quot;price&quot;: &quot;26.00&quot;,
            &quot;final_price&quot;: 23.4,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_mewgenics.jpg&quot;,
            &quot;video_url&quot;: &quot;http://localhost:8000/video/mewgenics.mp4&quot;,
            &quot;is_new&quot;: true,
            &quot;is_offer&quot;: false,
            &quot;offer_percentage&quot;: &quot;10.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-18&quot;,
            &quot;offer_end_date&quot;: &quot;2026-04-20&quot;,
            &quot;release_date&quot;: &quot;2024-08-19&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:25.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:25.000000Z&quot;
        },
        {
            &quot;id&quot;: 14,
            &quot;sku&quot;: &quot;P00014&quot;,
            &quot;name&quot;: &quot;Nioh 3&quot;,
            &quot;description&quot;: &quot;Ad&eacute;ntrate en un Jap&oacute;n feudal lleno de demonios y guerreros en Nioh 3. Domina un sistema de combate profundo y estrat&eacute;gico mientras exploras paisajes impresionantes, te enfrentas a jefes desafiantes y descubres secretos ocultos. Con mec&aacute;nicas refinadas, personalizaci&oacute;n de armas y habilidades, y una narrativa inmersiva, Nioh 3 ofrece una experiencia de acci&oacute;n-RPG intensa y gratificante.&quot;,
            &quot;price&quot;: &quot;5.00&quot;,
            &quot;final_price&quot;: 4.5,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_nioh_3.jpg&quot;,
            &quot;video_url&quot;: &quot;http://localhost:8000/video/nioh_3.mp4&quot;,
            &quot;is_new&quot;: true,
            &quot;is_offer&quot;: false,
            &quot;offer_percentage&quot;: &quot;10.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: null,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        }
    ],
    &quot;offers&quot;: [
        {
            &quot;id&quot;: 18,
            &quot;sku&quot;: &quot;P00018&quot;,
            &quot;name&quot;: &quot;AAAAAAAAAAA&quot;,
            &quot;description&quot;: &quot;9999&quot;,
            &quot;price&quot;: &quot;9999.00&quot;,
            &quot;final_price&quot;: 99.99,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;99.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: null,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 9,
            &quot;sku&quot;: &quot;P00009&quot;,
            &quot;name&quot;: &quot;Windows 11 OEM&quot;,
            &quot;description&quot;: &quot;Windows 11 OEM es el sistema operativo de Microsoft dise&ntilde;ado para ofrecer mayor rendimiento, seguridad y una interfaz moderna.&quot;,
            &quot;price&quot;: &quot;10.00&quot;,
            &quot;final_price&quot;: 2,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_windows11.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;80.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-18&quot;,
            &quot;offer_end_date&quot;: &quot;2026-04-20&quot;,
            &quot;release_date&quot;: &quot;2024-08-19&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:25.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:25.000000Z&quot;
        },
        {
            &quot;id&quot;: 15,
            &quot;sku&quot;: &quot;P00015&quot;,
            &quot;name&quot;: &quot;Office 365&quot;,
            &quot;description&quot;: &quot;Maximiza tu productividad con Office 365, la suite definitiva para el trabajo y la colaboraci&oacute;n. Crea documentos, hojas de c&aacute;lculo y presentaciones con herramientas intuitivas, comparte y edita en tiempo real con tu equipo, y organiza tus proyectos de manera eficiente. Con integraci&oacute;n en la nube, seguridad avanzada y aplicaciones para todos tus dispositivos, Office 365 transforma la manera en que trabajas y colaboras.&quot;,
            &quot;price&quot;: &quot;120.00&quot;,
            &quot;final_price&quot;: 36,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_office_365.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;70.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: null,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 24,
            &quot;sku&quot;: &quot;GRE-00024&quot;,
            &quot;name&quot;: &quot;Red Dead Redemption 2&quot;,
            &quot;description&quot;: &quot;Arthur Morgan y la banda de Van der Linde son forajidos a la fuga.&quot;,
            &quot;price&quot;: &quot;53.41&quot;,
            &quot;final_price&quot;: 27.24,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;49.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2024-01-09&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 39,
            &quot;sku&quot;: &quot;GRE-00039&quot;,
            &quot;name&quot;: &quot;Terraria&quot;,
            &quot;description&quot;: &quot;Excava, lucha, explora, construye: &iexcl;El mundo est&aacute; al alcance de tu mano!&quot;,
            &quot;price&quot;: &quot;42.52&quot;,
            &quot;final_price&quot;: 22.11,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;48.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2026-02-13&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 104,
            &quot;sku&quot;: &quot;GRE-00104&quot;,
            &quot;name&quot;: &quot;Sekiro: Shadows Die Twice (Standard Edition 36)&quot;,
            &quot;description&quot;: &quot;Eres el \&quot;lobo de un solo brazo\&quot;, un guerrero desfigurado y ca&iacute;do en desgracia.&quot;,
            &quot;price&quot;: &quot;26.02&quot;,
            &quot;final_price&quot;: 14.31,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;45.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2023-05-12&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 68,
            &quot;sku&quot;: &quot;GRE-00068&quot;,
            &quot;name&quot;: &quot;Subnautica&quot;,
            &quot;description&quot;: &quot;Desciende a las profundidades de un mundo submarino alien&iacute;gena lleno de maravillas y peligros.&quot;,
            &quot;price&quot;: &quot;23.09&quot;,
            &quot;final_price&quot;: 12.7,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;45.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2021-03-24&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 21,
            &quot;sku&quot;: &quot;GRE-00021&quot;,
            &quot;name&quot;: &quot;The Legend of Zelda: Tears of the Kingdom&quot;,
            &quot;description&quot;: &quot;Una aventura &eacute;pica a trav&eacute;s de la tierra y los cielos de Hyrule.&quot;,
            &quot;price&quot;: &quot;70.40&quot;,
            &quot;final_price&quot;: 38.72,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;45.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2023-06-23&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 73,
            &quot;sku&quot;: &quot;GRE-00073&quot;,
            &quot;name&quot;: &quot;Baldur&#039;s Gate 3 (Standard Edition 5)&quot;,
            &quot;description&quot;: &quot;Re&uacute;ne a tu grupo y regresa a los Reinos Olvidados en una historia de compa&ntilde;erismo y traici&oacute;n.&quot;,
            &quot;price&quot;: &quot;69.56&quot;,
            &quot;final_price&quot;: 38.95,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;44.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2021-09-22&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 116,
            &quot;sku&quot;: &quot;GRE-00116&quot;,
            &quot;name&quot;: &quot;Factorio (Standard Edition 48)&quot;,
            &quot;description&quot;: &quot;Factorio es un juego sobre la construcci&oacute;n y creaci&oacute;n de f&aacute;bricas automatizadas.&quot;,
            &quot;price&quot;: &quot;27.20&quot;,
            &quot;final_price&quot;: 16.05,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;41.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2022-11-11&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 100,
            &quot;sku&quot;: &quot;GRE-00100&quot;,
            &quot;name&quot;: &quot;Horizon Forbidden West (Standard Edition 32)&quot;,
            &quot;description&quot;: &quot;&Uacute;nete a Aloy mientras se aventura en el Oeste Prohibido.&quot;,
            &quot;price&quot;: &quot;31.20&quot;,
            &quot;final_price&quot;: 18.41,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;41.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2022-10-14&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 77,
            &quot;sku&quot;: &quot;GRE-00077&quot;,
            &quot;name&quot;: &quot;Minecraft (Standard Edition 9)&quot;,
            &quot;description&quot;: &quot;Prepara una aventura de posibilidades ilimitadas mientras construyes, excavas, combates monstruos y exploras.&quot;,
            &quot;price&quot;: &quot;51.16&quot;,
            &quot;final_price&quot;: 30.7,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;40.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2023-07-21&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 60,
            &quot;sku&quot;: &quot;GRE-00060&quot;,
            &quot;name&quot;: &quot;Rocket League&quot;,
            &quot;description&quot;: &quot;F&uacute;tbol y coches chocan en este h&iacute;brido de arcade de conducci&oacute;n y f&uacute;tbol.&quot;,
            &quot;price&quot;: &quot;24.73&quot;,
            &quot;final_price&quot;: 15.33,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;38.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2025-10-24&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 57,
            &quot;sku&quot;: &quot;GRE-00057&quot;,
            &quot;name&quot;: &quot;Persona 5 Royal&quot;,
            &quot;description&quot;: &quot;Ponte la m&aacute;scara de Joker y &uacute;nete a los Ladrones Fantasma de Corazones.&quot;,
            &quot;price&quot;: &quot;34.91&quot;,
            &quot;final_price&quot;: 21.64,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;38.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2024-04-10&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 114,
            &quot;sku&quot;: &quot;GRE-00114&quot;,
            &quot;name&quot;: &quot;Dead Cells (Standard Edition 46)&quot;,
            &quot;description&quot;: &quot;Explora un castillo en constante cambio y lucha contra sus guardianes.&quot;,
            &quot;price&quot;: &quot;54.56&quot;,
            &quot;final_price&quot;: 34.37,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;37.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2022-08-13&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 35,
            &quot;sku&quot;: &quot;GRE-00035&quot;,
            &quot;name&quot;: &quot;Call of Duty: Modern Warfare II&quot;,
            &quot;description&quot;: &quot;Te da la bienvenida a la nueva era de Call of Duty.&quot;,
            &quot;price&quot;: &quot;47.99&quot;,
            &quot;final_price&quot;: 30.71,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;36.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2023-11-08&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 82,
            &quot;sku&quot;: &quot;GRE-00082&quot;,
            &quot;name&quot;: &quot;Valorant (Standard Edition 14)&quot;,
            &quot;description&quot;: &quot;Combina tu estilo y experiencia en un escenario global competitivo de 5 contra 5.&quot;,
            &quot;price&quot;: &quot;23.47&quot;,
            &quot;final_price&quot;: 16.43,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;30.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2025-07-24&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 38,
            &quot;sku&quot;: &quot;GRE-00038&quot;,
            &quot;name&quot;: &quot;Stardew Valley&quot;,
            &quot;description&quot;: &quot;Acabas de heredar la vieja parcela de tu abuelo en Stardew Valley.&quot;,
            &quot;price&quot;: &quot;64.55&quot;,
            &quot;final_price&quot;: 45.83,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;29.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2025-05-29&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 61,
            &quot;sku&quot;: &quot;GRE-00061&quot;,
            &quot;name&quot;: &quot;Fall Guys&quot;,
            &quot;description&quot;: &quot;&iexcl;Te damos la bienvenida a Fall Guys! Un juego masivo multijugador tipo party royale.&quot;,
            &quot;price&quot;: &quot;42.58&quot;,
            &quot;final_price&quot;: 30.66,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;28.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2022-01-20&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 118,
            &quot;sku&quot;: &quot;GRE-00118&quot;,
            &quot;name&quot;: &quot;Subnautica (Standard Edition 50)&quot;,
            &quot;description&quot;: &quot;Desciende a las profundidades de un mundo submarino alien&iacute;gena lleno de maravillas y peligros.&quot;,
            &quot;price&quot;: &quot;72.62&quot;,
            &quot;final_price&quot;: 53.74,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;26.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2024-05-28&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 34,
            &quot;sku&quot;: &quot;GRE-00034&quot;,
            &quot;name&quot;: &quot;Fortnite&quot;,
            &quot;description&quot;: &quot;S&eacute; el &uacute;ltimo jugador en pie en Battle Royale y Zero Build.&quot;,
            &quot;price&quot;: &quot;22.86&quot;,
            &quot;final_price&quot;: 17.6,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;23.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2025-04-09&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 29,
            &quot;sku&quot;: &quot;GRE-00029&quot;,
            &quot;name&quot;: &quot;The Witcher 3: Wild Hunt&quot;,
            &quot;description&quot;: &quot;Eres Geralt de Rivia, cazador de monstruos mercenario.&quot;,
            &quot;price&quot;: &quot;56.91&quot;,
            &quot;final_price&quot;: 43.82,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;23.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2021-06-26&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 95,
            &quot;sku&quot;: &quot;GRE-00095&quot;,
            &quot;name&quot;: &quot;Mortal Kombat 1 (Standard Edition 27)&quot;,
            &quot;description&quot;: &quot;Descubre un renacido Universo Mortal Kombat creado por el Dios del Fuego Liu Kang.&quot;,
            &quot;price&quot;: &quot;75.91&quot;,
            &quot;final_price&quot;: 58.45,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;23.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2022-10-28&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 85,
            &quot;sku&quot;: &quot;GRE-00085&quot;,
            &quot;name&quot;: &quot;Call of Duty: Modern Warfare II (Standard Edition 17)&quot;,
            &quot;description&quot;: &quot;Te da la bienvenida a la nueva era de Call of Duty.&quot;,
            &quot;price&quot;: &quot;37.44&quot;,
            &quot;final_price&quot;: 29.58,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;21.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2024-04-10&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 53,
            &quot;sku&quot;: &quot;GRE-00053&quot;,
            &quot;name&quot;: &quot;Doom Eternal&quot;,
            &quot;description&quot;: &quot;Los ej&eacute;rcitos del infierno han invadido la Tierra. Convi&eacute;rtete en el Slayer.&quot;,
            &quot;price&quot;: &quot;26.16&quot;,
            &quot;final_price&quot;: 20.67,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;21.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2022-03-07&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 45,
            &quot;sku&quot;: &quot;GRE-00045&quot;,
            &quot;name&quot;: &quot;Mortal Kombat 1&quot;,
            &quot;description&quot;: &quot;Descubre un renacido Universo Mortal Kombat creado por el Dios del Fuego Liu Kang.&quot;,
            &quot;price&quot;: &quot;69.77&quot;,
            &quot;final_price&quot;: 55.82,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;20.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2024-04-25&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 12,
            &quot;sku&quot;: &quot;P00012&quot;,
            &quot;name&quot;: &quot;Ghost of Yōtey&quot;,
            &quot;description&quot;: &quot;Explora un mundo m&iacute;stico lleno de fantasmas y leyendas en Ghost of Yōtey. Controla a un valiente esp&iacute;ritu en su traves&iacute;a por paisajes encantados y templos ancestrales, enfrentando enemigos espectrales y resolviendo acertijos que pondr&aacute;n a prueba tu ingenio. Con una ambientaci&oacute;n visual impresionante y una banda sonora envolvente, ofrece una experiencia que combina acci&oacute;n, exploraci&oacute;n y misterio sobrenatural.&quot;,
            &quot;price&quot;: &quot;60.00&quot;,
            &quot;final_price&quot;: 48,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_ghost_of_yotei.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;20.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: null,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 105,
            &quot;sku&quot;: &quot;GRE-00105&quot;,
            &quot;name&quot;: &quot;Bloodborne (Standard Edition 37)&quot;,
            &quot;description&quot;: &quot;Enfr&eacute;ntate a tus pesadillas mientras buscas respuestas en la antigua ciudad de Yharnam.&quot;,
            &quot;price&quot;: &quot;48.66&quot;,
            &quot;final_price&quot;: 39.9,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;18.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2025-07-18&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 46,
            &quot;sku&quot;: &quot;GRE-00046&quot;,
            &quot;name&quot;: &quot;Forza Horizon 5&quot;,
            &quot;description&quot;: &quot;&iexcl;Tu aventura definitiva en el horizonte te espera! Explora los vibrantes paisajes de M&eacute;xico.&quot;,
            &quot;price&quot;: &quot;76.74&quot;,
            &quot;final_price&quot;: 63.69,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;17.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2023-10-09&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;sku&quot;: &quot;P00005&quot;,
            &quot;name&quot;: &quot;Cuphead&quot;,
            &quot;description&quot;: &quot;Cuphead es un juego de acci&oacute;n cl&aacute;sico inspirado en los dibujos animados de los a&ntilde;os 30, con animaciones dibujadas a mano y m&uacute;sica jazz original.&quot;,
            &quot;price&quot;: &quot;8.00&quot;,
            &quot;final_price&quot;: 6.8,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_cuphead.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;15.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-09&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-06&quot;,
            &quot;release_date&quot;: &quot;2023-02-19&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
        },
        {
            &quot;id&quot;: 89,
            &quot;sku&quot;: &quot;GRE-00089&quot;,
            &quot;name&quot;: &quot;Terraria (Standard Edition 21)&quot;,
            &quot;description&quot;: &quot;Excava, lucha, explora, construye: &iexcl;El mundo est&aacute; al alcance de tu mano!&quot;,
            &quot;price&quot;: &quot;48.29&quot;,
            &quot;final_price&quot;: 41.53,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;14.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2025-08-19&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 17,
            &quot;sku&quot;: &quot;P00017&quot;,
            &quot;name&quot;: &quot;The Witcher 3: Wild Hunt&quot;,
            &quot;description&quot;: &quot;Emb&aacute;rcate en una &eacute;pica aventura en un mundo abierto lleno de magia, monstruos y decisiones que cambian la historia en The Witcher 3: Wild Hunt. Controla a Geralt de Rivia, un cazador de monstruos profesional, mientras exploras vastos paisajes, te enfrentas a enemigos temibles y descubres historias profundas llenas de intriga y drama. Con combates estrat&eacute;gicos, personajes memorables y un universo rico y detallado, este RPG ofrece una experiencia intensa e inolvidable tanto para veteranos como para nuevos jugadores.&quot;,
            &quot;price&quot;: &quot;40.00&quot;,
            &quot;final_price&quot;: 35.2,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_the_witcher_3_wh.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;12.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: null,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 106,
            &quot;sku&quot;: &quot;GRE-00106&quot;,
            &quot;name&quot;: &quot;Dark Souls III (Standard Edition 38)&quot;,
            &quot;description&quot;: &quot;Mientras los fuegos se apagan y el mundo cae en ruinas, viaja a un universo lleno de enemigos.&quot;,
            &quot;price&quot;: &quot;30.70&quot;,
            &quot;final_price&quot;: 27.02,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;12.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2023-11-11&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;sku&quot;: &quot;P00007&quot;,
            &quot;name&quot;: &quot;Hogwarts Legacy&quot;,
            &quot;description&quot;: &quot;Vive tu propia historia en el mundo m&aacute;gico de Harry Potter.&quot;,
            &quot;price&quot;: &quot;35.00&quot;,
            &quot;final_price&quot;: 30.8,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_hogwarts_legacy.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;12.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-12&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-16&quot;,
            &quot;release_date&quot;: &quot;2025-02-19&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;sku&quot;: &quot;P00004&quot;,
            &quot;name&quot;: &quot;Borderlands 4&quot;,
            &quot;description&quot;: &quot;La saga looter-shooter regresa con m&aacute;s acci&oacute;n, humor y caos que nunca. Borderlands 4 ofrece intensos combates en primera persona, millones de armas y un estilo visual inconfundible.&quot;,
            &quot;price&quot;: &quot;30.00&quot;,
            &quot;final_price&quot;: 27,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_borderlands4.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;10.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-14&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-11&quot;,
            &quot;release_date&quot;: &quot;2025-08-19&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
        },
        {
            &quot;id&quot;: 13,
            &quot;sku&quot;: &quot;P00013&quot;,
            &quot;name&quot;: &quot;Helldrivers 2&quot;,
            &quot;description&quot;: &quot;Prep&aacute;rate para la acci&oacute;n cooperativa m&aacute;s intensa en Helldrivers 2. Pilota tu veh&iacute;culo a trav&eacute;s de escenarios infernales llenos de enemigos despiadados, explosiones masivas y misiones trepidantes. Con un enfoque en el multijugador cooperativo, progresi&oacute;n de armas y habilidades, y un dise&ntilde;o de niveles fren&eacute;tico, esta secuela promete combates explosivos y diversi&oacute;n sin parar.&quot;,
            &quot;price&quot;: &quot;40.00&quot;,
            &quot;final_price&quot;: 36,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_helldrivers_2.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;10.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: null,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 11,
            &quot;sku&quot;: &quot;P00011&quot;,
            &quot;name&quot;: &quot;Donkey Kong Bananza&quot;,
            &quot;description&quot;: &quot;Sum&eacute;rgete en un plataformas lleno de diversi&oacute;n y acci&oacute;n con Donkey Kong Bananza. Acompa&ntilde;a a Donkey Kong y sus amigos en niveles coloridos repletos de obst&aacute;culos, enemigos ingeniosos y secretos por descubrir. Con un estilo visual vibrante y mec&aacute;nicas accesibles pero desafiantes, este juego ofrece horas de entretenimiento tanto para jugadores casuales como para veteranos del g&eacute;nero.&quot;,
            &quot;price&quot;: &quot;70.00&quot;,
            &quot;final_price&quot;: 63,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_donkey_kong_bananza.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;10.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: null,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 16,
            &quot;sku&quot;: &quot;P00016&quot;,
            &quot;name&quot;: &quot;Terraria&quot;,
            &quot;description&quot;: &quot;Explora, construye y sobrevive en un mundo abierto lleno de aventuras en Terraria. Cava, lucha y crea mientras descubres mazmorras, jefes desafiantes y recursos &uacute;nicos. Con infinitas posibilidades de personalizaci&oacute;n, multijugador cooperativo y eventos din&aacute;micos, Terraria ofrece una experiencia sandbox llena de creatividad, exploraci&oacute;n y acci&oacute;n para jugadores de todas las edades.&quot;,
            &quot;price&quot;: &quot;20.00&quot;,
            &quot;final_price&quot;: 19,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_terraria.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;5.00&quot;,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: null,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:44.000000Z&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;sku&quot;: &quot;P00008&quot;,
            &quot;name&quot;: &quot;Pokemon Legends Z/A&quot;,
            &quot;description&quot;: &quot;Explora una nueva visi&oacute;n del mundo Pok&eacute;mon con Pok&eacute;mon Legends: Z-A.&quot;,
            &quot;price&quot;: &quot;55.00&quot;,
            &quot;final_price&quot;: 52.25,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_pokemon_legends_ZA.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;5.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-17&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-01&quot;,
            &quot;release_date&quot;: &quot;2025-12-19&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;sku&quot;: &quot;P00006&quot;,
            &quot;name&quot;: &quot;Deep Rock Galactic Survivor&quot;,
            &quot;description&quot;: &quot;Un spin-off de acci&oacute;n y supervivencia ambientado en el universo de Deep Rock Galactic.&quot;,
            &quot;price&quot;: &quot;20.00&quot;,
            &quot;final_price&quot;: 19,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_deep_rock_galactic.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;5.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-16&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2025-10-19&quot;,
            &quot;active&quot;: true,
            &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-home" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-home"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-home"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-home" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-home">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-home" data-method="GET"
      data-path="api/home"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-home', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-home"
                    onclick="tryItOut('GETapi-home');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-home"
                    onclick="cancelTryOut('GETapi-home');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-home"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/home</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-home"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-home"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-products--id-">GET api/products/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-products--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;sku&quot;: &quot;P00001&quot;,
        &quot;name&quot;: &quot;Hollow Knight 2: Silksong&quot;,
        &quot;description&quot;: &quot;Emb&aacute;rcate en una nueva aventura &eacute;pica en el universo de Hollow Knight. En Silksong controlar&aacute;s a Hornet, explorando reinos desconocidos llenos de enemigos desafiantes, secretos ocultos y un combate &aacute;gil y preciso. Con un estilo art&iacute;stico dibujado a mano, una banda sonora envolvente y una jugabilidad metroidvania refinada, este t&iacute;tulo promete una experiencia intensa tanto para fans como para nuevos jugadores.&quot;,
        &quot;price&quot;: &quot;20.00&quot;,
        &quot;final_price&quot;: 19,
        &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_silksong.jpg&quot;,
        &quot;video_url&quot;: &quot;http://localhost:8000/video/hollow_knight_silksong.mp4&quot;,
        &quot;is_new&quot;: true,
        &quot;is_offer&quot;: false,
        &quot;offer_percentage&quot;: &quot;5.00&quot;,
        &quot;offer_start_date&quot;: null,
        &quot;offer_end_date&quot;: null,
        &quot;release_date&quot;: &quot;2026-02-09&quot;,
        &quot;active&quot;: true,
        &quot;platforms&quot;: [
            {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Nintendo Switch&quot;,
                &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;product_id&quot;: 1,
                    &quot;platform_id&quot;: 4
                }
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;PlayStation 5&quot;,
                &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;product_id&quot;: 1,
                    &quot;platform_id&quot;: 2
                }
            },
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Steam&quot;,
                &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;product_id&quot;: 1,
                    &quot;platform_id&quot;: 1
                }
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Xbox Series X&quot;,
                &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;product_id&quot;: 1,
                    &quot;platform_id&quot;: 3
                }
            }
        ],
        &quot;comments&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;user&quot;: {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Moderator&quot;
                },
                &quot;rating&quot;: 1,
                &quot;content&quot;: &quot;Delectus voluptatem laborum tempore voluptas et quis quam asperiores.&quot;,
                &quot;message&quot;: &quot;Delectus voluptatem laborum tempore voluptas et quis quam asperiores.&quot;,
                &quot;created_at&quot;: &quot;2026-02-19T16:02:25.000000Z&quot;,
                &quot;formatted_date&quot;: &quot;19/02/2026&quot;
            }
        ],
        &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
    },
    &quot;related_products&quot;: [
        {
            &quot;id&quot;: 63,
            &quot;sku&quot;: &quot;GRE-00063&quot;,
            &quot;name&quot;: &quot;Celeste&quot;,
            &quot;description&quot;: &quot;Ayuda a Madeline a sobrevivir a sus demonios internos en su viaje a la cima de la monta&ntilde;a Celeste.&quot;,
            &quot;price&quot;: &quot;58.19&quot;,
            &quot;final_price&quot;: &quot;58.19&quot;,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: false,
            &quot;offer_percentage&quot;: null,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: &quot;2023-03-22&quot;,
            &quot;active&quot;: true,
            &quot;platforms&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Steam&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 63,
                        &quot;platform_id&quot;: 1
                    }
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Nintendo Switch&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 63,
                        &quot;platform_id&quot;: 4
                    }
                }
            ],
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 113,
            &quot;sku&quot;: &quot;GRE-00113&quot;,
            &quot;name&quot;: &quot;Celeste (Standard Edition 45)&quot;,
            &quot;description&quot;: &quot;Ayuda a Madeline a sobrevivir a sus demonios internos en su viaje a la cima de la monta&ntilde;a Celeste.&quot;,
            &quot;price&quot;: &quot;40.83&quot;,
            &quot;final_price&quot;: &quot;40.83&quot;,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: false,
            &quot;offer_percentage&quot;: null,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: &quot;2025-02-05&quot;,
            &quot;active&quot;: true,
            &quot;platforms&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Steam&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 113,
                        &quot;platform_id&quot;: 1
                    }
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Nintendo Switch&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 113,
                        &quot;platform_id&quot;: 4
                    }
                }
            ],
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;sku&quot;: &quot;P00002&quot;,
            &quot;name&quot;: &quot;Celeste&quot;,
            &quot;description&quot;: &quot;Celeste es un plataformas desafiante y emotivo que combina una jugabilidad precisa con una historia profunda sobre la superaci&oacute;n personal. Acompa&ntilde;a a Madeline en su ascenso a la monta&ntilde;a Celeste, enfrentando niveles cuidadosamente dise&ntilde;ados, mec&aacute;nicas ingeniosas y una banda sonora inolvidable.&quot;,
            &quot;price&quot;: &quot;10.00&quot;,
            &quot;final_price&quot;: &quot;10.00&quot;,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/cover_celeste.jpg&quot;,
            &quot;video_url&quot;: &quot;http://localhost:8000/video/celeste.mp4&quot;,
            &quot;is_new&quot;: true,
            &quot;is_offer&quot;: false,
            &quot;offer_percentage&quot;: null,
            &quot;offer_start_date&quot;: null,
            &quot;offer_end_date&quot;: null,
            &quot;release_date&quot;: &quot;2026-01-20&quot;,
            &quot;active&quot;: true,
            &quot;platforms&quot;: [
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Nintendo Switch&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 2,
                        &quot;platform_id&quot;: 4
                    }
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;PlayStation 5&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 2,
                        &quot;platform_id&quot;: 2
                    }
                },
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Steam&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 2,
                        &quot;platform_id&quot;: 1
                    }
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Xbox Series X&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 2,
                        &quot;platform_id&quot;: 3
                    }
                }
            ],
            &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;
        },
        {
            &quot;id&quot;: 61,
            &quot;sku&quot;: &quot;GRE-00061&quot;,
            &quot;name&quot;: &quot;Fall Guys&quot;,
            &quot;description&quot;: &quot;&iexcl;Te damos la bienvenida a Fall Guys! Un juego masivo multijugador tipo party royale.&quot;,
            &quot;price&quot;: &quot;42.58&quot;,
            &quot;final_price&quot;: 30.66,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;28.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2022-01-20&quot;,
            &quot;active&quot;: true,
            &quot;platforms&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Steam&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 61,
                        &quot;platform_id&quot;: 1
                    }
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;PlayStation 5&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 61,
                        &quot;platform_id&quot;: 2
                    }
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Xbox Series X&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 61,
                        &quot;platform_id&quot;: 3
                    }
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Nintendo Switch&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 61,
                        &quot;platform_id&quot;: 4
                    }
                }
            ],
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        },
        {
            &quot;id&quot;: 68,
            &quot;sku&quot;: &quot;GRE-00068&quot;,
            &quot;name&quot;: &quot;Subnautica&quot;,
            &quot;description&quot;: &quot;Desciende a las profundidades de un mundo submarino alien&iacute;gena lleno de maravillas y peligros.&quot;,
            &quot;price&quot;: &quot;23.09&quot;,
            &quot;final_price&quot;: 12.7,
            &quot;image_url&quot;: &quot;http://localhost:8000/images/products/placeholder.jpg&quot;,
            &quot;video_url&quot;: null,
            &quot;is_new&quot;: false,
            &quot;is_offer&quot;: true,
            &quot;offer_percentage&quot;: &quot;45.00&quot;,
            &quot;offer_start_date&quot;: &quot;2026-02-19&quot;,
            &quot;offer_end_date&quot;: &quot;2026-03-21&quot;,
            &quot;release_date&quot;: &quot;2021-03-24&quot;,
            &quot;active&quot;: true,
            &quot;platforms&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Steam&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 68,
                        &quot;platform_id&quot;: 1
                    }
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;PlayStation 5&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 68,
                        &quot;platform_id&quot;: 2
                    }
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Nintendo Switch&quot;,
                    &quot;created_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-02-19T16:02:24.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;product_id&quot;: 68,
                        &quot;platform_id&quot;: 4
                    }
                }
            ],
            &quot;created_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-02-19T16:02:45.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products--id-" data-method="GET"
      data-path="api/products/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products--id-"
                    onclick="tryItOut('GETapi-products--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products--id-"
                    onclick="cancelTryOut('GETapi-products--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-products--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-logout">Log the user out (Invalidate the token).</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/logout" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/logout"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
</span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-logout"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-products">Store a newly created resource in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/products" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"sku\": \"b\",
    \"name\": \"n\",
    \"description\": \"Eius et animi quos velit et.\",
    \"price\": 60,
    \"is_new\": false,
    \"is_offer\": true,
    \"offer_percentage\": 1,
    \"offer_start_date\": \"2026-02-19T17:25:45\",
    \"offer_end_date\": \"2052-03-14\",
    \"release_date\": \"2026-02-19T17:25:45\",
    \"active\": true,
    \"featured\": false,
    \"tag_ids\": [
        16
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/products"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "sku": "b",
    "name": "n",
    "description": "Eius et animi quos velit et.",
    "price": 60,
    "is_new": false,
    "is_offer": true,
    "offer_percentage": 1,
    "offer_start_date": "2026-02-19T17:25:45",
    "offer_end_date": "2052-03-14",
    "release_date": "2026-02-19T17:25:45",
    "active": true,
    "featured": false,
    "tag_ids": [
        16
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-products">
</span>
<span id="execution-results-POSTapi-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-products" data-method="POST"
      data-path="api/products"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-products"
                    onclick="tryItOut('POSTapi-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-products"
                    onclick="cancelTryOut('POSTapi-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-products"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sku</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sku"                data-endpoint="POSTapi-products"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-products"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-products"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-products"
               value="60"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>60</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="image_url"                data-endpoint="POSTapi-products"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>video_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="video_url"                data-endpoint="POSTapi-products"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_new</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-products" style="display: none">
            <input type="radio" name="is_new"
                   value="true"
                   data-endpoint="POSTapi-products"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-products" style="display: none">
            <input type="radio" name="is_new"
                   value="false"
                   data-endpoint="POSTapi-products"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_offer</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-products" style="display: none">
            <input type="radio" name="is_offer"
                   value="true"
                   data-endpoint="POSTapi-products"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-products" style="display: none">
            <input type="radio" name="is_offer"
                   value="false"
                   data-endpoint="POSTapi-products"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>offer_percentage</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="offer_percentage"                data-endpoint="POSTapi-products"
               value="1"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 100. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>offer_start_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="offer_start_date"                data-endpoint="POSTapi-products"
               value="2026-02-19T17:25:45"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-02-19T17:25:45</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>offer_end_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="offer_end_date"                data-endpoint="POSTapi-products"
               value="2052-03-14"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>offer_start_date</code>. Example: <code>2052-03-14</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>release_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="release_date"                data-endpoint="POSTapi-products"
               value="2026-02-19T17:25:45"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-02-19T17:25:45</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-products" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-products"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-products" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-products"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>featured</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-products" style="display: none">
            <input type="radio" name="featured"
                   value="true"
                   data-endpoint="POSTapi-products"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-products" style="display: none">
            <input type="radio" name="featured"
                   value="false"
                   data-endpoint="POSTapi-products"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tag_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tag_ids[0]"                data-endpoint="POSTapi-products"
               data-component="body">
        <input type="number" style="display: none"
               name="tag_ids[1]"                data-endpoint="POSTapi-products"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the tags table.</p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-products--product_id-">PUT api/products/{product_id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"sku\": \"b\",
    \"name\": \"n\",
    \"description\": \"Eius et animi quos velit et.\",
    \"price\": 60,
    \"is_new\": false,
    \"is_offer\": true,
    \"offer_percentage\": 1,
    \"offer_start_date\": \"2026-02-19T17:25:45\",
    \"offer_end_date\": \"2052-03-14\",
    \"release_date\": \"2026-02-19T17:25:45\",
    \"active\": false,
    \"featured\": false,
    \"tag_ids\": [
        16
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "sku": "b",
    "name": "n",
    "description": "Eius et animi quos velit et.",
    "price": 60,
    "is_new": false,
    "is_offer": true,
    "offer_percentage": 1,
    "offer_start_date": "2026-02-19T17:25:45",
    "offer_end_date": "2052-03-14",
    "release_date": "2026-02-19T17:25:45",
    "active": false,
    "featured": false,
    "tag_ids": [
        16
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-products--product_id-">
</span>
<span id="execution-results-PUTapi-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-products--product_id-" data-method="PUT"
      data-path="api/products/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-products--product_id-"
                    onclick="tryItOut('PUTapi-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-products--product_id-"
                    onclick="cancelTryOut('PUTapi-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="PUTapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sku</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sku"                data-endpoint="PUTapi-products--product_id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-products--product_id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-products--product_id-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="PUTapi-products--product_id-"
               value="60"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>60</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="image_url"                data-endpoint="PUTapi-products--product_id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>video_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="video_url"                data-endpoint="PUTapi-products--product_id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_new</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="is_new"
                   value="true"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="is_new"
                   value="false"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_offer</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="is_offer"
                   value="true"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="is_offer"
                   value="false"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>offer_percentage</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="offer_percentage"                data-endpoint="PUTapi-products--product_id-"
               value="1"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 100. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>offer_start_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="offer_start_date"                data-endpoint="PUTapi-products--product_id-"
               value="2026-02-19T17:25:45"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-02-19T17:25:45</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>offer_end_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="offer_end_date"                data-endpoint="PUTapi-products--product_id-"
               value="2052-03-14"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>offer_start_date</code>. Example: <code>2052-03-14</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>release_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="release_date"                data-endpoint="PUTapi-products--product_id-"
               value="2026-02-19T17:25:45"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-02-19T17:25:45</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>featured</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="featured"
                   value="true"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="featured"
                   value="false"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tag_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tag_ids[0]"                data-endpoint="PUTapi-products--product_id-"
               data-component="body">
        <input type="number" style="display: none"
               name="tag_ids[1]"                data-endpoint="PUTapi-products--product_id-"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the tags table.</p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-products--product_id-">DELETE api/products/{product_id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-products--product_id-">
</span>
<span id="execution-results-DELETEapi-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-products--product_id-" data-method="DELETE"
      data-path="api/products/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-products--product_id-"
                    onclick="tryItOut('DELETEapi-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-products--product_id-"
                    onclick="cancelTryOut('DELETEapi-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="DELETEapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-cart-sync">Sync frontend cart with backend database.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-cart-sync">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/cart/sync" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/cart/sync"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-cart-sync">
</span>
<span id="execution-results-POSTapi-cart-sync" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-cart-sync"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-cart-sync"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-cart-sync" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-cart-sync">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-cart-sync" data-method="POST"
      data-path="api/cart/sync"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-cart-sync', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-cart-sync"
                    onclick="tryItOut('POSTapi-cart-sync');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-cart-sync"
                    onclick="cancelTryOut('POSTapi-cart-sync');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-cart-sync"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/cart/sync</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-cart-sync"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-cart-sync"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-cart-sync"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-orders--id-">Get order details.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-orders--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/orders/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/orders/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-orders--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-orders--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-orders--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-orders--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-orders--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-orders--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-orders--id-" data-method="GET"
      data-path="api/orders/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-orders--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-orders--id-"
                    onclick="tryItOut('GETapi-orders--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-orders--id-"
                    onclick="cancelTryOut('GETapi-orders--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-orders--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/orders/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-orders--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-orders--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-user">GET api/user</h2>

<p>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-checkout">Get checkout data (cart summary, total, saved cards)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-checkout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/checkout" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/checkout"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-checkout">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-checkout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-checkout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-checkout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-checkout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-checkout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-checkout" data-method="GET"
      data-path="api/checkout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-checkout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-checkout"
                    onclick="tryItOut('GETapi-checkout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-checkout"
                    onclick="cancelTryOut('GETapi-checkout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-checkout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/checkout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-checkout"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-checkout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-checkout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-checkout">Process payment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-checkout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/checkout" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"payment_method\": \"new_card\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/checkout"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "payment_method": "new_card"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout">
</span>
<span id="execution-results-POSTapi-checkout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-checkout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-checkout" data-method="POST"
      data-path="api/checkout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkout"
                    onclick="tryItOut('POSTapi-checkout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkout"
                    onclick="cancelTryOut('POSTapi-checkout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-checkout"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-checkout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-checkout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method"                data-endpoint="POSTapi-checkout"
               value="new_card"
               data-component="body">
    <br>
<p>Example: <code>new_card</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>new_card</code></li> <li><code>saved_card</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-password">Update the user&#039;s password.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/password" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"current_password\": \"architecto\",
    \"password\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/password"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "current_password": "architecto",
    "password": "architecto"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-password">
</span>
<span id="execution-results-PUTapi-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-password" data-method="PUT"
      data-path="api/password"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-password"
                    onclick="tryItOut('PUTapi-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-password"
                    onclick="cancelTryOut('PUTapi-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-password"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>current_password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="current_password"                data-endpoint="PUTapi-password"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-password"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-profile">Delete the user&#039;s account.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/profile" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"password\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/profile"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "password": "architecto"
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-profile">
</span>
<span id="execution-results-DELETEapi-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-profile" data-method="DELETE"
      data-path="api/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-profile"
                    onclick="tryItOut('DELETEapi-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-profile"
                    onclick="cancelTryOut('DELETEapi-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-profile"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="DELETEapi-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-products-import">Import products from Excel/CSV.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-products-import">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/products/import" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "file=@/tmp/phpImlcJG" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/products/import"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('file', document.querySelector('input[name="file"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-products-import">
</span>
<span id="execution-results-POSTapi-products-import" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-products-import"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-products-import"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-products-import" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-products-import">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-products-import" data-method="POST"
      data-path="api/products/import"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-products-import', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-products-import"
                    onclick="tryItOut('POSTapi-products-import');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-products-import"
                    onclick="cancelTryOut('POSTapi-products-import');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-products-import"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/products/import</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-products-import"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-products-import"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-products-import"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>file</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="file"                data-endpoint="POSTapi-products-import"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 5120 kilobytes. Example: <code>/tmp/phpImlcJG</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-tags">GET api/tags</h2>

<p>
</p>



<span id="example-requests-GETapi-tags">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/tags" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/tags"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tags">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tags" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tags"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tags"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tags" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tags">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tags" data-method="GET"
      data-path="api/tags"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tags', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tags"
                    onclick="tryItOut('GETapi-tags');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tags"
                    onclick="cancelTryOut('GETapi-tags');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tags"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tags</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-products--product_id--comments">POST api/products/{product_id}/comments</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-products--product_id--comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/products/1/comments" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rating\": 1,
    \"message\": \"n\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/products/1/comments"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rating": 1,
    "message": "n"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-products--product_id--comments">
</span>
<span id="execution-results-POSTapi-products--product_id--comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-products--product_id--comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-products--product_id--comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-products--product_id--comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-products--product_id--comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-products--product_id--comments" data-method="POST"
      data-path="api/products/{product_id}/comments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-products--product_id--comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-products--product_id--comments"
                    onclick="tryItOut('POSTapi-products--product_id--comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-products--product_id--comments"
                    onclick="cancelTryOut('POSTapi-products--product_id--comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-products--product_id--comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/products/{product_id}/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-products--product_id--comments"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-products--product_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-products--product_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="POSTapi-products--product_id--comments"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="POSTapi-products--product_id--comments"
               value="1"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 5. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="message"                data-endpoint="POSTapi-products--product_id--comments"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>n</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-comments--comment_id-">PUT api/comments/{comment_id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-comments--comment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/comments/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rating\": 1,
    \"message\": \"n\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/comments/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rating": 1,
    "message": "n"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-comments--comment_id-">
</span>
<span id="execution-results-PUTapi-comments--comment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-comments--comment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-comments--comment_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-comments--comment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-comments--comment_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-comments--comment_id-" data-method="PUT"
      data-path="api/comments/{comment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-comments--comment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-comments--comment_id-"
                    onclick="tryItOut('PUTapi-comments--comment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-comments--comment_id-"
                    onclick="cancelTryOut('PUTapi-comments--comment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-comments--comment_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/comments/{comment_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-comments--comment_id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-comments--comment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-comments--comment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>comment_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="comment_id"                data-endpoint="PUTapi-comments--comment_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="PUTapi-comments--comment_id-"
               value="1"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 5. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="message"                data-endpoint="PUTapi-comments--comment_id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>n</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-comments--comment_id-">DELETE api/comments/{comment_id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-comments--comment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/comments/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/comments/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-comments--comment_id-">
</span>
<span id="execution-results-DELETEapi-comments--comment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-comments--comment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-comments--comment_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-comments--comment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-comments--comment_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-comments--comment_id-" data-method="DELETE"
      data-path="api/comments/{comment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-comments--comment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-comments--comment_id-"
                    onclick="tryItOut('DELETEapi-comments--comment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-comments--comment_id-"
                    onclick="cancelTryOut('DELETEapi-comments--comment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-comments--comment_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/comments/{comment_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-comments--comment_id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-comments--comment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-comments--comment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>comment_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="comment_id"                data-endpoint="DELETEapi-comments--comment_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
