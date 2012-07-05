<?php
// src/NebulaFlow/JobBundle/Form/Type/JobType.php
namespace NebulaFlow\JobBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class JobType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('type', 'entity', array(
			'class' => 'NebulaFlowJobBundle:JobType',
			'query_builder' => function($repository) { return $repository->createQueryBuilder('p')->orderBy('p.id', 'ASC'); },
			'property' => 'name',
			'empty_value' => 'Choose a type...'
		));
		$builder->add('subject', null, array('label'=>'Subject to act on'));
	}
	public function getDefaultOptions(){
		return array(
			'data_class' => 'NebulaFlow\JobBundle\Entity\Job',
		);
	}
	public function getName(){
		return 'job';
	}
}