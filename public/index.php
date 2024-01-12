<?php
require_once 'bootstrap/app.php';
Router::load(['routes/web.php'])
             ::direct(Request::uri(),Request::method());