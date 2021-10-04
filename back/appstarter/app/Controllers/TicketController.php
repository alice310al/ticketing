<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class TicketController extends ResourceController
{
    public function __construct(){
        $this->ticketModel = model("App\Model\TicketModel");
        $this->ticketService = service("ticketService");
    }

    public function index()
    {
        $monTableau = $this->ticketService->getAll();

        return $this->respond($monTableau);
    }

    public function create() {
        // Récupération des données
        $data = $this->request->getJSON();

        if(empty($data)) {
            return $this->respond(["Aucune données envoyée"]);
        }

        $result = $this->ticketService->create($data);
        if($result !== true) { // Si il y a une erreur, afficher l'erreur
            return $this->respond([$result]);
        }

        return $this->respond(["true"]);
    }

    public function update($id = null) {
        // Récupération des données
        $data = $this->request->getJSON();

        if(empty($data)) {
            return $this->respond(["Aucune données envoyée"]);
        }

        $result = $this->ticketService->update($id, $data);
        if($result !== true) { // Si il y a une erreur, afficher l'erreur
            return $this->respond([$result]);
        }

        return $this->respond(["true"]);
    }

    public function delete($id = null) {
        $result = $this->ticketService->delete($id);
        if($result !== true) { // Si il y a une erreur, afficher l'erreur
            return $this->respond([$result]);
        }

        return $this->respond(["true"]);
    }

}
