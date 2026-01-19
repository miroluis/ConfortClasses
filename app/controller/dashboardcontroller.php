<?php
declare(strict_types=1);

namespace app\controller;

class DashboardController
{
    public function index(): void
    {
        if (!Login::amIlogged()) {
            header('Location: index.php?a=login');
            exit;
        }

        echo renderNtpl(
            'base',
            ['title' => 'Dashboard'],
            'dashboard',
            [
                0 => 'content',
                'is_logged' => Login::amIlogged()
            ]
        );

    }
}
