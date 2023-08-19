<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description_of_services
 * @property string schedule_data
 */
class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description_of_services',
        'schedule_data',
    ];

    protected $table = 'specialists';
}
