<?php

function dd(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function get_mime_type($filename)
{
    $exploded = explode(".", $filename);
    $ext = strtolower($exploded[count($exploded) - 1]);

    $mimetypes = [
        "txt" => "text/plain",
        "htm" => "text/html",
        "html" => "text/html",
        "php" => "text/html",
        "css" => "text/css",
        "js" => "application/javascript",
        "json" => "application/json",
        "xml" => "application/xml",
        "swf" => "application/x-shockwave-flash",
        "flv" => "video/x-flv",

        // images
        "png" => "image/png",
        "jpe" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "jpg" => "image/jpeg",
        "gif" => "image/gif",
        "bmp" => "image/bmp",
        "ico" => "image/vnd.microsoft.icon",
        "tiff" => "image/tiff",
        "tif" => "image/tiff",
        "svg" => "image/svg+xml",
        "svgz" => "image/svg+xml",

        // archives
        "zip" => "application/zip",
        "rar" => "application/x-rar-compressed",
        "exe" => "application/x-msdownload",
        "msi" => "application/x-msdownload",
        "cab" => "application/vnd.ms-cab-compressed",

        // audio/video
        "mp3" => "audio/mpeg",
        "qt" => "video/quicktime",
        "mov" => "video/quicktime",

        // adobe
        "pdf" => "application/pdf",
        "psd" => "image/vnd.adobe.photoshop",
        "ai" => "application/postscript",
        "eps" => "application/postscript",
        "ps" => "application/postscript",

        // ms office
        "doc" => "application/msword",
        "rtf" => "application/rtf",
        "xls" => "application/vnd.ms-excel",
        "ppt" => "application/vnd.ms-powerpoint",
        "docx" => "application/msword",
        "xlsx" => "application/vnd.ms-excel",
        "pptx" => "application/vnd.ms-powerpoint",

        // open office
        "odt" => "application/vnd.oasis.opendocument.text",
        "ods" => "application/vnd.oasis.opendocument.spreadsheet",
    ];

    if (isset($mimetypes[$ext])) {
        return $mimetypes[$ext];
    } else {
        return "application/octet-stream";
    }
}

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

// APIs
if (str_starts_with($uri, "/api")) {
    echo json_encode(["status" => "success", "message" => "APIs"]);
    exit();
}

// Assets
if (str_starts_with($uri, "/assets") || $uri === "/vite.svg") {
    $path = str_replace("/", DIRECTORY_SEPARATOR, "frontend-web/dist$uri");
    if (file_exists($path)) {
        $mime = get_mime_type($path);
        header("Content-Type: $mime");
        readfile($path);
        exit();
    }
}

readfile("frontend-web/dist/index.html");
