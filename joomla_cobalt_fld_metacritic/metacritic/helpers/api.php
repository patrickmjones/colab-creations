<?php
    class MetacriticAPI {
        private $_path = "";
        private $_mcbase = "http://www.metacritic.com";
        function __construct($path) {
            $this->_path = $path;
        }
        function __toString() {
            return $this->getUrl();
        }
        function getUrl() {
            return $this->_mcbase . "/" . $this->_path;
        }

        function getData() {
            $agent= 'Mozilla/5.0 (Windows NT 10.0; <64-bit tags>) AppleWebKit/<WebKit Rev> (KHTML, like Gecko) Chrome/<Chrome Rev> Safari/<WebKit Rev> Edge/<EdgeHTML Rev>.<Windows Build>';
            $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
            $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
			$header[] = "User-Agent: " . $agent;
            $header[] = "Cache-Control: max-age=0";
            $header[] = "Connection: keep-alive";
            $header[] = "Keep-Alive: 300";
            $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
            $header[] = "Accept-Language: en-us,en;q=0.5";
            $header[] = "Pragma: ";

			$mcresults = JHttpFactory::getHttp()->get($this->getUrl(), $header);
            return $mcresults;
        }

        function extractScore() {
            $page = $this->getData();

			// First, let's try the new embedded data format
			$regexp = '/<script.*type="application\/ld\+json">(.*?)<\/script>/is';
			preg_match($regexp, $page, $matches);
			if(!empty($matches)) {
				try {
					$json = json_decode($matches[1], true);
					return $json['aggregateRating']['ratingValue'];
				} catch (Exception $err) { return 'xx'; }
			}else{
				// As a fallback, let's try the old HTML method
	            $regexp = '/\<span[^>]* itemprop\="ratingValue"[^>]*\>(.*?)<\/span>/is';
	            preg_match($regexp, $page, $matches);

    	        if( ctype_digit( $matches[1] ) ) {
	                return (int) $matches[1];
	            }
			}
	        return 'xx';
        }
    }
?>

