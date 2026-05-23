<?php
/**
 * Classe Patrimonio
 * Gerencia a lógica de dados para os bens patrimoniais.
 */
class Patrimonio {
    private $conn;
    private $table_name = "patrimonios";

    public $id;
    public $codigo;
    public $placa;
    public $descricao;
    public $marca;
    public $modelo;
    public $status;
    public $id_unidade;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para listar todos os patrimônios
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para criar um novo patrimônio
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET codigo=:codigo, placa=:placa, descricao=:descricao, 
                      marca=:marca, modelo=:modelo, status=:status, id_unidade=:id_unidade";

        $stmt = $this->conn->prepare($query);

        // Sanitização
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id_unidade = htmlspecialchars(strip_tags($this->id_unidade));

        // Bind de dados
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id_unidade", $this->id_unidade);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
