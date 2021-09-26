
<main>
    <section>
        <a href="index.php" >
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>
    <h2 class="mt-3"><?= TITLE ?></h2>

    <form  method="POST">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" value=" <?php echo $newProduto->nome; ?> ">
        </div>
        <div class="form-group">
            <label>Preço</label>
            <input type="text" class="form-control" name="preco" value="<?php echo $newProduto->preco; ?>" >
        </div>
        <div class="form-group">
            <label>Data de Cadastro</label>
            <input type="date" class="form-control" name="data" value=" <?php echo $newProduto->data; ?> ">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea class="form-control" name="descricao" rows="4" > <?php echo $newProduto->descricao; ?> </textarea>
        </div>
        
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>
</main>