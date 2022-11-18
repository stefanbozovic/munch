<?php ?>
<?php 
class Proizvod
{
    public $proizvod_id;
    public $naziv_proizvoda;
    public $cena;
    public $akcija_id;

    public function __construct($proizvod_id = null, $naziv_proizvoda = null, $cena = null, $akcija_id = null)
    {
        $this->proizvod_id = $proizvod_id; 
        $this->naziv_proizvoda = $naziv_proizvoda;
        $this->cena = $cena;
        $this->akcija_id = $akcija_id;
    }
    public static function ucitaj(mysqli $conn){
        $q = "SELECT * FROM proizvodi LEFT JOIN akcije ON proizvodi.akcija_id = akcije.akcija_id";
        return $conn->query($q);
    }
    public static function dodaj($naziv_proizvoda, $cena, $akcija_id, mysqli $conn)
    {
        $q = "INSERT INTO proizvodi(naziv_proizvoda, cena, akcija_id) VALUES('$naziv_proizvoda', '$cena', '$akcija_id')";
        return $conn->query($q);
    }
    public static function izmeni($proizvod_id,$naziv_proizvoda, $cena, $akcija_id, mysqli $conn)
    {
        $q = "UPDATE proizvodi set naziv_proizvoda='$naziv_proizvoda', cena='$cena', akcija_id='$akcija_id' where proizvod_id=$proizvod_id";
        return $conn->query($q);
    }
    public static function obrisiPoIndeksu($proizvod_id, mysqli $conn)
    {
        $q = "DELETE FROM proizvodi WHERE proizvod_id=$proizvod_id";
        return $conn->query($q);
    }
    public static function uzmiPoslednji(mysqli $conn)
    {
        $q = "SELECT * FROM proizvodi ORDER BY proizvod_id DESC LIMIT 1";
        return $conn->query($q);
    }
}
?>
