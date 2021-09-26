<?php 

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Produto;

if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA A VAGA
$newProduto = Produto::getProduto($_GET['id']);



//VALIDAÇAO DO PRODUTO
if(!$newProduto instanceof Produto){
    header('location: index.php?status=error');
    exit;
}



if(isset($_POST['excluir'])){

    $newProduto->excluir();

    header('location: index.php?status=success');
    exit;
}



// INCLUIR O CABEÇALHO, O FORMULARIO E O RODAPE NA PAGIANA DE EXCLUIR
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirma-exclusao.php';
include __DIR__.'/includes/footer.php';



?>