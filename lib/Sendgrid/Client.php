<?php

namespace Sendgrid;

use SendGrid;

class Client extends \SendGrid
{

    public function send(\SendGrid\Email $email)
    {
        try {

            $response = parent::send($email);

        } catch (\SendGrid\Exception $e) {
            \Logger::error($e->getMessage());

            if (PIMCORE_DEBUG) {
                throw $e;
            }
        }
    }


}
