<?php
namespace App\Controller;
use App\Helper\Helper;
use App\Model\DB;

class LinkController extends DB {

    public function getLinks($sessionId){
        $sql = "SELECT * FROM links WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$sessionId]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function createLink(){
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $short_link = new Helper();
        $short_link = $short_link->generate_string($permitted_chars, 6);

        $original_link = $_POST['original_link'];
        $user_id = $_SESSION['id'];


        if (strpos($original_link,"https:") !== false || strpos($original_link,"http:") !== false){
            $new_link = explode("/",$original_link);
            $short_link = $new_link[2] . "/$short_link";
        } else {
            $new_link = explode("/",$original_link);
            $original_link = "http://" . $_POST['original_link'];
            $short_link = $new_link[0] . "/$short_link";
        }

        $sql = "INSERT INTO links (original_link,short_link,user_id) VALUES ('$original_link','$short_link','$user_id')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        header("Location: /link/panel.php");
    }

    public function edit($id,$sessionId){
        $sql = "SELECT * FROM links WHERE id = ? AND user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id,$sessionId]);
        $result = $stmt->fetch();
        return $result;
    }
    public function update($original_link,$id,$sessionId){
        $sql = "UPDATE links SET original_link = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$original_link,$id,$sessionId]);

        header("Location: /link/panel.php");
    }

    public function delete($id,$sessionId){
        $sql = "DELETE FROM links WHERE id = ? AND user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id,$sessionId]);

        header("Location: /link/panel.php");
    }
}