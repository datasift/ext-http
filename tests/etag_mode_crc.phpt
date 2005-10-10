--TEST--
sane crc etags
--SKIPIF--
<?php
include 'skip.inc';
chkver(5.1);
?>
--FILE--
<?php
echo "-TEST\n";

ini_set('http.etag_mode', HTTP_ETAG_CRC32);
HttpResponse::setData("abc");
$php = HttpResponse::getEtag();

ini_set('http.etag_mode', HTTP_ETAG_MHASH_CRC32);
HttpResponse::setData("abc");
$crc = HttpResponse::getEtag();

ini_set('http.etag_mode', HTTP_ETAG_MHASH_CRC32B);
HttpResponse::setData("abc");
$equ = HttpResponse::getEtag();

echo $php,"\n", $equ,"\n", $crc,"\n";

var_dump($equ === $php);
var_dump($equ !== $crc);

echo "Done\n";
--EXPECTF--
%sTEST
c2412435
c2412435
73bb8c64
bool(true)
bool(true)
Done