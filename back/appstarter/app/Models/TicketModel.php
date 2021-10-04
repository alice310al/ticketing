<?php namespace App\Models;
use CodeIgniter\Model;

class TicketModel extends Model{
    protected $table = "T_TICKET_TCK";
    protected $primaryKey = "TCK_ID";
    protected $returnType = "array";
    protected $allowedFields = ["TCK_TYPE", "TCK_TITLE", "TCK_MESSAGE"];
    protected $validationRules = [
        "TCK_TITLE" => ["label" => "Titre", "rules" => "required|max_length[100]"],
        "TCK_MESSAGE" => ["label" => "Message", "rules" => "required"],
        "TCK_TYPE" =>  ["label" => "Type", "rules" => "required|in_list[en attente,en cours,traité,annulé]"],
    ];
}