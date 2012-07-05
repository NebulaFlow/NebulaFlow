<?php
// src/NebulaFlow/JobBundle/Form/Type/JobTypeType.php
namespace NebulaFlow\JobBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class JobTypeType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('name', null, array('label'=>'Job Type Name'));
	}
	public function getName(){
		return 'jobType';
	}
}