<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Models\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @property int $id
 * @property string $serial_number
 * @property int $equipment_type_id
 * @property EquipmentType $type
 * @property string $desc
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @method BelongsTo type()
 * @method Builder filter(FilterInterface $filter)
 * @method static Builder|static query()
 */
class Equipment extends Model
{
    use HasFactory, SoftDeletes, HasFilter;

    protected $table = "equipments";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'serial_number',
        'equipment_type_id',
        'desc',
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class, 'equipment_type_id', 'id');
    }
}
