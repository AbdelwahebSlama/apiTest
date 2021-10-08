<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Teacher;
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
class ApiTeacherController extends AbstractController
{
    /**
     * @Route("/api/teacher", name="api_teacher",  methods={"POST"})
     */
    public function index(ValidatorInterface $validator,  Request $request, EntityManagerInterface $em,   SerializerInterface $serializer)
    {
        
        $jsonRec = $request->getContent();
         
        try {
          $teacher = $serializer->deserialize($jsonRec, Teacher::class, 'json');
          $errors  = $validator->validate($teacher);
          if(count($errors) > 0 ){
             return $this->json($errors, 400);  
            }      
          $em->persist($teacher);
          $em->flush();
          return $this->json($teacher, 201, []);
        }  
        catch(NotEncodableValueException $e) {
           return $this->json([
             'status'=> 400, 
             'message' => $e->getMessage()],
             400);      
        }     
     
    }
}
