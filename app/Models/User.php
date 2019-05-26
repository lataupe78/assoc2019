<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasMediaTrait;
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'password', 'remember_token',
    ];

    protected $dates = [
    	'email_verified_at',
    	'birth'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    	'email_verified_at' => 'datetime',
    	'birth' => 'datetime:Y-m-d',
    ];



    public function isAdmin(){
    	return in_array($this->role, ['admin', 'superadmin']);
    }

    public function isBasicAdmin(){
    	return $this->role == 'admin';
    }

    public function isSuperAdmin(){
    	return $this->role == 'superadmin';
    }


    /*
    public function setBirthAttribute($date)
    {
        $this->attributes['birth'] = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }
    */



    public function getAvatarPictureAttribute(){
        /*return 'storage/images/avatars/'
        .(($this->avatar)
            ? $this->avatar
            : 'default-avatar.png'
        );
        */

        return $this->getFirstMediaUrl('avatar', 'thumb')
        ?: 'storage/images/avatars/default-avatar.png';
    }




    public function canManage(Section $section){
    	if($this->isSuperAdmin()){
    		return true;
    	} else if($this->isBasicAdmin()){
    		$managed_sections_ids =
    		$this->managed_sections()->get()->pluck('id')->toArray();
            //dd($managed_sections_ids);
    		return in_array($section->id, $managed_sections_ids);
    	}
    	return false;
    }

    public function managed_sections_list(){
    	if(!$this->isAdmin()){
    		return [];
    	}
    	if($this->isSuperAdmin()){
    		return Section::pluck('title', 'id');
    	}
    	return $this->managed_sections->pluck('title', 'id');
    }

    public function managed_sections(){

    	return $this->belongsToMany(Section::class, 'admin_sections', 'user_id', 'section_id')->withPivot('created_at');
    }

}
