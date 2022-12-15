<?php

namespace App\Validator;

use App\Helpers\Validator;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;

class NewTweetRequestValidator
{
    public function validate(Request $request): array {
        $data = [];
        $errors = [];

        $text = $request->request->get('text', '');
        $text = filter_var($text, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        try {
            Validator::lengthBetween($text, 2, 280);
            $data["text"] = $text;
        } catch (InvalidArgumentException $e) {
            $errors[] = $e->getMessage();
        }

        return [$data, $errors];
    }
}