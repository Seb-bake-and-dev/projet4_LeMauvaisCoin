<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Type;
use App\Repository\ImageRepository;
use App\Form\DataTransformer\ImagesToCollectionTransformer;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    /**
     * @var ImageRepository
     */
    private $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Titre de l\'annonce'
                )))
            ->add('description', TextareaType::class, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Description'
                )))
            ->add('imageFile', FileType::class, array(
                'label' => 'Image de l\'annonce',
                'required' => false,
            ))
//            ->add('images', FileType::class, array(
//                'label' => 'Images bonus',
//                'required' => false,
//            ))
            ->add('type', EntityType::class, array(
                'class' => Type::class,
                'choice_label' => 'label',
            ))
        ;
//        $builder->get('images')
//            ->addModelTransformer(new CollectionToArrayTransformer(), true)
//            ->addModelTransformer(new ImagesToCollectionTransformer($this->imageRepository), true);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
