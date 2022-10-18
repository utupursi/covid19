<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryStatistic extends Model
{

    use HasFactory;

    protected $table='country_statistics';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_id',
        'confirmed',
        'recovered',
        'critical',
        'deaths',
        'updated_at',
        'created_at'
    ];

}
