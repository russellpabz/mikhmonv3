<?php
session_unset();
session_destroy();

Redirect(url("/?page=login"));