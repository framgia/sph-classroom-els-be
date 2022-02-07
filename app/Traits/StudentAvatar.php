<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StudentAvatar
{
    protected function attachAvatarURL($students)
    {
        foreach ($students as $student) {
            $avatarURL = 'http://localhost:82' . Storage::url( 'avatar/' . $student->avatar);

            $student['avatar_url'] = $avatarURL;
        }

        return $students;
    }
}