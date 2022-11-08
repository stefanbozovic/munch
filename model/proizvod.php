<?php ?>
<?php 
class Proizvod
{
    public $proizvod_id;
    public $naziv;
    public $cena;
    public $akcija_id;

    public function __construct($proizvod_id = null, $naziv = null, $cena = null, $akcija_id = null)
    {
        $this->proizvod_id = $proizvod_id; 
        $this->naziv = $naziv;
        $this->cena = $cena;
        $this->akcija_id = $akcija_id;
    }
    public static function ucitaj(mysqli $conn){
        $q = "SELECT * FROM proizvodi";
        return $conn->query($q);
    }
}
?>
