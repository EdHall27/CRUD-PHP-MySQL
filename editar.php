<?php 

require __DIR__.'/vendor/autoload.php';
define('TITLE','Editar Produto');

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

//VALIDAÇAO DO POST
if(isset($_POST['nome'],$_POST['preco'],$_POST['data'],$_POST['descricao'])){
   
    $newProduto->nome = $_POST['nome'];
    $newProduto->preco = $_POST['preco'];
    $newProduto->data = $_POST['data'];
    $newProduto->descricao = $_POST['descricao'];
    
    $newProduto->atualizar();

    header('location: index.php?status=success');
    exit;
}



// INCLUIR O CABEÇALHO, O FORMULARIO E O RODAPE NA PAGIANA DE EDITAR
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/form-edit.php';
include __DIR__.'/includes/footer.php';



?>