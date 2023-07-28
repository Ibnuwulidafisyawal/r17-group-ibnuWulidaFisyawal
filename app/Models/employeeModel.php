<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employeeModel extends Model
{
    use HasFactory;


    protected $table = 'employee_table';
    protected $fillable = ['id','nama','jabatan', 'jenis_kelamin', 'alamat'];

    // public static function fetchDataFromURL()
    // {
    //     $response = Http::get('https://r17group.id/test-candidate/');
    //     $data = $response->json();

    //     return $data;
    // }
}
