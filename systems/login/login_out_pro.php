<?php
session_start();
if ($_POST['status'] == 0) {
  
    echo 'OK';
} else {
    session_destroy();
    echo 'NO';
}