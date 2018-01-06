<?php
/**
 * Created by IntelliJ IDEA.
 * User: burak
 * Date: 12/25/17
 * Time: 5:44 PM
 */
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NegativeDistanceValidator extends ConstraintValidator{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        // TODO: Implement validate() method.
        if(!empty($value)){
            if ($value < 0) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ string }}', $value)
                    ->addViolation();
            }else{
                if(is_float($value)){
                    $_float = explode(".", $value);
                    if(!empty($_float[1]) and strlen($_float[1]) > 1){
                        //$newValue = bcdiv($value, 1, 1);
                        //var_dump(strlen($_float[1]) > 2);
                        $this->context->buildViolation($constraint->message1)
                            ->setParameter('{{ string }}', $value)
                            ->setParameter('{{ string1 }}', $this->truncate_number($value, 1))
                            ->addViolation();
                    }
                }
            }
        }
        /*else{
            var_dump($value);
            $this->context->buildViolation($constraint->invalid_message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }*/
    }

    function truncate_number( $number, $precision = 1) {
        // Zero causes issues, and no need to truncate
        if ( 0 == (int)$number ) {
            return $number;
        }
        // Are we negative?
        $negative = $number / abs($number);
        // Cast the number to a positive to solve rounding
        $number = abs($number);
        // Calculate precision number for dividing / multiplying
        $precision = pow(10, $precision);
        // Run the math, re-applying the negative value to ensure returns correctly negative / positive
        return floor( $number * $precision ) / $precision * $negative;
    }
}