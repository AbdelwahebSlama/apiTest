<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiStudentController extends AbstractController
{
    /**
     * @Route("/api/student", name="api_student", methods={"GET"})
     */
    public function index(StudentRepository $studentRepository): Response
    {
        return $this->json($studentRepository->findAll(), 200, [], ['groups'=>'student:read']);    
    }

    /**
     * @Route("/api/student", name="api_student_post", methods={"POST"})
     */
    public function store(ValidatorInterface $validator,  Request $request, EntityManagerInterface $em,   SerializerInterface $serializer)
     {
         $jsonRec = $request->getContent();
         
        try {
          $student = $serializer->deserialize($jsonRec, Student::class, 'json');
          $errors  = $validator->validate($student);
          if(count($errors) > 0 ){
             return $this->json($errors, 400);  
            }      
          $em->persist($student);
          $em->flush();
          return $this->json($student, 201, []);
        }  
        catch(NotEncodableValueException $e) {
           return $this->json([
             'status'=> 400, 
             'message' => $e->getMessage()],
             400);      
         }     
     }

}