<?php
class cURL { 
var $headers; 
var $user_agent; 
var $compression; 
var $cookie_file; 
var $proxy; 
function __construct($cookies=TRUE,$cookie='cookies.txt',$compression='gzip',$proxy='') { 
$this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg'; 
$this->headers[] = 'Connection: Keep-Alive'; 
$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8'; 
$this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)'; 
} 
function get($url) { 
$process = curl_init($url); 
curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers); 
curl_setopt($process, CURLOPT_HEADER, 0); 
curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1); 
$return = curl_exec($process); 
curl_close($process); 
return $return; 
} 
function post($url,$data) { 
$process = curl_init($url); 
curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers); 
curl_setopt($process, CURLOPT_HEADER, 1); 
curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent); 
if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file); 
if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file); 
curl_setopt($process, CURLOPT_ENCODING , $this->compression); 
curl_setopt($process, CURLOPT_TIMEOUT, 30); 
if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy); 
curl_setopt($process, CURLOPT_POSTFIELDS, $data); 
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1); 
curl_setopt($process, CURLOPT_POST, 1); 
$return = curl_exec($process); 
curl_close($process); 
return $return; 
} 
function error($error) { 
echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>"; 
die; 
} 
} 
/* Usage
Grab some XML data, either from a file, URL, etc. however you want. Assume storage in $strYourXML;

$objXML = new xml2Array();
$arrOutput = $objXML->parse($strYourXML);
print_r($arrOutput); //print it out, or do whatever!
  
*/
class xml2Array {
    
    var $arrOutput = array();
    var $resParser;
    var $strXmlData;
    
    function parse($strInputXML) {
    
            $this->resParser = xml_parser_create ();
            xml_set_object($this->resParser,$this);
            xml_set_element_handler($this->resParser, "tagOpen", "tagClosed");
            
            xml_set_character_data_handler($this->resParser, "tagData");
        
            $this->strXmlData = xml_parse($this->resParser,$strInputXML );
            if(!$this->strXmlData) {
               die(sprintf("XML error: %s at line %d",
            xml_error_string(xml_get_error_code($this->resParser)),
            xml_get_current_line_number($this->resParser)));
            }
                            
            xml_parser_free($this->resParser);
            
            return $this->arrOutput;
    }
    function tagOpen($parser, $name, $attrs) {
       $tag=array("name"=>$name,"attrs"=>$attrs); 
       array_push($this->arrOutput,$tag);
    }
    
    function tagData($parser, $tagData) {
       if(trim($tagData)) {
            if(isset($this->arrOutput[count($this->arrOutput)-1]['tagData'])) {
                $this->arrOutput[count($this->arrOutput)-1]['tagData'] .= $tagData;
            } 
            else {
                $this->arrOutput[count($this->arrOutput)-1]['tagData'] = $tagData;
            }
       }
    }
    
    function tagClosed($parser, $name) {
       $this->arrOutput[count($this->arrOutput)-2]['children'][] = $this->arrOutput[count($this->arrOutput)-1];
       array_pop($this->arrOutput);
    }
}