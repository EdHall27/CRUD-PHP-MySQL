<?php 

namespace App\Entity;

use App\DB\Database;

use \PDO;

class Produto{
    /** INDENTIFICADOR DO PRODUTO
     *  @var integer */
    public $id;

    /** NOME DO PRODUTO
     *  @var string */
    public $nome;

    /** PREÇO DO PROUDTO
     *  @var float*/
    public $preco;
    
    /** DATA DE CADASTRO DO PROCUTO  
    * @var string */
    public $data;

    /** DESCRIÇÃO SOBRE O PRODUTO(PODE CONTER HTML)
     *  @var  string */
    public $descricao;

    /** METODO RESPONSAVEL POR CADASTRAR UMA NOVO PRODUTO NO BANCO 
     * @return boolean */
    public function cadastrar(){
        // DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');
        // INSERIR A VAGA NO BANCO
        $newDatabase = new Database('produto');
        $this->id = $newDatabase->insert([
            'nome' => $this->nome,
            'preco' => $this->preco,
            'data' => $this->data,
            'descricao' => $this->descricao,
        ]);
        
      
        
        // RETORNAR SUCESSO
        return true;
    }

    /** METODO RESPOSAVEL POR EDITAR O PRODUTO NO DB
     * @return boolean
     */
    public function atualizar(){

        return (new Database('produto'))->update('id = '.$this->id,[
            'nome' => $this->nome,
            'preco' => $this->preco,
            'data' => $this->data,
            'descricao' => $this->descricao,
        ]);
    }

    /** METODO RESPOSAVEL PELA EXCLUSAO DO PRODUTO NO DB
     * @return boolean
     */
    public function excluir(){

        return (new Database('produto'))->delete('id = '.$this->id);
    }



    /** METODO RESPONSAVEL POR OBTER OS PRODUTOS DO DB
     * @param string $where
     * @param string $order
     * @param string $limit]
     * @return array
     */
    public static function getProdutos($where = null,$order = null,$limit = null){

        return (new Database('produto'))->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);
    }


    /** METODO RESPONSAVEL POR BUSCAR UM PRODUTO PELO SEU ID
     * @param integer $id
     * @return Produto
     */
    public static function getProduto($id){

        return (new Database('produto'))->select('id = '.$id)->fetchObject(self::class);
    }
}
