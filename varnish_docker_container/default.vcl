vcl 4.0;
import std;

backend default {
    .host = "nginx_docker_container";
    .port = "5103";
}

sub vcl_recv {
    if (req.url ~ "/pass") {
        set req.url = "/";
        set req.http.X-VARNISH-RETURN-KEYWORD = "pass";
        return (pass);
    }

    if (req.url ~ "/pipe") {
        set req.url = "/";
        set req.http.X-VARNISH-RETURN-KEYWORD = "pipe";
        return (pipe);
    }

    if (req.url ~ "/purge") {
        set req.url = "/";
        return (purge);
    }

    set req.http.X-VARNISH-RETURN-KEYWORD = "hash";
    return(hash);
}