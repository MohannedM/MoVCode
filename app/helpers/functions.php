<?php

function redirect($location){
    header("Location: " . URLROOT . '/views/' . $location);
}