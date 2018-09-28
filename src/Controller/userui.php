<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sqlite3;

class userui extends AbstractController {
  private $db;
  function __construct() {
    $this->db = new Sqlite3("../../crudbase.db");
  }
  public function interface () {
    $result = $this->db->query("select rowid, data from crud where deleted = 0");
    //$result = $query->execute();
    $usableIDs = [];
    while ($row = $result->fetchArray()) {
      $usableIDs[] = ["id" => $row["rowid"], "data" => $row["data"]];
    }
    return $this->render("crud/ui.html.twig", ["elements" => $usableIDs]);
  }
}
