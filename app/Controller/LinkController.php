<?php
namespace App\Controller;
use App\Helper\Helper;
use App\Model\DB;
use function Couchbase\defaultDecoder;

class LinkController extends DB {

    public function getLinks($sessionId){
        //See All links created by the user who logged in
        $sql = "SELECT * FROM links WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$sessionId]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function createLink(){
        //Create Random Unique 6 digit Code with The Helper Class and permitted chars
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $short_link = new Helper();
        $short_link = $short_link->generate_string($permitted_chars, 6);

        //original link form input
        $original_link = $_POST['original_link'];
        $user_id = $_SESSION['id'];


        //Check https: Or http: character in the Original link
        if (strpos($original_link,"https:") !== false || strpos($original_link,"http:") !== false){
            $new_link = explode("/",$original_link);
            $short_link = $new_link[2] . "/$short_link"; //original link: https://aparat.com/url-short-test //short link: aparat.com/224fpp
        } else {
            $new_link = explode("/",$original_link);
            $original_link = "http://" . $_POST['original_link']; //if the original link: aparat.com/url-short-test Combine http:// with original link
            $short_link = $new_link[0] . "/$short_link";  //short link: aparat.com/224fpp
        }

        //Insert Original Link and Short Link and user_id to links table
        $sql = "INSERT INTO links (original_link,short_link,user_id) VALUES ('$original_link','$short_link','$user_id')";
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

    //Update Original Link in Database
    public function update($original_link,$id,$sessionId){
        $sql = "UPDATE links SET original_link = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$original_link,$id,$sessionId]);

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