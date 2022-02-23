<?php
class Producto
{
    private $id=0;
    private $nombre="";
    private $codigo="";
    private $descripcion="";
    private $fechaingreso=null;
    private $fechabaja=null;
    private $proveedor = null;
    private $marca="";
    private $rubro="";
    private $stock=1;
    private $stockminimo=1;
    private $costototal=0;
    private $precioventa=0;
    private $imagen="";
    private $imagenes=null;

    public function __construct($xId=0,$xNombre="",$xCodigo="",$xDescripcion="",$xFechaIngreso=null,$xFechaBaja=null,
    $xProveedor=null,$xMarca="",$xRubro="",$xStock=1,$xStockMinimo=1,$xCostoTotal=0,$xPrecioVenta=0,$xImagen="",$xImagenes)
    {
        $this->id=$xId;
        $this->nombre=$xNombre;
        $this->codigo=$xCodigo;
        $this->descripcion=$xDescripcion;
        $this->fechaingreso=$xFechaIngreso;
        $this->fechabaja=$xFechaBaja;
        $this->proveedor=$xProveedor;
        $this->marca=$xMarca;
        $this->rubro=$xRubro;
        $this->stock=$xStock;
        $this->stockminimo=$xStockMinimo;
        $this->costototal=$xCostoTotal;
        $this->precioventa=$xPrecioVenta;
        $this->imagen=$xImagen;
        $this->imagenes=$xImagenes;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($xId)
    {
        $this->id=$xId;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($xNombre)
    {
        $this->nombre=$xNombre;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($xCodigo)
    {
        $this->codigo=$xCodigo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($xDescripcion)
    {
        $this->descripcion=$xDescripcion;
    }

    public function getFechaIngreso()
    {
        return $this->fechaingreso;
    }

    public function setFechaIngreso($xFechaIngreso)
    {
        $this->fechaingreso=$xFechaIngreso;
    }

    public function getFechaBaja()
    {
        return $this->fechabaja;
    }

    public function setFechaBaja($xFechaBaja)
    {
        $this->fechabaja=$xFechaBaja;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setProveedor($xProveedor)
    {
        $this->proveedor=$xProveedor;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($xMarca)
    {
        $this->marca=$xMarca;
    }

    public function getRubro()
    {
        return $this->rubro;
    }

    public function setRubro($xRubro)
    {
        $this->rubro=$xRubro;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($xStock)
    {
        $this->stock=$xStock;
    }

    public function getStockMinimo()
    {
        return $this->stockminimo;
    }

    public function setStockMinimo($xStockMinimo)
    {
        $this->stockMinimo=$xStockMinimo;
    }

    public function getCostoTotal()
    {
        return $this->costototal;
    }

    public function setCostoTotal($xCostoTotal)
    {
        $this->costototal=$xCostoTotal;
    }

    public function getPrecioVenta()
    {
        return $this->precioventa;
    }

    public function setPrecioVenta($xPrecioVenta)
    {
        $this->precioventa=$xPrecioVenta;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($xImagen)
    {
        $this->imagen=$xImagen;
    }

    public function getImagenes()
    {
        return $this->imagenes;
    }

    public function setImagenes($xImagenes)
    {
        $this->imagenes =$xImagenes;
    }
}
?>