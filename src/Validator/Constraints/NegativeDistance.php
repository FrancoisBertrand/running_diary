<?php
/**
 * Created by IntelliJ IDEA.
 * User: burak
 * Date: 12/25/17
 * Time: 5:43 PM
 */
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class NegativeDistance extends Constraint {
    public $message = 'Die Strecke "{{ string }}" ist negative. Die Strecke darf nicht negative sein';
    public $message1 = 'Die Strecke "{{ string }}" hat mehr als 1 Nachkommastellen: Richtig wäre zB: "{{ string1 }}"';
    public $invalid_message = 'Die Strecke "{{ string }}" ist string. Die Strecke darf darf nur integer oder float mit maximal
     eine Nachkommastelle sein';

}