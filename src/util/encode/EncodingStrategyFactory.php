<?php

    class EncodingStrategyFactory{

        function getStrategy($contentType){
            if(strcmp($contentType, "application/json") == 0){
                return new JsonEncodingStrategy();
            }else if(strcmp($contentType, "text/plain") == 0){
                return new PlainTextEncodingStrategy();
            }else{
                return new PlainTextEncodingStrategy();
            }
        }

    }

?>