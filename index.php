<?php
require 'vendor/autoload.php';
use Pux\Mux;
use Pux\Executor;

class FilesController {

    public function getFileInfoAction($name) {
        $path = "office/$name";
        if (file_exists($path)) {
            $handle = fopen($path, "r");
            $size = filesize($path);
            $contents = fread($handle, $size);
            $SHA256 = base64_encode(hash('sha256', $contents, true));
            $json = array(
                'BaseFileName' => $name,
                'OwnerId' => 'admin',
                'Size' => $size,
                'SHA256' => $SHA256,
                'Version' => '222888822'
            );
            echo json_encode($json);
        } else {
            echo json_encode(array());
        }
    }

    public function getFileAction($name) {
        $path = "office/$name";
        if (file_exists($path)) {
            $handle = fopen($path, "r");
            $contents = fread($handle, filesize($path));
            header("Content-type: application/octet-stream");
            echo $contents;
        }
    }

}

$mux = new Mux;

$mux->get('/files/:name', ['FilesController','getFileInfoAction']);

$mux->get('/files/:name/contents', ['FilesController','getFileAction']);

$path = $_SERVER['PATH_INFO'];

$args = explode("&", $path);

$route = $mux->dispatch( $args[0] );
Executor::execute($route);
