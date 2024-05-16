<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Andersonhsilva\MetodosPhp\Metodos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'responsible_id',
        'name',
        'cpf',
        'password',
        'email',
        'cep',
        'address',
        'number',
        'district',
        'complement',
        'reference',
        'city',
        'state',
        'birth_date',
        'gender',
        'marital_status',
        'occupation',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $dates = ['birth_date'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function setEmailAttribute($value)
    {
        if ($value) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->attributes['email'] = $value;
            } else {
                throw new \Exception("Endereço de email inválido");
            }
        }
    }

    public function setCpfAttribute($value)
    {
        $cpf = Metodos::somente_numero($value);
        Metodos::validar_cpf($cpf);
        $this->attributes['cpf'] = $cpf;
    }

    public function getCpfAttribute($value)
    {
        return Metodos::mascara_string($value, '###.###.###-##');
    }

    public function setCepAttribute($value)
    {
        $this->attributes['cep'] = Metodos::somente_numero($value);
    }

    public function getCepAttribute($value)
    {
        return Metodos::mascara_string($value, '##.###-###');
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function patients()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function entries()
    {
        return $this->hasMany(Entry::class, 'id', 'user_id');
    }

    public static function search(Request $request)
    {
        return User::when(true, function ($query) use ($request) {

            switch ($request->parameters) {
                case is_numeric($request->information):
                    $query->where($request->parameters, $request->information);
                    break;
                default:
                    $query->where($request->parameters, 'LIKE', "%$request->information%");
            }

            $query->orderBy('users.id', 'ASC');
        });
    }
}
