<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Landing;
use App\Entity\About;
use App\Entity\Bonus;
use App\Entity\Action;
use App\Entity\Product;
use App\Entity\Pharm;
use App\Entity\Advantage;

class LandingExample extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $landing = new Landing;
        $landing->setName('Аптека 665');
        $landing->setCode('665');
        $landing->setPhone('8 800 755 00 03');
        $landing->setCreatedAt(new \DateTime());
        $landing->setUpdatedAt(new \DateTime());
        $landing->setActive(true);
        $aboutInfo = new About;
        $aboutInfo->setName('Информация');
        $aboutInfo->setContent("<h4>
							Компания «Вита» была основана 17 февраля 1993 года в г. Самара. За
							многие годы, непрерывно развиваясь, компания обеспечила себе
							устойчивую репутацию надежного партнера и вошла в первую десятку
							крупнейших аптечных сетей России.
						</h4>
						<p>
							Основная деятельность - реализация лекарственных средств, изделий
							медицинского назначения и парафармацевтической продукции через
							аптеки.
						</p>
						<p>
							Говоря о здоровье, мы имеем ввиду не только его медицинские
							аспекты, но и поддержание хорошей формы, здоровое питание и в
							целом умение вести здоровый образ жизни.
						</p>");
        $aboutControll = new About;
        $aboutControll->setName('Контроль качества');
        $aboutControll->setContent("<h4>
							Аптеки Вита дают своим клиентам 100% гарантию качества товаров.
						</h4>
						<p>
							В структуре компании АС Вита есть свой собственный отдел контроля
							качества и склад для хранения лекарств с тремя разными
							температурными режимами.
						</p>
						<p>
							Отдел контроля качества проводит многоуровневую проверку
							лекарственных средств, перед тем, как они поступают в продажу.
							Проверка эта проходит в несколько этапов.
                        </p>");
        $aboutWisdom = new About;
        $aboutWisdom->setName("Благотворительность");
        $aboutWisdom->setContent("<p>
							Каждый ребенок имеет право на счастливое детство, беззаботную
							улыбку и возможность быть полноправным членом общества, в котором
							живет. Но, как это ни печально, есть дети, которым это право
							достается труднее, чем другим. Есть ребята, которые ограничены в
							общении со сверстниками и лишены обычных радостей детства.
						</p>
						<p>
							Компания Вита совместно с фондом помощи «Русфонд» уже не первый
							год занимается благотворительной деятельностью. Мы помогаем
							детским медицинским и воспитательным учреждениям, а также жертвуем
							денежные средства на спасение тяжелобольных детей.
						</p>
						<p class=\"slider__big-text\">
							Присоединяйтесь и Вы. Поможем детям вместе!
                        </p>");
        $landing->addAbout($aboutInfo);
        $landing->addAbout($aboutControll);
        $landing->addAbout($aboutWisdom);
        $bonus = new Bonus;
        $bonus->setName('Выгода при каждой покупке!');
        $bonus->setText('Получите карту бесплатно<br>
Накопите бонусные баллы<br>
Оплачивайте бонусами до 80%<br>');
        $bonus->setLabelText('БОНУСНАЯ КАРТА');
        $bonus->setLabelColor('#e21c41');
        $bonus->setTitleColor('#009f50');
        $bonus->setBonusPic('img/img_example/bonus-background.jpg');
        $landing->setBonus($bonus);
        $action = new Action;
        $action->setName("Собери свой<br>Вита Микс!");
        $action->setActionPic('img/img_example/action-background.png');
        $action->setLogoPic('img/img_example/logo_pic.png');
        $action->setText('<h3>
					В акции участвуют товары различных категорий. Выберите два акционных
					товара и третий, с наименьшей ценой, получите бесплатно.
				</h3>
				<h3 class="section__pink">
					В акции участвуют товары различных категорий. Выберите два акционных
					товара и третий, с наименьшей ценой, получите бесплатно.
                </h3>');
        $action->setLabelColor('#c665a4');
        $action->setLabelText('С 1 апреля по 31 июля 2019 г.');
        $action->setUrl('https://vitaexpress.ru/vitamix');
        $landing->addAction($action);
        $product1 = new Product;
        $product1->setName('Товар1');
        $product1->setPrice('88');
        $product1->setProductPic('img/img_example/product1.jpg');
        $product1->setUrl('https://vitaexpress.ru/catalog/lekarstva-i-bady/bio_add/omegamama-9-mesyatsev-kaps-30-bad/');
        $product2 = new Product;
        $product2->setName('Товар2');
        $product2->setPrice('88');
        $product2->setProductPic('img/img_example/product1.jpg');
        $product2->setUrl('https://vitaexpress.ru/catalog/lekarstva-i-bady/bio_add/omegamama-9-mesyatsev-kaps-30-bad/');
        $landing->addProduct($product1);
        $landing->addProduct($product2);
        $pharm1 =  new Pharm;
        $pharm1->setName('Аптека 688');
        $pharm1->setCoords('2013,43 5224,12');
        $pharm1->setPharmPic('img/img_example/pharm.jpg');
        $pharm1->setType('Вита-экспресс');
        $pharm1->setAddress('г. Самара, ул. Ульяновская, 88');
        $adv1 = new Advantage;
        $adv1->setName('Широкий ассортимент');
        $adv1->setAdvPic('img/img_example/ad1.svg');
        $adv2 = new Advantage;
        $adv2->setName('Низкие цены');
        $adv2->setAdvPic('img/img_example/ad2.svg');
        $adv3 = new Advantage;
        $adv3->setName('Рядом с вами');
        $adv3->setAdvPic('img/img_example/ad3.svg');
        $pharm1->addAdvantage($adv1);
        $pharm1->addAdvantage($adv2);
        $pharm1->addAdvantage($adv3);
        $pharm2 =  new Pharm;
        $pharm2->setName('Аптека 665');
        $pharm2->setCoords('2031,43 5324,12');
        $pharm2->setPharmPic('img/img_example/pharm.jpg');
        $pharm2->setType('Вита-экспресс');
        $pharm2->setAddress('г. Самара, ул. Ульяновская, 19');
        $adv1 = new Advantage;
        $adv1->setName('Широкий ассортимент');
        $adv1->setAdvPic('img/img_example/ad1.svg');
        $adv2 = new Advantage;
        $adv2->setName('Низкие цены');
        $adv2->setAdvPic('img/img_example/ad2.svg');
        $adv3 = new Advantage;
        $adv3->setName('Рядом с вами');
        $adv3->setAdvPic('img/img_example/ad3.svg');
        $pharm2->addAdvantage($adv1);
        $pharm2->addAdvantage($adv2);
        $pharm2->addAdvantage($adv3);
        $landing->addPharm($pharm1);
        $landing->addPharm($pharm2);
        // $product = new Product();
        // $manager->persist($product);
        $manager->persist($landing);

        $manager->flush();
    }
}
