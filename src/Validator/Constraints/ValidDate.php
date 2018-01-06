<?php
/**
 * Created by IntelliJ IDEA.
 * User: burak
 * Date: 12/24/17
 * Time: 11:54 PM
 */
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidDate extends Constraint
{
    public $message = 'Die Zeit "{{ string }}" hat kein gültiges Zeitformat: Richtiges Format ist zB: 02:04:06';
    public $message1 = 'Die Zeit "{{ string }}" darf nicht negative sein:  Richtiges Format ist zB: 02:04:06';

}