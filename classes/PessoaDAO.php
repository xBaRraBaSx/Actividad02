<?php

include_once 'Pessoa.php';

class PessoaDAO extends Pessoa {

//atributo
    private $tabela = "pessoa";

    //Método Insertar - inserta un nuevo registro en la BD 
    public function inserir(Pessoa $pessoa) {
        $sql = "INSERT INTO $this->tabela
                (nome, sobrenome, data_nascimento, genero, estado_civil)
                values(?,?,?,?,?)";
        $stmt = PessoaDAO::preparaSQL($sql);
        $stmt->bindValue(1, $pessoa->getNome());
        $stmt->bindValue(2, $pessoa->getSobrenome());
        $stmt->bindValue(3, $pessoa->getData_nascimento());
        $stmt->bindValue(4, $pessoa->getGenero());
        $stmt->bindValue(5, $pessoa->getEstado_civil());
        return $stmt->execute();
    }

    //Método Actualizar - actualiza un registro en la BD
    public function atualizar($pessoa) {
        $sql = "UPDATE $this->tabela SET nome = ?, sobrenome = ?, data_nascimento = ?,
                genero = ?, estado_civil = ? WHERE ID = ?";
                
        $stmt = PessoaDAO::preparaSQL($sql);
        $stmt->bindValue(1, $pessoa->getNome());
        $stmt->bindValue(2, $pessoa->getSobrenome());
        $stmt->bindValue(3, $pessoa->getData_nascimento());
        $stmt->bindValue(4, $pessoa->getGenero());
        $stmt->bindValue(5, $pessoa->getEstado_civil());
        $stmt->bindValue(6, $pessoa->getId());
        return $stmt->execute();
    }

    //Método Listar - lista todos los registro de la tabla Personas
    public function listarTudo() {
        $sql = "select * from  $this->tabela";
        $stmt = Pessoa::preparaSQL($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Método Eliminar - Borra un registro de la BD

    public function excluir(Pessoa $pessoa) {
        $sql = "delete from $this->tabela where id = ?";
        $stmt = Pessoa::preparaSQL($sql);
        $stmt->bindValue(1, $pessoa->getId());
        return $stmt->execute();
    }

    //metodo listar -> seleciona un registro 
    public function listar(Pessoa $pessoa) {
        $sql = "SELECT * FROM $this->tabela where id = ?";
        $stmt = Pessoa::preparaSQL($sql);
        $stmt->bindValue(1, $pessoa->getId());
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}
