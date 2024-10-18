<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable implements FilamentUser , HasAvatar
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'middle_name',
        'last_name',
        'phone_number',
        'Preferred_name',
        'secondary_email_address',
        'gender',
        'date_of_birth',
        'address',
        'marital_status',
        'city_of_residence',
        'country_of_residence',
        'state',
        'zip_code',
        'avatar',
        'status',
        'created_by',
        'updated_by',
        'avatar_url',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'is_active' => 'boolean',
            'is_admin' => 'boolean',
            'role' => 'string',
            'date_of_birth' => 'datetime',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin == 0;
    }
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url("$this->avatar_url") : null;
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function createdAssignments()
    {
        return $this->hasMany(Assignment::class, 'created_by');
    }

    public function updatedAssignments()
    {
        return $this->hasMany(Assignment::class, 'updated_by');
    }

    public function createdExams()
    {
        return $this->hasMany(Exam::class, 'created_by');
    }
    public function updatedExams()
    {
        return $this->hasMany(Exam::class, 'updated_by');
    }
    public function createdCourses()
    {
        return $this->hasMany(Course::class, 'created_by');
    }
    public function TechnicalTeam()
    {
        return $this->hasOne(TechnicalTeam::class);
    }
    public function createdDepartments()
    {
        return $this->hasMany(Department::class, 'created_by');
    }
    public function updatedDepartments()
    {
        return $this->hasMany(Department::class, 'updated_by');
    }
    public function createdPrograms()
    {
        return $this->hasMany(Program::class, 'created_by');
    }
    public function updatedPrograms()
    {
        return $this->hasMany(Program::class, 'updated_by');
    }
    public function createdTerms()
    {
        return $this->hasMany(Term::class, 'created_by');
    }
    public function updatedTerms()
    {
        return $this->hasMany(Term::class, 'updated_by');
    }
    public function createdClasses()
    {
        return $this->hasMany(Classe::class, 'created_by');
    }
    public function updatedClasses()
    {
        return $this->hasMany(Classe::class, 'updated_by');
    }
    public function createdStudents()
    {
        return $this->hasMany(Student::class, 'created_by');
    }
    public function updatedStudents()
    {
        return $this->hasMany(Student::class, 'updated_by');
    }
    public function createdTeachers()
    {
        return $this->hasMany(Teacher::class, 'created_by');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function announcementComments()
    {
        return $this->hasMany(AnnouncementComment::class);
    }
    public function getCurrentCourses()
    {
        return $this->courses;
    }
}
