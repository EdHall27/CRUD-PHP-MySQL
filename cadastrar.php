<?php 

require __DIR__.'/vendor/autoload.php';
define('TITLE','Cadastrar Produto');

use \App\Entity\Produto;


//VALIDAÇAO DO POST
if(isset($_POST['nome'],$_POST['preco'],$_POST['data'],$_POST['descricao'])){
    $newProduto = new Produto;
    $newProduto->nome = $_POST['nome'];
    $newProduto->preco = $_POST['preco'];
    $newProduto->data = $_POST['data'];
    $newProduto->descricao = $_POST['descricao'];
    $newProduto->cadastrar();

    header('location: index.php?status=success');
    exit;
}



// INCLUIR O CABEÇALHO, O FORMULARIO E O RODAPE NA PAGIANA DE CADASTRO
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/form.php';
include __DIR__.'/includes/footer.php';



?>