<?php

namespace App\Traits;

use App\Models\Section;

Trait Admin {

    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'superadmin']);
    }

    public function isBasicAdmin()
    {
        return $this->role == 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role == 'superadmin';
    }

    public function canManage(Section $section)
    {
        if ($this->isSuperAdmin()) {
            return true;
        } elseif ($this->isBasicAdmin()) {
            $managed_sections_ids =
            $this->managed_sections()->get()->pluck('id')->toArray();
            //dd($managed_sections_ids);
            return in_array($section->id, $managed_sections_ids);
        }

        return false;
    }

    public function managed_sections_list()
    {
        if (! $this->isAdmin()) {
            return [];
        }
        if ($this->isSuperAdmin()) {
            return Section::pluck('title', 'id');
        }

        return $this->managed_sections->pluck('title', 'id');
    }

    public function managed_sections()
    {
        return $this->belongsToMany(Section::class, 'admin_sections', 'user_id', 'section_id')->withPivot('created_at');
    }

}
