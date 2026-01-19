<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Alumno;

class User extends Authenticatable
{

    public function alumno(){
        return $this->hasOne(Alumno::class, 'id_user', 'id');
    }

    public function practicasTutorCentro()
    {
        return $this->hasMany(EstanciaFormativa::class, 'id_tutor_centro', 'id');
    }

    public function practicasTutorEmpresa()
    {
        return $this->hasMany(EstanciaFormativa::class, 'id_tutor_empresa', 'id');
    }

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'telefono',
        'rol',
        'password',
        'activo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con Alumno (un usuario puede ser un alumno)
     */
    public function alumno()
    {
        return $this->hasOne(Alumno::class, 'id_user');
    }

    // Función que establece los campos a devolver para el frontend en un primer logueo
    public function toLoginArray()
    {
        $data = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'rol' => $this->rol,
            'activo' => $this->activo,
        ];

        // Si el usuario es alumno, incluir datos del ciclo
        if ($this->rol === 'ALUMNO' && $this->alumno) {
            $data['ciclo'] = $this->alumno->ciclo ? [
                'id' => $this->alumno->ciclo->id,
                'codigo' => $this->alumno->ciclo->codigo,
                'nombre' => $this->alumno->ciclo->nombre,
                'nivel' => $this->alumno->ciclo->nivel,
            ] : null;
            
            $data['dni'] = $this->alumno->dni;
            $data['numero_cuaderno'] = $this->alumno->numero_cuaderno;
            $data['curso_actual'] = $this->alumno->curso_actual;
            $data['poblacion'] = $this->alumno->poblacion;
        }

        return $data;
    }
}
