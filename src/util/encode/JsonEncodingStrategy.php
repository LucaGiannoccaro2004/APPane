<?php

    class JsonEncodingStrategy extends Encode{

        function encode($data){
            return json_encode($data);
        }

    }

?>