<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;
class AdvertisingCampaign extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia;
    protected $table= "advertising_campaigns";
    protected $fillable = [
        'name',
        'from',
        'to',
        'total',
        'daily_budget',
        'owner_id',
    ];
    public function owner(){
        return $this->belongsTo(User::class);
    }
}
