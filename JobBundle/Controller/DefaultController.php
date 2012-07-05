<?php

namespace NebulaFlow\JobBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="job_home")
     * @Template()
     */
    public function indexAction()
    {
		// Jobs for the list
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT j FROM NebulaFlowJobBundle:Job j WHERE j.status != :status ORDER BY j.raisedOn DESC')
			->setParameter('status', 'CLOSED')->setMaxResults(51);
        $jobs = $query->getResult();
		// Form to add a new job
		$newJob = new \NebulaFlow\JobBundle\Entity\Job();
		$newJob->setType(1);
		$newJob->setSubject('ForeignObject:12345');
		$form = $this->createFormBuilder($newJob)
			->add('type')
			->add('subject')
			->getForm();
        return array(
			'jobs'	=> $jobs,
			'form'	=> $form->createView()
		);
    }
    /**
     * @Route("/new", name="job_new")
     * @Template()
     */
    public function newJobAction(Request $request)
    {
		$newJob = new \NebulaFlow\JobBundle\Entity\Job();
		$form = $this->createFormBuilder($newJob)
			->add('type', null, array('label'=>'Type of Job'))
			->add('subject', null, array('label'=>'Subject to act on'))
			->getForm();
		$newJob->setStatus('NEW');
		$newJob->setRaisedOn(new \Datetime('now'));
		$newJob->setRaisedBy('NebulaFlow:TestForm');
		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($newJob);
				$em->flush();
				return $this->redirect($this->generateUrl('job_new_success'));
			}else{
				return array(
					'form' => $form->createView()
				);
			}
		}else{
			return array(
				'form' => $form->createView()
			);
		}
	}
    /**
     * @Route("/", name="job_new_success")
     * @Template()
     */
    public function newJobSuccessAction()
    {
		return array();
	}
}
