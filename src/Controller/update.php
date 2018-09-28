<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class update extends AbstractController {
  public function update(Request $request, $id) {
    if (null !== $request->request->get('data') && null !== $request->request->get('id')) {
      return $this->redirectToRoute('data', array('action' => 'update', 'id' => $request->request->get('id'), 'data' => $request->request->get('data')));
    } elseif (isset($id)) {
      return $this->render("crud/update.html.twig", array('id' => $id));
    } else {
      return $this->redirectToRoute('showData');
    }
  }
}
