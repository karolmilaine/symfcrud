<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class create extends AbstractController {
  public function create(Request $request) {
    if (null !== $request->request->get('data')) {
      return $this->redirectToRoute('data', array('action' => 'create', 'id' => 0, 'data' => $request->request->get('data')));
    } else {
      return $this->render("crud/create.html.twig");
    }
  }
}
