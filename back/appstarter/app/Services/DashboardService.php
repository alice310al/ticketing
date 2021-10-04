<?php

namespace App\Services;


class DashboardService
{
    public function __construct(){
        $this->ticketModel = model("App\Model\TicketModel");
    }

    public function getAllCount(){
        $allCount = [];
        $allCount["tickets"] = $this->getCountTicket();
        $allCount["ticketsTraite"] = $this->getCountTicketTraite();
        $allCount["ticketsCancel"] = $this->getCountTicketCancel();
        $allCount["user"] = 10; // Valeurs en dure en attendant la gestion des utilisateurs


        return $allCount;

    }

    public function getCountTicket() {
        return $this->ticketModel->countAll();
    }

    public function getCountTicketTraite() {
        return $this->ticketModel->where("TCK_TYPE", "traité")->countAllResults();
    }

    public function getCountTicketCancel() {
        return $this->ticketModel->where("TCK_TYPE", "annulé")->countAllResults();
    }


}