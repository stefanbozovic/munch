<?php ?>
<?php 
class Akcija
{
    public $akcija_id;
    public $naziv;
    public $procenat_popusta;

    public function __construct($akcija_id = null, $naziv = null, $procenat_popusta = null)
    {
        $this->akcija_id = $akcija_id; 
        $this->naziv = $naziv;
        $this->procenat_popusta = $procenat_popusta;
    }
    
    public static function ucitaj( mysqli $conn){
        $q = "SELECT * FROM akcije";
        return $conn->query($q);
    }
    
    public static function dodaj( $naziv, $procenat_popusta, mysqli $conn)
    {
        $q = "INSERT INTO akcije( naziv, procenat_popusta) VALUES('$naziv', '$procenat_popusta')";
        return $conn->query($q);
    }
    public static function uzmiPoslednju(mysqli $conn)
    {
        $q = "SELECT * FROM akcije ORDER BY akcija_id DESC LIMIT 1";
        return $conn->query($q);
    }

}
?>