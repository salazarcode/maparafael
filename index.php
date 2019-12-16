<?php

class Coordenada
{
    public $Categoria1 = "";
    public $Categoria2 = "";
    public $Categoria3 = "";
    public $Latitude = "";
    public $Longitude = "";

    function __construct($_autor, $_extra) {
        $elements = explode(":", $_autor);
        $this->Categoria1  = trim($elements[0]);
        $this->Categoria2  = trim($elements[1]);
        $this->Categoria3  = trim($elements[2]);

        if($_extra!="")
        {
            $coords = explode(",", $_extra);
            $this->Latitude  = trim($coords[0]);
            $this->Longitude  = trim($coords[1]);            
        }

    }
}

$servername = "192.185.82.200";
$username = "bands7ft_maps";
$password = "Java***174";
$db = "bands7ft_db";


$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select autor, extra from articulo where cat_id = 22 and cat_nivel = 1";
$result = $conn->query($sql);

$resArray = [];

if (mysqli_num_rows($result) > 0) 
{
    while($row = mysqli_fetch_assoc($result)) 
    {
        $obj = new Coordenada($row["autor"], $row["extra"]);
        $resArray[] = $obj;
    }
} 
else 
{
    echo "0 results";
}

echo json_encode($resArray);

$conn->close();

?>