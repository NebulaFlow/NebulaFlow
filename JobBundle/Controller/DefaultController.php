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
		$newJob->setSubject('ForeignObject:12345');
		$form = $this->createForm(new \NebulaFlow\JobBundle\Form\Type\JobType(), $newJob);
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
		$form = $this->createForm(new \NebulaFlow\JobBundle\Form\Type\JobType(), $newJob);
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
     * @Route("/new_success", name="job_new_success")
     * @Template()
     */
    public function newJobSuccessAction()
    {
		return array();
	}
    /**
     * @Route("/config/jobtypes", name="job_config_jobtypes")
     * @Template()
     */
    public function configJobtypesAction(Request $request)
    {
		// JobTypes for the list
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT jt FROM NebulaFlowJobBundle:JobType jt ORDER BY jt.name')
			;
        $jobtypes = $query->getResult();
		// Form to add a new job
		$newJobType = new \NebulaFlow\JobBundle\Entity\JobType();
		$form = $this->createForm(new \NebulaFlow\JobBundle\Form\Type\JobTypeType(), $newJobType);
		// Process form
		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($newJobType);
				$em->flush();
				return $this->redirect($this->generateUrl('job_config_jobtypes'));
			}else{
				return array(
					'jobtypes'	=> $jobtypes,
					'form'		=> $form->createView(),
					'message'	=> ''
				);
			}
		}else{
			return array(
				'jobtypes'	=> $jobtypes,
				'form'		=> $form->createView(),
				'message'	=> ''
			);
		}
        return array(
			'jobtypes'	=> $jobtypes,
			'form'		=> $form->createView(),
			'message'	=> ''
		);
	}
}
