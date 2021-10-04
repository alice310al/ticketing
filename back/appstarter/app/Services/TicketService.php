<?php

namespace App\Services;


class TicketService
{
    public function __construct(){
        $this->ticketModel = model("App\Model\TicketModel");
    }

    public function getAll(){
        $tickets = $this->ticketModel->findAll();
        return $tickets;

    }

    public function create($data) {
        if($this->ticketModel->insert($data) === false) {
            // Renvoi les erreurs si une des rêgles de validation n'est pas passée
            return $this->ticketModel->errors();
        }

        return true;
    }

    public function update($id, $data) {
        
        if($this->ticketModel->update($id, $data) === false) {
            // Renvoi les erreurs si une des rêgles de validation n'est pas passée
            return $this->ticketModel->errorMessage();
        }

        return true;
    }

    public function delete($id) {
        
        if($this->ticketModel->delete($id) === false) {
            // Renvoi les erreurs si une des rêgles de validation n'est pas passée
            return $this->ticketModel->errorMessage();
        }

        return true;
    }


}