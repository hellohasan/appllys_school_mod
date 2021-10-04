<?php

namespace App;

use App\Models\Teacher;
use App\Models\Admission;
use App\Models\ParentUser;
use App\Models\UserParent;
use App\Models\UserAddress;
use App\Models\UserDocument;
use App\Models\UserFamilyInfo;
use App\Models\UserInformation;
use App\Models\UserSalaryScale;
use App\Models\UserPreviousInstitute;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject {
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'bio', 'photo', 'type', 'parent_id', 'custom', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    /**
     * @return mixed
     */
    public function guardian() {
        return $this->hasOne(ParentUser::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function information() {
        return $this->hasOne(UserInformation::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function parents() {
        return $this->hasMany(UserParent::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function father() {
        return $this->parents()->where('relation', 'father');
    }

    /**
     * @return mixed
     */
    public function mother() {
        return $this->parents()->where('relation', 'mother');
    }

    /**
     * @return mixed
     */
    public function address() {
        return $this->hasOne(UserAddress::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function admission() {
        return $this->hasOne(Admission::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function childs() {
        return $this->hasMany(ParentUser::class, 'parent_id');
    }

    /**
     * @return mixed
     */
    public function previousInstitute() {
        return $this->hasOne(UserPreviousInstitute::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function documents() {
        return $this->hasMany(UserDocument::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function familyInfo() {
        return $this->hasOne(UserFamilyInfo::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function teacher() {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function salary() {
        return $this->hasOne(UserSalaryScale::class)->withDefault([
            'title' => 'N/A',
        ]);
    }

}
