<?php
// src/AppBundle/Validator/Constraints/ContainsAlphanumeric.php
namespace ManagerBundle\Bundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsAlphanumeric extends Constraint
{
    public $message = 'The string "%string%" contains an illegal character: it can only contain letters or numbers.';
}