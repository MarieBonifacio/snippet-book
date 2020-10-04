<?php

namespace App\Form;

use App\Entity\Snippet;
use App\Entity\Language;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SnippetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['attr' => ["placeholder"=>"Snippet title"]])
            ->add('description', null, ['attr' => ["placeholder"=>"Snippet description"]])
            ->add('code', null, ['attr' => ["placeholder"=>"Snippet code"]])
            ->add('language', EntityType::class, ['class' => Language::class,'attr' => ["placeholder"=>"Snippet language"]])
            ->add('tags', CollectionType::class, [
                'entry_type' => TagFormType::class,
                'entry_options' =>  ['label' => false], 
                'allow_add' => true, 
            ])
            ->add('save', SubmitType::class, ['label' => 'submit'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Snippet::class,
        ]);
    }
}

