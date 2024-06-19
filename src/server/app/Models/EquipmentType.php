<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $mask
 * @property Equipment $equipment
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @method HasMany equipment()
 * @method Builder filter(FilterInterface $filter)
 * @method static Builder|static query()
 */
class EquipmentType extends Model
{
    use HasFactory, HasFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mask',
    ];

    /**
     * @return HasMany
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class, 'equipment_type_id', 'id');
    }
}
