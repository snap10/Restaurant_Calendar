<?php
class Client
{

    public $id;
    public $firstname;
    public $email;
    public $surename;
    public $street;
    public $housenumber;
    public $zip;
    public $city;
    public $phone;
    public $division;


    public function __construct($id, $firstname, $surename, $email, $street, $housenumber, $zip, $city, $phone,$division)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->surename = $surename;
        $this->email = $email;
        $this->street = $street;
        $this->housenumber = $housenumber;
        $this->zip = $zip;
        $this->city = $city;
        $this->phone = $phone;
        $this->division = $division;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM clients');

        // we create a list of Post objects from the database results
        while ($client=$req->fetch_assoc()) {

            $list[] = new Client($client['idClient'], $client['firstname'], $client['surename'], $client['email'], $client['street'], $client['numbr'], $client['zipcode'], $client['city'], $client['phone'],$client['division']);

        }
        return $list;
    }

    public static function find($id)
    {  
        $db = Db::getInstance();
        // we make sure $id is an integer

        $req = $db->prepare('SELECT * FROM clients WHERE idClient = ?');
      
        $req->bind_param('i', $id);
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute();
        $req->bind_result($idClient,$firstname,$surename,$email,$street,$numbr,$zipcode,$city,$phone,$divistion);
        $client = $req->fetch();
        $clientObj = new Client($idClient,$firstname,$surename,$email,$street,$numbr,$zipcode,$city,$phone,$divistion);

        return $clientObj;
    }
    
    public static function findByEmail($email)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $req = $db->prepare('SELECT * FROM clients WHERE email = ?');
        $req->bind_param('s', $email);
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute();
       $req->bind_result($idClient,$firstname,$surename,$email,$street,$numbr,$zipcode,$city,$phone,$divistion);
        $client = $req->fetch();
        $clientObj = new Client($idClient,$firstname,$surename,$email,$street,$numbr,$zipcode,$city,$phone,$divistion);

        return $clientObj;
    }

    public static function createnew($firstname, $surename, $email, $street, $housenumber, $zip, $city, $phone,$division)
    {
        $db = Db::getInstance();
        if ($stmt = $db->prepare('INSERT INTO clients (firstname,surename,email,street,numbr,zipcode,city,phone,division) VALUES(?,?,?,?,?,?,?,?,?)')) {
            $stmt->bind_param('ssssiisss', $firstname, $surename, $email, $street, $housenumber, $zip, $city, $phone,$division);
            $stmt->execute();
            $clientid = $stmt->insert_id;
            return $clientid;
        }else{
            //TODO
            var_dump($db->error);
        }
    }

}

?>
