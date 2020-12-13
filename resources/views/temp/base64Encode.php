<?php
    $encoded_msg =  base64_encode('This is an encoded string');
    echo base64_decode($encoded_msg);
?>