<?php
    class MetacriticAPI {
        private $_enableCaching = false;
        private $_cacheDuration = 0;
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
            $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
            $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
            $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
            $header[] = "Cache-Control: max-age=0";
            $header[] = "Connection: keep-alive";
            $header[] = "Keep-Alive: 300";
            $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
            $header[] = "Accept-Language: en-us,en;q=0.5";
            $header[] = "Pragma: ";

            $ch = curl_init($this->getUrl());
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);

            $mcresults  = curl_exec($ch);
            curl_close($ch);

            return $mcresults;
        }

        function extractScore() {
            $page = $this->getData();
            $regexp = '/\<span[^>]* itemprop\="ratingValue"[^>]*\>(.*?)<\/span>/is';
            preg_match($regexp, $page, $matches);

            if( ctype_digit( $matches[1] ) ) {
                return (int) $matches[1];
            } else {
                return 'xx';
            }
        }
    }
?>

