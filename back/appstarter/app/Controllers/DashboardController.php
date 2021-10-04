<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class DashboardController extends ResourceController
{
    public function __construct(){
        $this->dashboardService = service("dashboardService");
    }

    public function index() {
        $result = $this->dashboardService->getAllCount();

        return $this->respond($result);
    }


}
