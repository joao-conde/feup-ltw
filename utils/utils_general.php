<?php

    function redirect($page) {
        header('Location: '.$page);
        die();
    }

?>