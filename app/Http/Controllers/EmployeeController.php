<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Logic\EmployeeLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

final class EmployeeController extends Controller
{
    private EmployeeLogic $employeeLogic;

    public function __construct(EmployeeLogic $employeeLogic)
    {
        $this->employeeLogic = $employeeLogic;
    }

    public function login(Request $req)
    {
        print_r(session()->get('archer'));

        $v = Validator::make($req->all(), [
            'usr' => 'required|alpha_dash|exists:employee', 'pwd' => 'required|alpha_dash',
        ], [
            'usr.required'   => '用户名必须填写',
            'usr.alpha_dash' => '用户名只允许为英文、数字、连接线或者下划线',
            'usr.exists'     => '您输入的用户名在系统中不存在', 'pwd.required' => '密码必须填写',
            'pwd.alpha_dash' => '密码只允许为英文、数字、下划线或连接线',
        ]);

        if ($v->fails()) {
            return $this->resp(msg: $v->getMessageBag()->first(), code: 17);
        }

        ['usr' => $usr, 'pwd' => $pwd] = $v->validated();

        $user = $this->employeeLogic->verifyPwd($usr, $pwd);
        if (!$user) {
            return $this->resp(msg: "您输入的密码 {$pwd} 不正确", code: 39);
        }

        $req->session()->put($usr, $user);

        return $this->resp();
    }
}
