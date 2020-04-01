<?php

namespace App;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;



class Api
{

     private static function getSerializer()
     {
          $normalizers = [new ObjectNormalizer()];
          return new Serializer($normalizers, [new JsonEncoder()]);
     }

     public static function getAll($repository)
     {
          header('Content-Type: application/json');
          $serializer = self::getSerializer();
          $data = $repository->findAll();
          return $serializer->serialize($data, 'json');
     }

     public static function getOneById($repository, $id)
     {
          header('Content-Type: application/json');
          $serializer = self::getSerializer();
          $data = $repository->findOneBy(['id' => $id]);
          return $serializer->serialize($data, 'json');
     }
}
