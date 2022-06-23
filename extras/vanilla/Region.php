<?php

class Region
{
    private $regID;
    private $regNombre;

    public function listarRegiones()
    {
        $link = Conexion::conectar();
        $sql = "SELECT regID, regNombre
                    FROM regiones";

        $stmt = $link->prepare($sql);
        $stmt->execute();

        $regiones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $regiones;
    }
    public function verRegionPorID()
    {
        $id = $_POST['id'];
        $link = Conexion::conectar();
        $sql = "SELECT regID, regNombre
                    FROM regiones
                    WHERE id = :id";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $regiones = $stmt->fetch(PDO::FETCH_ASSOC);
        return $regiones;
    }

    public function agregarRegion()
    {
        $regNombre = $_POST['regNombre'];
        $link = Conexion::conectar();
        $sql = "INSERT INTO regiones
                                    ( regNombre )
                                VALUE
                                    ( :regNombre )";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':regNombre', $regNombre);
        $stmt->execute();
        return true;
    }

    public function eliminarRegion()
    {
        $regID = $_POST['regID'];
        $link = Conexion::conectar();
        $sql = 'DELETE FROM regiones
                    WHERE regID = :id';
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':id', $regID);
        $stmt->execute();
    }

}