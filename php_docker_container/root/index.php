<?php
echo '<h2>PHP State:</h2>';
echo '<p>It works!</p>';

echo '<h2>MySQL State:</h2>';
try {
	new PDO('mysql:host=mysql_docker_container;dbname=mysql_database;charset=UTF8', 'user', 'pass');
    echo '<p>It works!</p>';
} catch (PDOException $e) {
    echo '<p>It doesn\'t works!</p>';
}

echo '<h2>Varnish State:</h2>';
if (isset($_SERVER['HTTP_X_VARNISH'])) {
    $returnKeyword = $_SERVER['HTTP_X_VARNISH_RETURN_KEYWORD'] ?? 'none';
    echo '<p>It works!</p>';
    echo '<p>Return keyword used: <strong>' . $returnKeyword . '</strong></p>';

    if ('pipe' === $returnKeyword) {
        echo <<<HTML
        <p>Called upon entering pipe mode.
        In this mode, the request is passed on to the backend, and any further data from both the client
        and backend is passed on unaltered until either end closes the connection.
        Basically, Varnish will degrade into a simple TCP proxy, shuffling bytes back and forth.
        For a connection in pipe mode, no other VCL subroutine will ever get called after vcl_pipe.</p>
        HTML;
    }

    if ('pass' === $returnKeyword) {
        echo <<<HTML
        <p>Called upon entering pass mode.
        In this mode, the request is passed on to the backend,
        and the backend’s response is passed on to the client, but is not entered into the cache.
        Subsequent requests submitted over the same client connection are handled normally.</p>
        HTML;
    }

    if ('hash' === $returnKeyword) {
        echo <<<HTML
        <p>Called after vcl_recv to create a hash value for the request.
        This is used as a key to look up the object in Varnish.</p>
        HTML;
    }
} else {
    echo '<p>It doesn\'t works!</p>';
}