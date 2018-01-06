<?php
/**
 * Created by IntelliJ IDEA.
 * User: burak
 * Date: 12/24/17
 * Time: 11:46 PM
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidDateValidator extends ConstraintValidator{
    public function validate($value, Constraint $constraint) {
        if(!empty($value)){
            if (!$this->verify_time_format($value)) {
                if((float)$value < 0){
                    $this->context->buildViolation($constraint->message1)
                        ->setParameter('{{ string }}', $value)
                        ->addViolation();
                }else{
                    $this->context->buildViolation($constraint->message)
                        ->setParameter('{{ string }}', $value)
                        ->addViolation();
                }
            }
        }

    }

    function verify_time_format ($value) {
        $pattern1 = '/^(0+\d|1\d|2[0-3]):[0-5]\d:[0-5]\d$/';
        $pattern2 = '/^(0?\d|1[0-2]):[0-5]\d$/i';
        return preg_match ($pattern1, $value) || preg_match ($pattern2, $value);
    }
}