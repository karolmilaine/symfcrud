<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sqlite3;

class cont1 extends AbstractController {
  private $db;
  function __construct() {
    $this->db = new Sqlite3("../../crudbase.db");
  }
  public function Data($action, $id, $data) {

    switch ($action) {
      case "test":
      //$this->db->exec("create table crud (data varchar(128),deleted boolean);");
      return new Response("<html><body>".$this->db->lastErrorMsg()."</body></html>");
      break;
      case "create":
      $query = $this->db->prepare("insert into crud (data, deleted) values (:data, 0)");
      $query->bindvalue(":data", $data);
      $result = $query->execute();
      // return $this->render("crud/result.html.twig", [
      //   "id" => "create",
      //   "result" => "Created $data"
      // ]);
      break;
      case "read":
      $query = $this->db->querySingle("select data from crud where rowid = '$id' and deleted = 0");
      if (!is_null($query)){
        return $this->render("crud/result.html.twig", [
          "id" => $id,
          "result" => $query
        ]);
      } else {
        return $this->render("crud/result.html.twig", [
          "id" => $id,
          "result" => "does not exist"
        ]);
      }
      break;
      case "update":
      $query = $this->db->querySingle("select data from crud where rowid = '$id' and deleted = 0");
      if (!is_null($query)) {
        $query = $this->db->prepare("update crud set data = :data where rowid='$id'");
        $query->bindvalue(":data", $data);
        $result = $query->execute();
        // return $this->render("crud/result.html.twig", [
        //   "id" => $id,
        //   "result" => "updated"
        // ]);
      } else {
        return $this->render("crud/result.html.twig", [
          "id" => $id,
          "result" => "does not exist"
        ]);
      }
      break;
      case "delete":
      $query = $this->db->querySingle("select data from crud where rowid = '$id' and deleted = 0");
      if (!is_null($query)) {
        $result = $this->db->exec("update crud set deleted = 1 where rowid='$id'");
        // return $this->render("crud/result.html.twig", [
        //   "id" => $id,
        //   "result" => "deleted, result: ".$result
        // ]);
        // return new Response("<html><body>$id deleted, result: $result</body></html>");
      } else {
        return $this->render("crud/result.html.twig", [
          "id" => $id,
          "result" => "does not exist"
        ]);
      }
      break;
      default:
      return new Response("<html><body>Error. Wrong request.</body></html>");
      break;
    }
    return $this->redirectToRoute('showData');

  }
}
