<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Genre;
use App\Entity\Auteur;
use App\Entity\Livre;
use App\Entity\User;
use Faker\Factory;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        
        // $product = new Product();
        for ($i = 1; $i <= 10; $i++) {
            $genre = new Genre();
            $genre->setNom('Genre Num'.$i);
            $this->addReference('genre_'.$i,$genre);
            $manager->persist($genre);
        }
        for ($i = 1; $i <= 20; $i++) {
            $aut = new Auteur();
            $gender = $this->faker->randomElement($array = array ('male','female'));
            $aut->setNomPrenom($this->faker->name($gender));
            $aut->setSexe($gender);
            $aut->setDateDeNaissance($this->faker->dateTimeBetween($format = 'Y-m-d', $max = '2004-01-01'));
            $aut->setNationalite($this->faker->country);
            $this->addReference('auteur_'.$i,$aut);
            $manager->persist($aut);
        }
        for ($i = 1; $i <= 50; $i++) {
            $l = new Livre();
            for($j=1;$j<=$this->faker->numberBetween(1,3);$j++){
                $l->addAuteur($this->getReference('auteur_'.$this->faker->numberBetween(1,20)));
            }
            for($j=1;$j<=$this->faker->numberBetween(1,3);$j++){
                $l->addGenre($this->getReference('genre_'.$this->faker->numberBetween(1,10)));
            }
            $l->setIsbn($this->faker->ean13());
            $l->setTitre($this->faker->text);
            $l->setNombrePages($this->faker->randomNumber);
            $l->setDateDeParution($this->faker->dateTimeBetween($startDate = '-121 years', $endDate = 'now'));
            $l->setNote($this->faker->numberBetween($min = 0, $max = 20));
            $manager->persist($l);
        }
        $user = new user() ; 
        $user->setEmail('ouma@gmail.com')
                ->setPassword("123456789") 
                ->setRoles(["ROLE_ADMIN"])
                ; 
        $manager->persist($user) ;

        $manager->flush();
    }
}
