<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Landlord;
use App\Models\Tenant;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = User::create($data);
        
        if ($data['type'] == 1) {
            $user->assignRole('tenant');
            $permissions = $user->getPermissionsViaRoles();
            $user->givePermissionTo($permissions);

            Tenant::create([
                'user_id' => $user->id,
                'occupation' => null,
                'income_range' => null,
                'nric_path' => null,
            ]);
        } else {
            $user->assignRole('landlord');
            $permissions = $user->getPermissionsViaRoles();
            $user->givePermissionTo($permissions);

            Landlord::create([
                'user_id' => $user->id,
            ]);
        }

        return $user;
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.');
    }
}
