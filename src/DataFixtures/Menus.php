<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Items;
use App\Entity\Orders;
use App\Entity\Comments;
use App\Entity\Customers;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Menus extends Fixture
{
    private $passEncoder;
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->passEncoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $pdts = array(
            [1, 'Menu Classic', 'Sandwich: Burger, Salade, Tomate, Cornichon + Frites + Boisson', 8.9, 'm1.png', 1],
            [2, 'Menu Bacon', 'Sandwich: Burger, Fromage, Bacon, Salade, Tomate + Frites + Boisson', 9.5, 'm2.png', 1],
            [3, 'Menu Big', 'Sandwich: Double Burger, Fromage, Cornichon, Salade + Frites + Boisson', 10.9, 'm3.png', 1],
            [4, 'Menu Chicken', 'Sandwich: Poulet Frit, Tomate, Salade, Mayonnaise + Frites + Boisson', 9.9, 'm4.png', 1],
            [5, 'Menu Fish', 'Sandwich: Poisson, Salade, Mayonnaise, Cornichon + Frites + Boisson', 10.9, 'm5.png', 1],
            [6, 'Menu Double Steak', 'Sandwich: Double Burger, Fromage, Bacon, Salade, Tomate + Frites + Boisson', 11.9, 'm6.png', 1],
            [7, 'Classic', 'Sandwich: Burger, Salade, Tomate, Cornichon', 5.9, 'b1.png', 2],
            [8, 'Bacon', 'Sandwich: Burger, Fromage, Bacon, Salade, Tomate', 6.5, 'b2.png', 2],
            [9, 'Big', 'Sandwich: Double Burger, Fromage, Cornichon, Salade', 6.9, 'b3.png', 2],
            [10, 'Chicken', 'Sandwich: Poulet Frit, Tomate, Salade, Mayonnaise', 5.9, 'b4.png', 2],
            [11, 'Fish', 'Sandwich: Poisson Pané, Salade, Mayonnaise, Cornichon', 6.5, 'b5.png', 2],
            [12, 'Double Steak', 'Sandwich: Double Burger, Fromage, Bacon, Salade, Tomate', 7.5, 'b6.png', 2],
            [13, 'Frites', 'Pommes de terre frites', 3.9, 's1.png', 3],
            [14, 'Onion Rings', "Rondelles d'oignon frits", 3.4, 's2.png', 3],
            [15, 'Nuggets', 'Nuggets de poulet frits', 5.9, 's3.png', 3],
            [16, 'Nuggets Fromage', 'Nuggets de fromage frits', 3.5, 's4.png', 3],
            [17, 'Ailes de Poulet', 'Ailes de poulet Barbecue', 5.9, 's5.png', 3],
            [18, 'César Poulet Pané', 'Poulet Pané, Salade, Tomate et la fameuse sauce César', 8.9, 'sa1.png', 4],
            [19, 'César Poulet Grillé', 'Poulet Grillé, Salade, Tomate et la fameuse sauce César', 8.9, 'sa2.png', 4],
            [20, 'Salade Light', 'Salade, Tomate, Concombre, MaÃ¯s et Vinaigre balsamique', 5.9, 'sa3.png', 4],
            [21, 'Poulet Pané', 'Poulet Pané, Salade, Tomate et la sauce de votre choix', 7.9, 'sa4.png', 4],
            [22, 'Poulet Grillé', 'Poulet Grillé, Salade, Tomate et la sauce de votre choix', 7.9, 'sa5.png', 4],
            [23, 'Coca-Cola', 'Au choix: Petit, Moyen ou Grand', 1.9, 'bo1.png', 5],
            [24, 'Coca-Cola Light', 'Au choix: Petit, Moyen ou Grand', 1.9, 'bo2.png', 5],
            [25, 'Coca-Cola Zéro', 'Au choix: Petit, Moyen ou Grand', 1.9, 'bo3.png', 5],
            [26, 'Fanta', 'Au choix: Petit, Moyen ou Grand', 1.9, 'bo4.png', 5],
            [27, 'Sprite', 'Au choix: Petit, Moyen ou Grand', 1.9, 'bo5.png', 5],
            [28, 'Nestea', 'Au choix: Petit, Moyen ou Grand', 1.9, 'bo6.png', 5],
            [29, 'Fondant au chocolat', 'Au choix: Chocolat Blanc ou au lait', 4.9, 'd1.png', 6],
            [30, 'Muffin', 'Au choix: Au fruits ou au chocolat', 2.9, 'd2.png', 6],
            [31, 'Beignet', 'Au choix: Au chocolat ou Ã  la vanille', 2.9, 'd3.png', 6],
            [32, 'Milkshake', 'Au choix: Fraise, Vanille ou Chocolat', 3.9, 'd4.png', 6],
            [33, 'Sundae', 'Au choix: Fraise, Caramel ou Chocolat', 4.9, 'd5.png', 6]
        );

        $clients = array(
            [1, 'Michelle', 'Smith', 'michelle@gmail.com', '1234', 'images/sandy.jpg', '2014-02-18 20:17:26'],
            [2, 'Ben', 'Barro', 'ben@gmail.com', '1234', 'images/ben.jpg', '2014-02-18 20:17:26'],
            [3, 'William', 'Terry', 'william@gmail.com', '1234', 'images/william.jpg', '2014-02-18 20:17:26'],
            [4, 'Sarah', 'Thompson', 'sarah@gmail.com', '1234', 'images/sarah.jpg', '2014-02-18 20:17:26'],
            [5, 'Donald', 'Duck', 'donald@gmail.com', '1234', 'images/donald.jpg', '2014-02-18 20:17:26'],
            [6, 'Beth', 'McAdams', 'beth@gmail.com', '1234', 'images/beth.jpg', '2014-02-18 20:17:26'],
            [7, 'Henry', 'Wallace', 'henry@gmail.com', '1234', 'images/henry.jpg', '2014-02-20 19:58:41'],
            [8, 'Corin', 'Sabbath', 'corin@gmail.com', '1234', 'images/corin.jpg', '2014-02-20 19:58:41'],
            [9, 'George', 'Harris', 'george@yahoo.com', '1234', 'images/george.jpg', '2014-02-20 20:02:28'],
            [10, 'Karen', 'White', 'karen@aol.com', '1234', 'images/karen.jpg', '2014-02-20 20:02:28'],
            [11, 'Warren', 'Bartlet', 'warren@gmail.com', '1234', 'images/warren.jpg', '2014-02-20 20:07:19'],
            [12, 'Steven', 'Wright', 'stevewright@aol.com', '1234', 'images/steve.jpg', '2014-02-20 20:07:19'],
            [13, 'Bob', 'Sacramento', 'bob@yahoo.com', '1234', 'images/bob.jpg', '2014-02-20 20:07:19'],
            [14, 'Shawn', 'Hurley', 'hurley@gmail.com', '1234', 'images/hurley.jpg', '2014-02-20 20:07:19'],
            [15, 'Mark', 'Roast', 'mark@gmail.com', '1234', 'images/mark.jpg', '2014-02-20 20:07:19'],
            [16, 'Barry', 'White', 'barrywhite@gmail.com', '1234', 'images/barry.jpg', '2014-02-20 20:07:19'],
            [17, 'Roland', 'Groburg', 'roland@yahoo.com', '1234', 'images/roland.jpg', '2014-02-20 20:07:19'],
            [18, 'Christian', 'Hayhouse', 'christian@gmail.com', '1234', 'images/christian.jpg', '2014-02-20 20:07:19'],
            [19, 'Kelly', 'Bark', 'kelly@gmail.com', '1234', 'images/kelly.jpg', '2014-02-20 20:07:19'],
            [20, 'Greg', 'Thompson', 'greg@yahoo.com', '1234', 'images/greg.jpg', '2014-02-20 20:07:19'],
            [21, 'Brad', 'Traversy', 'brad@techguywebsolutions.com', '81dc9bdb52d04dc20036dbd8313ed055', '', '2014-02-22 20:52:50'],
            [22, 'Peter', 'Smith', 'petersmith@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '2014-02-22 21:01:52'],
            [23, 'Steven', 'Thompson', 'steventhompson@gmail.com', '74be16979710d4c4e7c6647856088456', '', '2014-02-22 21:45:23']
        );

        $catego = array(
            [1, 'Menus'],
            [2, 'Burgers'],
            [3, 'Snacks'],
            [4, 'Salades'],
            [5, 'Boissons'],
            [6, 'Desserts']
        );

        $faker  = Factory::create();
        $genres = ['male', 'female'];

        $customers=[];
        for ($i=0;$i< count($clients);$i++) {
            $genre = $faker->randomElement($genres);
            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99).'.jpg';
            $picture .= ($genre == 'male' ? 'men/' : 'women/').$pictureId;

            $customer = new Customers();
            $customer->setFirstName($clients[$i][1])
                ->setLastName($clients[$i][2])
                ->setEmail($clients[$i][3])
                ->setPassword($this->passEncoder->encodePassword($customer,$clients[$i][4]))
                ->setAvatar($picture)
                ->setJoinDate($faker->datetime())
                ->setRoles(['ROLE_USER'])
                ;
            $customers[] = $customer;
            $manager->persist($customer);
            $manager->flush();
        }

        $admin = new Customers();
        $admin->setFirstName("laye")
        ->setLastName("zen")
        ->setEmail("layezen@gmail.com")
        ->setPassword($this->passEncoder->encodePassword($admin,'admin'))
        ->setAvatar('admin')
        ->setJoinDate($faker->datetime())
        ->setRoles(['ROLE_ADMIN'])
        ;            
        $manager->persist($admin);
        $manager->flush();

        $items = [];
        for($i=0;$i<count($pdts);$i++) {
            $item=new Items();
            $item->setName($pdts[$i][1])
                ->setDescription($pdts[$i][2])
                ->setPrice($pdts[$i][3])
                ->setImage($pdts[$i][4])
                ->setCategory($pdts[$i][5]);
            $items[] = $item;
            $manager->persist($item);
            $manager->flush();
        }

        $orders=[];
        for($i=0;$i<20;$i++) {
            $order = new Orders();
            $order->setCustomer($customers[$faker->numberBetween(1,count($clients)-1)])
                ->setQuantite($faker->numberBetween(1,5));
            $order->setOrderDate($faker->datetime());
            $order->addItem($items[$faker->numberBetween(0,count($items)-1)]);
            /*for($i=0; $i<$faker->numberBetween(0,4);$i++) {
                //$ordered[] = $items[$faker->numberBetween(0,count($items))];
            }*/
            $manager->persist($order);
            $orders[] = $order;
            $manager->flush();
        }

        $comments = [];
        for($i=0;$i<15;$i++) {
            $comment = new Comments();
            $order = $orders[$i];
            $author = $customers[$i];
            $comment->setAuthor($author)
                ->setCOrder($order)
                ->setComment($faker->sentence(20))
                ->setRating($faker->numberBetween(1,5));
            $comments[] = $comment;
            $manager->persist($comment);
            $manager->flush();
        }
    }
}
