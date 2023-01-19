<?php

declare(strict_types=1);

namespace App\Logic;

use App\Models\Employee;

final class EmployeeLogic
{
    public function getByUsr(string $usr, array $cols = ['*']): ?array
    {
        $user = Employee::query()->where(['usr' => $usr])->select($cols)->limit(1)->first();
        if (empty($user)) {
            return null;
        }
        return $user->toArray();
    }

    public function verifyPwd(string $usr, string $pwd): bool|array
    {
        $user = $this->getByUsr($usr);
        if (!$user) {
            return false;
        }

        if (\password_verify($pwd, $user['pwd'])) {
            return $user;
        }

        return false;
    }
}
