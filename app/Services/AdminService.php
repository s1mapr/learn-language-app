<?php

namespace App\Services;

use App\Repositories\AdminRepository;

class AdminService
{
    private AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }


    public function getAdminByEmail($email){
        return $this->adminRepository->getAdminByEmail($email);
    }
}
