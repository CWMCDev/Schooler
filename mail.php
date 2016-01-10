<?php

$mbox = imap_open("{w2010ExchangeServer:993/imap/ssl}", $user, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'));


?>