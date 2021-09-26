<?php 
//echo "<pre>"; print_r($this); echo "</pre>"; exit;
require __DIR__.'/vendor/autoload.php';

use \App\Entity\Produto;

$produto = produto::getProdutos();


// INCLUIR O CABEÇALHO, O LISTAGEM E O RODAPE NA PAGIANA DE LISTAGEM
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';



?>