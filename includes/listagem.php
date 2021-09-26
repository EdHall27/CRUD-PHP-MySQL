<?php

$mensagem = '';
if(isset($_GET['status'])){
    switch ($_GET['status']){
        case 'success': 
            $mensagem = '<div class="alert alert-success">Ação executada com sucesso!!</div>';
            break;
        case 'error': 
            $mensagem = '<div class="alert alert-danger">Ação não executada!!</div>';
            break;
    }
}




$resultado = '';
foreach($produto as $produto){
    $resultado .=
    '<tr>
        <td>'.$produto->id.'</td>
        <td>'.$produto->nome.'</td>
        <td>'.$produto->preco.'</td>
        <td>'.date('d/m/Y',strtotime($produto->data)).'</td>
        <td>'.$produto->descricao.'</td>
        <td>
            <a href="editar.php?id='.$produto->id.'"><button type="button" class="btn btn-primary">Editar</button></a>

            <a href="excluir.php?id='.$produto->id.'"><button type="button" class="btn btn-danger">Excluir</button></a>
        </td>
    </tr>';
}

?>


<main>

<?=$mensagem?>
    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Novo Produto</button>
        </a>
    </section>
    <section>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Data de Cadastro</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultado?>
            </tbody>
        </table>
    </section>
</main>