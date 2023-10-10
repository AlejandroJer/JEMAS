<?php
namespace modelos;
use PDO;
class usuarios extends conexion{
    
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $id_usuario;
    private $id_rol;
    private $fecha_movimiento; // no pertenece a la tabla
    private $id_usuario_movimiento; // no pertenece a la tabla

    public function __construct(){
        parent::__construct();
    }

    public function Insertar(string $nombre, string $apellido, string $email, string $password, int $id_rol){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->password = $password;
        $this->id_rol = $id_rol;

        $sql="INSERT INTO usuarios(nombre_usr,apellido_usr,email_usr,contraseña,id_perfil) VALUES(?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->nombre,$this->apellido,$this->email,$this->password,$this->id_rol);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function GetUsuarios(){
        $sql="SELECT * FROM usuarios ORDER BY id_usr DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetUsuarioById($id){
        $sql="SELECT * FROM usuarios WHERE id_usr = $id";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch();
        return $request;
    }

    public function SetMovimineto(string $fecha_movimiento, int $id_usuario_movimiento, int $id_usuario, string $nombre, string $apellido){
        $this->fecha_movimiento = $fecha_movimiento;
        $this->id_usuario_movimiento = $id_usuario_movimiento;
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;

        $sql="INSERT INTO movimientos(fecha_movimiento,id_usuario_movimiento,id_usr,nombre_usr,apellido_usr) VALUES(?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->fecha_movimiento,$this->id_usuario_movimiento,$this->id_usuario,$this->nombre,$this->apellido);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert; //No tengo ni idea de si sirve este funcion
    }

    public function GetMovimientos(){
        $sql="SELECT * FROM movimientos ORDER BY id_movimiento DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetMovimientoByIdUrs($id){
        $sql="SELECT * FROM movimientos WHERE id_movimiento = $id ORDER BY fecha_creacion DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch( PDO::FETCH_ASSOC );
        return $request;
    }

    public function UpdateUsuario(int $id, string $nombre, string $apellido, string $email, string $password, int $id_rol){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->password = $password;
        $this->id_rol = $id_rol;

        $sql="UPDATE usuarios SET nombre_usr=?, apellido_usr=?, email_usr=?, contraseña=?, id_perfil=? WHERE id_usr = $id";
        $update= $this->conn->prepare($sql);
        $arrData= array($this->nombre,$this->apellido,$this->email,$this->password,$this->id_rol);
        $resExecute = $update->execute($arrData);
        return $resExecute;
    }

    public function DeleteUsuario(int $id){
        $sql="DELETE FROM usuarios WHERE id_usr = ?";
        $arrWhere = array($id);
        $delete = $this->conn->prepare($sql);
        $del = $delete->execute($arrWhere);
        return $del;
    }

}
?>