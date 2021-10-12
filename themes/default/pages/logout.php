<?php
session_unset();
session_destroy();
header("Location:". url("/?page=login"));
exit;