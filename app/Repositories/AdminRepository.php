<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    public function getAdminByEmail($email){
        return Admin::where("email", $email)->first();
    }
}
