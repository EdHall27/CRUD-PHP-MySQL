<?php

namespace App\DB;

use \PDO;
use \PDOException;

class Database {

    /** HOST CONEXÃO COM O BANCO DE DADOS 
     *  @var string
     */
    const HOST = 'localhost';

    /** NOME DO BANCO DE DADOS
     *  @var string
     */
    const NAME = 'servicos';

    /** USUARIO DO BANCO
     * @var string
     */
    const USER = 'root';

    /** SENHA DO BANCO DE DADOS */
    const PASS = '';

    /** NOME DA TABELA
     * @var string
     */
    private $table;

    /** INSTAnCIA DE CONEXÂO COM O BANCO DE DADOS 
     * @var PDO
     */
    private $connection;

    /** DEFINE A TABELA E INSTACIA A CONEXÂO
     *  @param string $table
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    /** METODO RESPONSAVEL POR CRIAR UMA CONEXAO COM O BANCO DE DADOS  */
    private function setConnection(){
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }

    }
    /** METODO RESPOSAVEL POR EXECUTAR QUERIES DETRO DO BANCO DE DADOS
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query,$params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /** METODO RESPOSAVEL POR INSERIR DADOS
     * @param array $values [ field => values ]
     * @return integer
     */
    public function insert($values){
        // DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');
       
        //MONTA QUERY
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
        
        // EXECUTA O INSERT
        $this->execute($query,array_values($values));
       

        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    /** METODO RESPOSAVEL POR FAZER UMA CONSULTA NO BANCO DE DADOS
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null,$order = null,$limit = null, $fields = '*'){
        // DADOS DA QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : ''; 
        $limit = strlen($limit) ? 'LIMIT '.$limit : ''; 
        
        // MONTA A QUERY
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        //EXECUTA A QUERY
        return $this->execute($query);

    }

    /** METODO RESPONSAVEL POR EXECUTAR A ATULIZAÇAO NO DB
     * @param string $where
     * @param array $values [field => values]
     * @return boolean 
     */
    public function update($where,$values){
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA A QUERY
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

        // EXECUTAR A QUERY
        $this->execute($query,array_values($values));

         //RETORNA COM SUCESSO
        return true;
    }

    /** METODO RESPONSAVEL POR EXCLUIR DADOS DO DB
     * @param string $where
     * @return boolean 
     */
    public function delete($where){
        //MONTA A QUERY
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        //EXECUTA A QUERY
        $this->execute($query);

        //RETORNA COM SUCESSO
        return true;
    }

}


