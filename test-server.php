<?php
$host = '127.0.0.1';
$port = 9000;

$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (!$sock) {
    die("Erreur socket_create: " . socket_strerror(socket_last_error()) . "\n");
}

if (!socket_bind($sock, $host, $port)) {
    die("Erreur socket_bind: " . socket_strerror(socket_last_error($sock)) . "\n");
}

if (!socket_listen($sock, 5)) {
    die("Erreur socket_listen: " . socket_strerror(socket_last_error($sock)) . "\n");
}

echo "Serveur démarré sur $host:$port\n";
sleep(10);
socket_close($sock);
