<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Count;

class TaskController extends AbstractController
{
	public function number(Request $request)
	{

		$form = $this->createFormBuilder()
		             ->add('numbers', TextareaType::class)
		             ->add('save', SubmitType::class, ['label' => 'Count'])
		             ->getForm();


		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$count = new Count();

			$data = $form->getData();
			$input = explode("\n", $data['numbers']);
			$input = array_map('trim', $input);;
			$output = $count->getResults($input);
			$combined = array_combine($input, $output);

			return $this->render('task/task.html.twig', [
				'form' => false,
				'result' => $combined
			]);
		}

		return $this->render('task/task.html.twig', [
			'form' => $form->createView(),
		]);
	}

}
