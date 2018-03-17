<?php
echo "<br/>";
echo "<b>Internal and External Link lists : </b>";
echo "<br/><br/>";
//function for checking link is a internal link or external link
function checkLink($url,$gathered_from) {
    if(filter_var($url, FILTER_VALIDATE_URL)){
        //parses the target url and breakes it into different components
        $component = parse_url($gathered_from);
        //starts with www then . then some characters then . all matching is case insensitive
        //removes the www if it is present by $1 captures the group (.+\.) and repleaces with orignal host
        // basically hostname without wwww
        $component['host'] = preg_replace('#^www\.(.+\.)#i', '$1', $component['host']);
        //parses the urls in target url page and breakes it into different components
        $new_component = parse_url($url);
        //starts with www then . then some characters then . all matching is case insensitive
        //removes the www if it is present by $1 captures the group (.+\.) and repleaces with orignal host
        // basically hostname without wwww
        $new_component['host'] = preg_replace('#^www\.(.+\.)#i', '$1', $new_component['host']);
        //if the host of target url and url in target url page same it is Internal Link else external link
        if(strpos($component['host'],$new_component['host'])||strpos($new_component['host'],$component['host'])||$new_component['host'] == $component['host'])
        {
        echo "<b>Internal Link: </b> ";
        echo "$url";
        echo "<br/>";
        }
        else
        {
        echo "<b>External Link : </b> ";
        echo "$url";
        echo "<br/>";
        }
    }
}
//$webaddress = $_POST["website"];
$target_url = 'https://cruxonearth.blogspot.in/2017/10/options-styles-of-commands-crux.html';
// make the cURL request to $target_url
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$html= curl_exec($ch);
//Error check if site is not available
if (!$html) {
    echo "<br />cURL error number:" .curl_errno($ch);
    echo "<br />cURL error:" . curl_error($ch);
    exit;
}
// parse the html into a DOMDocument
$dom = new DOMDocument();
@$dom->loadHTML($html);
//grab titles and all the things
// grab all the on the page
$xpath = new DOMXPath($dom);
// get all the data in a (anchor tag) in html>body path / DOM
$hrefs = $xpath->evaluate("/html/body//a");
for ($i = 0; $i < $hrefs->length; $i++) {
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');
    checkLink($url,$target_url);
}
?>
