<?php

namespace App\Service;

class ServiceWhoDoSomething
{

    /**
     * @throws \Exception
     */
    public function do(bool $throw = false): void
    {
        sleep(10);

        if ($throw) {
            throw new \Exception('Something went wrong');
        }
    }

}
