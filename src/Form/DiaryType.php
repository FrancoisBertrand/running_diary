<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 06.01.18
 * Time: 13:10
 */

namespace App\Form;

use App\Entity\RunDiary;

use Symfony\Component\Form;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\AbstractType;

class DiaryType extends AbstractType{
    private $validator;

    public function __construct(ValidatorInterface $validator){
        $this->validator = $validator;
    }

    public function buildForm(FormBuilderInterface $formBuilder, array $options){
        $formBuilder
            ->add('date', DateType::class,[
                'label' => 'Datum',
                'widget' => 'single_text',
                'required' => false,
                'constraints' => [
                    new LessThan(['value' => 'today', 'message' => 'Datum liegt in der Zukunft! Das darf nicht sein!!!']),
                    new NotBlank(['message' => 'Datum darf nicht leer sein!'])
                ],
            ])
            ->add('distance', NumberType::class,[
            'label' => 'Strecke',
            'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Strecke darf nicht leer sein!'])
                ],
            ])
            ->add('duration', TextType::class, [
               'label' => 'Laufzeit',
               'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Zeit darf nicht leer sein!'])
                ],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefault('data_class', RunDiary::class);
    }
}