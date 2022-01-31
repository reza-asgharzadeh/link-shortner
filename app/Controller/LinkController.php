<?php
namespace App\Controller;
use App\Helper\Helper;
use App\Model\DB;

class LinkController extends DB {
    private $original_link;
    private $short_link;

    public function getLinks($sessionId){
        //See All links created by the user who logged in
        $sql = "SELECT * FROM links WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$sessionId]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function createRandomCode(){
        //Create Random 6 string Code with The Helper Class and permitted chars
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $short_link = new Helper();
        return $short_link->generate_string($permitted_chars, 6);
    }

    public function findString(){
        //Check https: Or http: character in the Original link
        if (strpos($this->original_link,"https:") !== false || strpos($this->original_link,"http:") !== false){
            $new_link = explode("/",$this->original_link);
            $this->short_link = $new_link[2] . "/{$this->createRandomCode()}"; //original link: https://aparat.com/url-short-test //short link: aparat.com/224fpp
        } else {
            $new_link = explode("/",$this->original_link);
            $this->original_link = "http://" . $_POST['original_link']; //if the original link: aparat.com/url-short-test Combine http:// with original link
            $this->short_link = $new_link[0] . "/{$this->createRandomCode()}";  //short link: aparat.com/224fpp
        }
    }

    public function createLink(){
        //original link From input Form and set private Property
        $this->original_link = $_POST['original_link'];
        $user_id = $_SESSION['id'];
        //Run findString Method to Set original_link and short_link to private Property
        $this->findString();

        //Insert Original Link and Short Link From Private Property and user_id Variable to links table
        $sql = "INSERT INTO links (original_link,short_link,user_id) VALUES ('$this->original_link','$this->short_link','$user_id')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        header("Location: /link/panel.php");
    }

    //see edit page
    public function edit($id,$sessionId){
        $sql = "SELECT * FROM links WHERE id = ? AND user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id,$sessionId]);
        $result = $stmt->fetch();
        return $result;
    }

    //Manual Update Original Link and Automatically Short Link in Database
    public function update($original_link,$id,$sessionId){
        //original link From update Method Parameter and set private Property
        $this->original_link = $original_link;
        //Run findString Method to Set original_link and short_link to private Property
        $this->findString();

        $sql = "UPDATE links SET original_link = ?, short_link = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$original_link,$this->short_link,$id,$sessionId]);
        header("Location: /link/panel.php");
    }

    //Delete Record
    public function delete($id,$sessionId){
        $sql = "DELETE FROM links WHERE id = ? AND user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id,$sessionId]);

        header("Location: /link/panel.php");
    }
}