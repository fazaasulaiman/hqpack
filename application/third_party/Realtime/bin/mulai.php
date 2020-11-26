<?php
// in your server start command
_ = popen('/usr/bin/php bin/chat-server.php', 'r');
echo "Server started.\n";

// in your server stop command
$output = array();
exec('ps ax | grep bin/chat-server.php', &$output);
$lines = preg_split('/\n/', $output);
// kill everything (there can be multiple processes if they are spawned)
$stopped = False;
foreach ($lines as $line) {
    $ar = preg_split('/\s+/', trim($line));
    if (in_array('/usr/bin/php', $ar)
        and in_array('bin/chat-server.php', $ar)) {
        $pid = (int) $ar[0];
        posix_kill($pid, SIGKILL);
        $stopped = True;
    }
}
if ($stopped) {
    echo "Server stopped.\n";
} else {
    echo "Server not found. Are you sure it's running?\n";
}
?>