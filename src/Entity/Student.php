<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StudentRepository;


#[ORM\Entity(repositoryClass: StudentRepository::class)]
#[ORM\Table(name: "student")]
class Student
{
    #[ORM\Id]
    #[ORM\Column(type: "string" , length: 20)]
    private string $nsc;

    #[ORM\Column(type: "string")]
    private string $email;



    #[ORM\ManyToOne(targetEntity: Classe::class)]
     #[JoinColumn(name:"class_id", referencedColumnName:"id")]
    private Classe $class;



    public function getNsc(): string
    {
        return $this->nsc;
    }

    public function setNsc(string $nsc): void
    {
        $this->nsc = $nsc;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getClass(): Classe
    {
        return $this->class;
    }

    public function setClass(Classe $class): void
    {
        $this->class = $class;
    }






}
