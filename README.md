# page_url_grabber
Grabs the URL in a page and lists as internal or external URL's 
## Language Used
* PHP
## Standard libraries / functions / classes used
* Regex (http://php.net/manual/en/book.pcre.php) : Library  
  * Used for removing 'www' from the URL for maintaining compatibility with URL without 'www' and with 'www' in it
* Curl (http://php.net/manual/en/book.curl.php) : Library
  * Used to download the website
* DOMDocument (http://php.net/manual/en/class.domdocument.php) : Class
  * Used to parse the DOM elements in downloaded website.
