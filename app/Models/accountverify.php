<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accountverify extends Model
{
    use HasFactory;

    /**
     * @var int|mixed
     */
    private $confirm_code;
    /**
     * @var mixed
     */
    private $user_id;
}
