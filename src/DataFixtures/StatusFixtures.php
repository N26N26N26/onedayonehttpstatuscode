<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{

    const STATUS = [
        ['Code' => 100, 'Message' => "Continue", 'Signification' => "Waiting for the result of the request."],
        ['Code' => 101, 'Message' => "Switching Protocols", 'Signification' => "Acceptance of protocol change."],
        ['Code' => 102, 'Message' => "Processing", 'Signification' => "WebDAV RFC 25183.4: Processing in progress (avoid client exceeding wait time limit)."],
        ['Code' => 103, 'Message' => "Early Hints", 'Signification' => "RFC 82975: (Experimental) Waiting for the final answer, the server returns links that the client can start downloading."],
        ['Code' => 200, 'Message' => "OK", 'Signification' => "Request processed successfully. The answer will depend on the query method used."],
        ['Code' => 201, 'Message' => "Created", 'Signification' => "Request successfully processed and document created."],
        ['Code' => 202, 'Message' => "Accepted", 'Signification' => "Request processed, but no guarantee of result."],
        ['Code' => 203, 'Message' => "Non-Authoritative Information	", 'Signification' => "Information returned, but generated by an uncertified source."],
        ['Code' => 204, 'Message' => "No Content", 'Signification' => "Request processed successfully but no information to return."],
        ['Code' => 205, 'Message' => "Reset Content", 'Signification' => "Request processed successfully, the current page can be deleted."],
        ['Code' => 206, 'Message' => "Partial Content", 'Signification' => "Only part of the resource was transmitted."],
        ['Code' => 207, 'Message' => "Multi-Status", 'Signification' => "WebDAV: Multiple response."],
        ['Code' => 208, 'Message' => "Already Reported", 'Signification' => "WebDAV: The document was previously uploaded to this collection."],
        ['Code' => 210, 'Message' => "Content Different", 'Signification' => "WebDAV: Client-side resource copy differs from server-side copy (content or properties)."],
        ['Code' => 226, 'Message' => "IM Used", 'Signification' => "RFC 32296: The server has completed the request for the resource, and the response is a representation of the result of one or more instance manipulations applied to the current instance."],
        ['Code' => 300, 'Message' => "Multiple Choices", 'Signification' => "The requested URI refers to multiple resources."],
        ['Code' => 301, 'Message' => "Moved Permanently", 'Signification' => "Document moved permanently."],
        ['Code' => 302, 'Message' => "Found", 'Signification' => "Document moved temporarily."],
        ['Code' => 303, 'Message' => "See Other", 'Signification' => "The answer to this query is elsewhere."],
        ['Code' => 304, 'Message' => "Not Modified", 'Signification' => "Document not modified since the last request."],
        ['Code' => 305, 'Message' => "Use Proxy (depuis HTTP/1.1)", 'Signification' => "The request must be redirected to the proxy."],
        ['Code' => 306, 'Message' => "Switch Proxy", 'Signification' => "Code used by an older version of RFC 26167, now reserved. It meant ''The following requests must use the specified proxy''."],
        ['Code' => 307, 'Message' => "Temporary Redirect", 'Signification' => "The request should be temporarily redirected to the specified URI."],
        ['Code' => 308, 'Message' => "Permanent Redirect", 'Signification' => "The request should be permanently redirected to the specified URI."],
        ['Code' => 310, 'Message' => "Too many Redirects", 'Signification' => "The request must be redirected too many times, or is the victim of a redirect loop."],
        ['Code' => 400, 'Message' => "Bad Request", 'Signification' => "The query syntax is incorrect."],
        ['Code' => 401, 'Message' => "Unauthorized	", 'Signification' => "Authentication is required to access the resource."],
        ['Code' => 402, 'Message' => "Payment Required", 'Signification' => "Payment required to access the resource."],
        ['Code' => 403, 'Message' => "Forbidden", 'Signification' => "The server understood the request, but refuses to execute it. Unlike the 401 error, authenticating will not make any difference. On servers where authentication is required, this usually means that authentication was accepted but the access rights do not allow the client to access the resource."],
        ['Code' => 404, 'Message' => "Not Found", 'Signification' => "Resource not found."],
        ['Code' => 405, 'Message' => "Method Not Allowed", 'Signification' => "Request method not allowed."],
        ['Code' => 406, 'Message' => "Not Acceptable", 'Signification' => "The requested resource is not available in a format that would respect the ''Accept'' headers of the request."],
        ['Code' => 407, 'Message' => "Proxy Authentication Required", 'Signification' => "Access to the resource authorized by identification with the proxy."],
        ['Code' => 408, 'Message' => "Request Time-out", 'Signification' => "Waiting time for a request from the client, elapsed on the server side. According to the HTTP specification: ???The client did not issue a request within the time that the server was willing to wait. The client MAY repeat the request without modifications at any later time???."],
        ['Code' => 409, 'Message' => "Conflict", 'Signification' => "The request cannot be processed in the current state."],
        ['Code' => 410, 'Message' => "Gone", 'Signification' => "The resource is no longer available and no redirect address is known."],
        ['Code' => 411, 'Message' => "Length Required", 'Signification' => "The length of the request was not specified."],
        ['Code' => 412, 'Message' => "Precondition Failed", 'Signification' => "Preconditions sent by the request not checked."],
        ['Code' => 413, 'Message' => "Request Entity Too Large	", 'Signification' => "Processing aborted due to too large a request."],
        ['Code' => 414, 'Message' => "Request-URI Too Long", 'Signification' => "URL too long."],
        ['Code' => 415, 'Message' => "Unsupported Media Type", 'Signification' => "Unsupported request format for given method and resource."],
        ['Code' => 416, 'Message' => "Requested range unsatisfiable", 'Signification' => "Incorrect 'range' request header fields."],
        ['Code' => 417, 'Message' => "Expectation failed", 'Signification' => "Expected and defined behavior in the unsatisfactory request header."],
        ['Code' => 418, 'Message' => "I???m a teapot", 'Signification' => "???I am a teapot???: This code is defined in RFC 2324 dated April 1, 1998, Hyper Text Coffee Pot Control Protocol."],
        ['Code' => 421, 'Message' => "Bad mapping / Misdirected Request", 'Signification' => "The request was sent to a server that is unable to produce a response (for example, because a connection was reused)."],
        ['Code' => 422, 'Message' => "Unprocessable entity", 'Signification' => "WebDAV: The entity provided with the request is incomprehensible or incomplete."],
        ['Code' => 423, 'Message' => "Locked", 'Signification' => "WebDAV: The operation cannot take place because the resource is locked."],
        ['Code' => 424, 'Message' => "Method failure", 'Signification' => "WebDAV: A method in the transaction failed."],
        ['Code' => 425, 'Message' => "Too Early", 'Signification' => "RFC 8470: the server cannot process the request because it risks being replayed."],
        ['Code' => 426, 'Message' => "Upgrade Required", 'Signification' => "RFC 2817: The client should change protocol, for example to TLS/1.0."],
        ['Code' => 428, 'Message' => "Precondition Required	", 'Signification' => "RFC 6585: The request must be conditional."],
        ['Code' => 429, 'Message' => "Too Many Requests	", 'Signification' => "RFC 6585: The client issued too many requests in a given time."],
        ['Code' => 431, 'Message' => "Request Header Fields Too Large	", 'Signification' => "RFC 6585: The HTTP headers sent exceed the maximum size allowed by the server."],
        ['Code' => 449, 'Message' => "Retry With", 'Signification' => "Code defined by Microsoft. The request should return after performing an action."],
        ['Code' => 450, 'Message' => "Blocked by Windows Parental Controls", 'Signification' => "Code defined by Microsoft. This error is produced when Windows parental control tools are enabled and block access to the page."],
        ['Code' => 451, 'Message' => "Unavailable For Legal Reasons", 'Signification' => "This error code indicates that the requested resource is unreachable for legal reasons."],
        ['Code' => 456, 'Message' => "Unrecoverable Error", 'Signification' => "WebDAV: Fatal error."],
        ['Code' => 444, 'Message' => "No Response", 'Signification' => "Indicates that the server did not return any information to the client and closed the connection. Visible only in Nginx server logs."],
        ['Code' => 495, 'Message' => "SSL Certificate Error", 'Signification' => "An extension of the 400 Bad Request error, used when the client provided an invalid certificate."],
        ['Code' => 496, 'Message' => "SSL Certificate Required", 'Signification' => "An extension of the 400 Bad Request error, used when a required client certificate is not provided."],
        ['Code' => 497, 'Message' => "HTTP Request Sent to HTTPS Port", 'Signification' => "An extension of the 400 Bad Request error, used when the client sends an HTTP request to port 443 normally intended for HTTPS requests."],
        ['Code' => 498, 'Message' => "Token expired/invalid", 'Signification' => "The token has expired or is invalid."],
        ['Code' => 499, 'Message' => "Client Closed Request", 'Signification' => "The client closed the connection before receiving the response. This error occurs when processing takes too long on the server side."],
        ['Code' => 500, 'Message' => "Internal Server Error", 'Signification' => "Internal Server Error."],
        ['Code' => 501, 'Message' => "Not Implemented", 'Signification' => "Feature claimed not supported by the server."],
        ['Code' => 502, 'Message' => "Bad Gateway ou Proxy Error", 'Signification' => "While acting as a proxy server or gateway, the server received an invalid response from the remote server."],
        ['Code' => 503, 'Message' => "Service Unavailable", 'Signification' => "Service temporarily unavailable or under maintenance."],
        ['Code' => 504, 'Message' => "Gateway Time-out", 'Signification' => "Time spent waiting for a response from a server to an intermediate server."],
        ['Code' => 505, 'Message' => "HTTP Version not supported", 'Signification' => "HTTP version not managed by the server."],
        ['Code' => 506, 'Message' => "Variant Also Negotiates", 'Signification' => "RFC 2295: Negotiation Error. Transparent content negotiation."],
        ['Code' => 507, 'Message' => "Insufficient storage", 'Signification' => "WebDAV: Insufficient space to edit properties or build collection."],
        ['Code' => 508, 'Message' => "Loop detected", 'Signification' => "WebDAV: Loop in resource linking (RFC 5842)."],
        ['Code' => 509, 'Message' => "Bandwidth Limit Exceeded", 'Signification' => "Used by many servers to indicate quota overrun."],
        ['Code' => 510, 'Message' => "Not extended", 'Signification' => "RFC 2774: The request violates the extended HTTP resource access policy."],
        ['Code' => 511, 'Message' => "Network authentication required", 'Signification' => "RFC 6585: The client must authenticate to access the network. Used by captive portals to redirect clients to the authentication page."],
        ['Code' => 520, 'Message' => "Unknown Error	", 'Signification' => "The 520 error is used as a generic response when the origin server returns an unexpected result."],
        ['Code' => 521, 'Message' => "Web Server Is Down", 'Signification' => "The server refused the connection from Cloudflare."],
        ['Code' => 522, 'Message' => "Connection Timed Out", 'Signification' => "Cloudflare was unable to negotiate a TCP handshake with the origin server."],
        ['Code' => 523, 'Message' => "Origin Is Unreachable", 'Signification' => "Cloudflare failed to reach the origin server. This can happen if there is a DNS server name resolution failure."],
        ['Code' => 524, 'Message' => "A Timeout Occurred", 'Signification' => "Cloudflare established a TCP connection to the origin server but did not receive an HTTP response before the connection timed out."],
        ['Code' => 525, 'Message' => "SSL Handshake Failed", 'Signification' => "Cloudflare was unable to negotiate an SSL/TLS handshake with the origin server."],
        ['Code' => 526, 'Message' => "Invalid SSL Certificate", 'Signification' => "Cloudflare could not validate the SSL certificate presented by the origin server."],
        ['Code' => 537, 'Message' => "Railgun Error", 'Signification' => "Error 527 indicates that the request timed out or failed after the WAN connection was established."],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::STATUS as $oneStatus) {
            $status = new Status();
            $status->setCode($oneStatus['Code']);
            $status->setMessage($oneStatus['Message']);
            $status->setSignification($oneStatus['Signification']);
            $this->addReference($oneStatus['Code'], $status);
            $manager->persist($status);
        }

        $manager->flush();
    }
}
