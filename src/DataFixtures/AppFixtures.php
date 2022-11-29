<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setNom("admin");
        $admin->setPrenom("admin");
        $admin->setRole("Admin");
        $admin->setUsername("admin");
        $admin->setEmail("admin@admin.com");
        $admin->setImage("random");
        $admin->setRoles([]);
        $admin->setDateNaissance(new DateTime());
        $admin->setApproved(true);
        $admin->setPassword("fec79a625cf074ea4e73bf6bb3bbada7f1ba98b2f7e18dbd02ec79cfb4317d82");
        $manager->persist($admin);

        $tutor = new User();
        $tutor->setNom("tutor");
        $tutor->setPrenom("tutor");
        $tutor->setRole("Tutor");
        $tutor->setUsername("tutor");
        $tutor->setEmail("tutor@admin.com");
        $tutor->setImage("random");
        $tutor->setRoles([]);
        $tutor->setDateNaissance(new DateTime());
        $tutor->setApproved(true);
        $tutor->setPassword("fec79a625cf074ea4e73bf6bb3bbada7f1ba98b2f7e18dbd02ec79cfb4317d82");
        $manager->persist($tutor);

        $student = new User();
        $student->setNom("student");
        $student->setPrenom("student");
        $student->setRole("Student");
        $student->setUsername("student");
        $student->setEmail("student@admin.com");
        $student->setImage("random");
        $student->setRoles([]);
        $student->setDateNaissance(new DateTime());
        $student->setApproved(true);
        $student->setPassword("fec79a625cf074ea4e73bf6bb3bbada7f1ba98b2f7e18dbd02ec79cfb4317d82");
        $manager->persist($student);

        $manager->flush();
    }
}
