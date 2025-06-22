<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php'; // ajuste o caminho se necessário

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Teste mPDF funcionando!</h1>');
$mpdf->Output();